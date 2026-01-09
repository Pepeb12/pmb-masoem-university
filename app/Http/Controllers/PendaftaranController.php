<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class PendaftaranController extends Controller
{
    // ============================================
    // 1. BAGIAN MAHASISWA (USER)
    // ============================================

    /**
     * TAMPILKAN FORM PENDAFTARAN
     * Logika: Jika Admin -> Redirect ke Halaman Admin.
     * Jika Mahasiswa -> Cek sudah daftar belum?
     */
    public function index()
    {
        $user = Auth::user();
        
        // JIKA ADMIN: Jangan tampilkan form, tapi alihkan ke Dashboard Admin khusus
        if ($user->role === 'admin') {
            return redirect()->route('admin.pendaftaran.index');
        }

        // Cek apakah mahasiswa sudah mendaftar?
        $cek = Mahasiswa::where('user_id', $user->id)->first();
        
        // Jika sudah daftar, alihkan ke biodata
        if ($cek) {
            return redirect()->route('pendaftaran.biodata');
        }

        return view('pendaftaran.index');
    }

    /**
     * SIMPAN DATA PENDAFTARAN
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim'             => 'required|unique:mahasiswas,nim',
            'nama'            => 'required|string|max:255',
            'nik'             => 'required|numeric',
            'tempat_lahir'    => 'required|string',
            'tgl_lahir'       => 'required|date',
            'jenis_kelamin'   => 'required',
            'no_hp'           => 'required',
            'alamat'          => 'required',
            'asal_sekolah'    => 'required',
            'jurusan_sekolah' => 'required',
            'tahun_lulus'     => 'required|numeric',
            'pilihan_prodi_1' => 'required',
            'foto'            => 'required|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('fotos', 'public');
        }

        Mahasiswa::create([
            'user_id'         => Auth::id(),
            'nim'             => $request->nim, 
            'nama'            => $request->nama,
            'nik'             => $request->nik,
            'angkatan'        => date('Y'),
            'pilihan_prodi_1' => $request->pilihan_prodi_1,
            'tempat_lahir'    => $request->tempat_lahir,
            'tgl_lahir'       => $request->tgl_lahir,
            'jenis_kelamin'   => $request->jenis_kelamin,
            'no_hp'           => $request->no_hp,
            'alamat'          => $request->alamat,
            'asal_sekolah'    => $request->asal_sekolah,
            'jurusan_sekolah' => $request->jurusan_sekolah,
            'tahun_lulus'     => $request->tahun_lulus,
            'foto'            => $fotoPath,
            'status'          => 'baru',
        ]);

        return redirect()->route('dashboard')
            ->with('success', 'Pendaftaran Berhasil! Data Anda sedang diverifikasi.');
    }

    /**
     * TAMPILKAN BIODATA SAYA
     */
    public function biodata()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if (!$mahasiswa) {
            return redirect()->route('pendaftaran.index')
                ->with('error', 'Silakan isi formulir pendaftaran terlebih dahulu.');
        }

        return view('pendaftaran.biodata', compact('mahasiswa'));
    }

    /**
     * CETAK KARTU UJIAN
     */
    public function kartu()
    {
        $mahasiswa = Mahasiswa::where('user_id', Auth::id())->first();
        if (!$mahasiswa) return redirect()->route('pendaftaran.index');
        return view('pendaftaran.kartu', compact('mahasiswa'));
    }

    /**
     * CETAK KRS (SEMESTER 1)
     */
    public function cetakKrs()
    {
        $user = Auth::user();
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();

        if (!$mahasiswa || $mahasiswa->status != 'diverifikasi') {
            return back()->with('error', 'Data belum diverifikasi atau belum lengkap.');
        }

        // Data Dummy Paket Semester 1
        $matkul = [
            ['kode' => 'MKU101', 'nama' => 'Pendidikan Agama', 'sks' => 2],
            ['kode' => 'MKU102', 'nama' => 'Pancasila & Kewarganegaraan', 'sks' => 2],
            ['kode' => 'MKU103', 'nama' => 'Bahasa Indonesia', 'sks' => 2],
            ['kode' => 'MKU104', 'nama' => 'Bahasa Inggris I', 'sks' => 2],
            ['kode' => 'MKK201', 'nama' => 'Algoritma & Pemrograman', 'sks' => 3],
            ['kode' => 'MKK202', 'nama' => 'Pengantar Teknologi Informasi', 'sks' => 3],
            ['kode' => 'MKK203', 'nama' => 'Matematika Diskrit', 'sks' => 3],
            ['kode' => 'MKK204', 'nama' => 'Logika Informatika', 'sks' => 3],
        ];
        $totalSks = array_sum(array_column($matkul, 'sks'));

        $pdf = Pdf::loadView('pendaftaran.krs_pdf', compact('mahasiswa', 'matkul', 'totalSks'));
        return $pdf->stream('KRS_' . $mahasiswa->nim . '.pdf');
    }

    // ============================================
    // 2. BAGIAN ADMIN (ADMINISTRATOR)
    // ============================================

    /**
     * HALAMAN UTAMA ADMIN (List Pendaftar)
     * Menggunakan view 'mahasiswa.index' yang sudah bagus tampilannya
     */
   /**
     * HALAMAN UTAMA ADMIN (List Pendaftar)
     */
    public function adminIndex()
    {
        // Ambil semua data untuk tabel utama
        $mahasiswas = Mahasiswa::latest()->get();

        // Ambil data KHUSUS yang statusnya 'baru' untuk notifikasi di atas
        $pendaftarBaru = Mahasiswa::where('status', 'baru')->latest()->get();

        return view('mahasiswa.index', compact('mahasiswas', 'pendaftarBaru'));
    }
    /**
     * DETAIL MAHASISWA (ADMIN)
     */
    public function show($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        return view('admin.pendaftaran.show', compact('mahasiswa'));
    }

    /**
     * AKSI VERIFIKASI
     */
    public function verifikasi($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update(['status' => 'diverifikasi']);
        return back()->with('success', 'Data Mahasiswa Berhasil Diverifikasi!');
    }

    /**
     * AKSI TOLAK
     */
    public function tolak($id)
    {
        $mahasiswa = Mahasiswa::findOrFail($id);
        $mahasiswa->update(['status' => 'ditolak']);
        return back()->with('warning', 'Pendaftaran Mahasiswa Ditolak.');
    }
}