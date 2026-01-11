<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\Facades\DataTables;

class MahasiswaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Mahasiswa::latest()->get(); 
            
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status_badge', function($row){
                    $color = match($row->status) {
                        'diverifikasi' => 'green',
                        'ditolak' => 'red',
                        default => 'yellow'
                    };
                    return '<span class="px-3 py-1 rounded-full text-xs font-bold bg-'.$color.'-100 text-'.$color.'-800 border border-'.$color.'-200">'.ucfirst($row->status).'</span>';
                })
                ->addColumn('action', function($row){
                    $btn = '<div class="flex justify-center items-center gap-2">';
                    
                    // --- TOMBOL VERIFIKASI (Hanya muncul jika status 'baru') ---
                    if ($row->status == 'baru') {
                        $btn .= '<button data-id="'.$row->id.'" class="verifikasi-btn flex items-center gap-1 bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-lg text-xs font-bold shadow transition-transform transform hover:-translate-y-0.5" title="Verifikasi Mahasiswa">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Verifikasi
                                 </button>';
                    }

                    // --- TOMBOL LAINNYA ---

                    // Tombol Edit
                    $btn .= '<a href="javascript:void(0)" data-id="'.$row->id.'" class="edit flex items-center justify-center bg-blue-900 hover:bg-blue-800 text-white w-8 h-8 rounded-lg shadow transition-transform transform hover:-translate-y-0.5" title="Edit Data">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </a>';

                    // Tombol PDF (Hanya muncul jika SUDAH diverifikasi)
                    if ($row->status == 'diverifikasi') {
                        $btn .= '<a href="'.route('mahasiswa.cetakPdf', $row->id).'" target="_blank" class="flex items-center justify-center bg-yellow-500 hover:bg-yellow-600 text-white w-8 h-8 rounded-lg shadow transition-transform transform hover:-translate-y-0.5" title="Cetak Kartu">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                </a>';
                    }

                    // Tombol Hapus
                    $btn .= '<a href="javascript:void(0)" data-id="'.$row->id.'" class="delete flex items-center justify-center bg-red-600 hover:bg-red-700 text-white w-8 h-8 rounded-lg shadow transition-transform transform hover:-translate-y-0.5" title="Hapus">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </a>';
                             
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['status_badge', 'action'])
                ->make(true);
        }
        
        return view('mahasiswa.index');
    }

    // --- UPDATE: Fungsi Verifikasi jadi JSON untuk AJAX ---
    public function verifikasi($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        $mhs->update(['status' => 'diverifikasi']);

        // Return JSON agar DataTables bisa refresh tanpa reload
        return response()->json(['success' => 'Mahasiswa berhasil diverifikasi!']);
    }

    // --- Fungsi Create/Update ---
    public function store(Request $request)
    {
        Mahasiswa::updateOrCreate(
            ['id' => $request->mahasiswa_id], 
            [
                'nim'             => $request->nim,
                'nama'            => $request->nama,
                'pilihan_prodi_1' => $request->prodi,
                'user_id'         => 1, 
                'nik'             => $request->nik ?? rand(3200000000000000, 3299999999999999), 
                'angkatan'        => date('Y'),
                // Jika sedang edit, pertahankan status lama. Jika baru, set 'baru'.
                'status'          => $request->mahasiswa_id ? Mahasiswa::find($request->mahasiswa_id)->status : 'baru', 
                'tempat_lahir'    => 'Bandung',
                'tgl_lahir'       => '2005-01-01',
                'no_hp'           => '08123456789',
                'alamat'          => 'Alamat Default via AJAX',
            ]
        );        
        return response()->json(['success' => 'Data berhasil disimpan.']);
    }

    public function edit($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        return response()->json($mahasiswa);
    }

    public function destroy($id)
    {
        $mhs = Mahasiswa::find($id);
        if ($mhs->foto && Storage::disk('public')->exists($mhs->foto)) {
            Storage::disk('public')->delete($mhs->foto);
        }
        $mhs->delete();
        return response()->json(['success' => 'Data berhasil dihapus.']);
    }

    // --- Fungsi Pendukung Lain ---
    public function tolak($id) {
        $mhs = Mahasiswa::findOrFail($id);
        $mhs->update(['status' => 'ditolak']);
        return redirect()->back()->with('error', 'Pendaftaran Ditolak.');
    }
    public function cetakPdf($id) {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $pdf = Pdf::loadView('mahasiswa.pdf_kartu', compact('mahasiswa'));
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream('KRS_' . $mahasiswa->nim . '.pdf');
    }
    public function cetakLaporan() {
        $mahasiswa = Mahasiswa::all(); 
        $pdf = Pdf::loadView('mahasiswa.laporan_pdf', compact('mahasiswa'));
        $pdf->setPaper('a4', 'landscape');
        return $pdf->stream('Laporan_Data_Mahasiswa_PMB.pdf');
    }
    public function generateDummyCsv() {}
    public function exportExcel() {
        $fileName = 'Data_Mahasiswa_PMB_' . date('Y-m-d_H-i') . '.csv';
        $mahasiswa = Mahasiswa::latest()->get();
        $headers = ["Content-type" => "text/csv", "Content-Disposition" => "attachment; filename=$fileName", "Pragma" => "no-cache", "Cache-Control" => "must-revalidate, post-check=0, pre-check=0", "Expires" => "0"];
        $columns = array('No', 'NIM', 'Nama', 'Prodi', 'Status', 'Waktu Daftar');
        $callback = function() use($mahasiswa, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            foreach ($mahasiswa as $key => $mhs) {
                $row['No'] = $key + 1; $row['NIM'] = $mhs->nim; $row['Nama'] = $mhs->nama; $row['Prodi'] = $mhs->pilihan_prodi_1; $row['Status'] = ucfirst($mhs->status); $row['Waktu'] = $mhs->created_at->format('Y-m-d H:i:s');
                fputcsv($file, $row);
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
    public function import(Request $request) {
        $request->validate(['file' => 'required|mimes:xlsx,xls,csv|max:2048']);
        try {
            Excel::import(new MahasiswaImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data Mahasiswa berhasil diimport!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}