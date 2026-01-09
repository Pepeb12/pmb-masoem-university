<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MahasiswaController extends Controller
{
    // ========================
    // CRUD DATA MAHASISWA
    // ========================

    // 1. MENAMPILKAN DATA (READ)
    public function index()
    {
        // Menggunakan with() untuk optimalisasi query jika relasi digunakan
        // Jika tidak ada relasi di model, hapus with(['prodi', 'dosen'])
        $mahasiswas = Mahasiswa::latest()->get();
        return view('mahasiswa.index', compact('mahasiswas'));
    }

    // 2. FORM TAMBAH DATA (CREATE)
    public function create()
    {
        $prodis = Prodi::all();
        $dosens = Dosen::all();
        return view('mahasiswa.create', compact('prodis', 'dosens'));
    }

    // 3. PROSES SIMPAN DATA (STORE)
    public function store(Request $request)
    {
        // Validasi, sesuaikan dengan kolom database Anda
        $request->validate([
            'nim'      => 'required|unique:mahasiswas,nim',
            'nama'     => 'required|string|max:255',
            'angkatan' => 'required|numeric',
            // 'prodi_id' => 'required|exists:prodis,id', // Aktifkan jika relasi sudah ada
            // 'dosen_id' => 'required|exists:dosens,id', // Aktifkan jika relasi sudah ada
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotos', 'public');
        }

        Mahasiswa::create([
            'nim'             => $request->nim,
            'nama'            => $request->nama,
            'angkatan'        => $request->angkatan,
            'prodi_id'        => $request->prodi_id ?? null,
            'dosen_id'        => $request->dosen_id ?? null,
            'pilihan_prodi_1' => $request->prodi_1 ?? '-', // Fallback jika kolom ada
            'foto'            => $fotoPath,
            'status'          => 'baru',
        ]);

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa Berhasil Ditambahkan');
    }

    // 4. MENAMPILKAN DETAIL DATA (SHOW)
    public function show(Mahasiswa $mahasiswa)
    {
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    // 5. FORM EDIT DATA (EDIT)
    public function edit(Mahasiswa $mahasiswa)
    {
        $prodis = Prodi::all();
        $dosens = Dosen::all();
        return view('mahasiswa.edit', compact('mahasiswa', 'prodis', 'dosens'));
    }

    // 6. PROSES UPDATE DATA (UPDATE)
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $request->validate([
            'nim'      => 'required|unique:mahasiswas,nim,' . $mahasiswa->id,
            'nama'     => 'required|string|max:255',
            'angkatan' => 'required|numeric',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['foto']);

        // Upload Foto Baru & Hapus Lama
        if ($request->hasFile('foto')) {
            if ($mahasiswa->foto && Storage::disk('public')->exists($mahasiswa->foto)) {
                Storage::disk('public')->delete($mahasiswa->foto);
            }
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $mahasiswa->update($data);

        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa Berhasil Diupdate');
    }

    // 7. HAPUS DATA (DELETE)
    public function destroy(Mahasiswa $mahasiswa)
    {
        if ($mahasiswa->foto && Storage::disk('public')->exists($mahasiswa->foto)) {
            Storage::disk('public')->delete($mahasiswa->foto);
        }

        $mahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data Mahasiswa Berhasil Dihapus');
    }

    // ========================
    // FITUR VERIFIKASI
    // ========================

    public function verifikasi($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        $mhs->update(['status' => 'diverifikasi']);
        return redirect()->back()->with('success', 'Data Mahasiswa Berhasil Diverifikasi!');
    }

    public function tolak($id)
    {
        $mhs = Mahasiswa::findOrFail($id);
        $mhs->update(['status' => 'ditolak']);
        return redirect()->back()->with('error', 'Pendaftaran Ditolak.');
    }

    // ========================
    // FITUR CETAK PDF
    // ========================

    // 1. Cetak Kartu Per Mahasiswa
    public function cetakPdf($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $pdf = Pdf::loadView('mahasiswa.pdf_kartu', compact('mahasiswa'));
        $pdf->setPaper('a4', 'portrait');
        return $pdf->stream('KRS_' . $mahasiswa->nim . '.pdf');
    }

    // 2. Cetak Laporan Rekap Semua Mahasiswa
    public function cetakLaporan()
    {
        // Ambil semua data
        $mahasiswa = Mahasiswa::all(); 

        // Load View PDF
        $pdf = Pdf::loadView('mahasiswa.laporan_pdf', compact('mahasiswa'));
        
        // Atur Kertas
        $pdf->setPaper('a4', 'landscape');

        // Tampilkan
        return $pdf->stream('Laporan_Data_Mahasiswa_PMB.pdf');
    }

    // ========================
    // FITUR EXPORT / IMPORT EXCEL
    // ========================

    // 1. EXPORT CSV MANUAL (Native PHP - Tanpa Library Berat)
    public function exportExcel()
    {
        $fileName = 'Data_Mahasiswa_PMB_' . date('Y-m-d_H-i') . '.csv';
        $mahasiswa = Mahasiswa::latest()->get();

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('No', 'NIM/No.Daftar', 'Nama Lengkap', 'NIK', 'Tempat Lahir', 'Tanggal Lahir', 'Jenis Kelamin', 'No HP', 'Alamat', 'Asal Sekolah', 'Jurusan Sekolah', 'Tahun Lulus', 'Pilihan Prodi 1', 'Pilihan Prodi 2', 'Status', 'Waktu Daftar');

        $callback = function() use($mahasiswa, $columns) {
            $file = fopen('php://output', 'w');
            
            // Tulis Header Kolom
            fputcsv($file, $columns);

            // Tulis Data Baris per Baris
            foreach ($mahasiswa as $key => $mhs) {
                $row['No']              = $key + 1;
                $row['NIM']             = $mhs->nim;
                $row['Nama']            = $mhs->nama;
                
                // Tambahkan tanda kutip satu (') agar Excel membacanya sebagai teks, bukan angka ilmiah
                $row['NIK']             = "'" . $mhs->nik; 
                
                $row['Tempat Lahir']    = $mhs->tempat_lahir;
                $row['Tanggal Lahir']   = $mhs->tgl_lahir;
                $row['Jenis Kelamin']   = $mhs->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan';
                $row['No HP']           = "'" . $mhs->no_hp;
                $row['Alamat']          = $mhs->alamat;
                $row['Asal Sekolah']    = $mhs->asal_sekolah;
                $row['Jurusan Sekolah'] = $mhs->jurusan_sekolah;
                $row['Tahun Lulus']     = $mhs->tahun_lulus;
                $row['Prodi 1']         = $mhs->pilihan_prodi_1;
                $row['Prodi 2']         = $mhs->pilihan_prodi_2;
                $row['Status']          = ucfirst($mhs->status);
                $row['Waktu']           = $mhs->created_at->format('Y-m-d H:i:s');

                fputcsv($file, array(
                    $row['No'], 
                    $row['NIM'], 
                    $row['Nama'], 
                    $row['NIK'], 
                    $row['Tempat Lahir'],
                    $row['Tanggal Lahir'],
                    $row['Jenis Kelamin'],
                    $row['No HP'],
                    $row['Alamat'],
                    $row['Asal Sekolah'],
                    $row['Jurusan Sekolah'],
                    $row['Tahun Lulus'],
                    $row['Prodi 1'],
                    $row['Prodi 2'],
                    $row['Status'],
                    $row['Waktu']
                ));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
// ... kode sebelumnya ...

    // ============================================
    // FUNGSI KHUSUS: GENERATE DUMMY CSV (102 DATA)
    // ============================================
    public function generateDummyCsv()
    {
        $fileName = '102_Data_Mahasiswa_Dummy.csv';
        
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        // Header sesuai urutan database/import
        // Pastikan urutan ini SAMA dengan file MahasiswaImport.php Anda
        $columns = array('nim', 'nama', 'nik', 'angkatan', 'pilihan_prodi_1', 'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 'no_hp', 'alamat', 'asal_sekolah', 'jurusan_sekolah', 'tahun_lulus');

        // Data Random
        $prodis = [
            'S1 Sistem Informasi', 
            'S1 Teknik Informatika', 
            'D3 Manajemen Informatika', 
            'S1 Agribisnis', 
            'S1 Teknologi Pangan'
        ];

        $callback = function() use($columns, $prodis) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns); // Tulis Header

            // Loop 102 kali
            for ($i = 1; $i <= 102; $i++) {
                
                // Random Data
                $nim    = '24' . str_pad($i, 4, '0', STR_PAD_LEFT); // 240001, 240002...
                $nama   = "Calon Mahasiswa Baru " . $i;
                $nik    = "3204" . rand(100000000000, 999999999999);
                $prodi  = $prodis[array_rand($prodis)]; // Pilih prodi acak
                $jk     = ($i % 2 == 0) ? 'P' : 'L'; // Selang seling L/P
                
                $row = [
                    $nim,
                    $nama,
                    $nik,
                    '2024',         // Angkatan
                    $prodi,         // Prodi
                    'Bandung',      // Tempat Lahir
                    '2005-01-01',   // Tgl Lahir
                    $jk,            // JK
                    '08' . rand(100000000, 999999999), // No HP
                    'Jl. Raya Percobaan No. ' . $i, // Alamat
                    'SMA Negeri ' . rand(1, 10) . ' Bandung', // Asal Sekolah
                    'IPA',          // Jurusan Sekolah
                    '2023'          // Tahun Lulus
                ];

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    // 2. IMPORT EXCEL (Tetap Pakai Maatwebsite untuk Membaca File)
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        try {
            Excel::import(new MahasiswaImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data Mahasiswa berhasil diimport!');
        } catch (ValidationException $e) {
            $failures = $e->failures();
            $errorMsg = 'Gagal Import:<br><ul>';
            
            foreach ($failures as $failure) {
                $errorMsg .= '<li>Baris ' . $failure->row() . ': ' . implode(', ', $failure->errors()) . '</li>';
            }
            $errorMsg .= '</ul>';

            return redirect()->back()->with('error', $errorMsg);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }
}