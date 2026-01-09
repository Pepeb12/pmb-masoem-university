<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    /**
     * Mass Assignable fields
     * Mendaftarkan semua kolom agar bisa disimpan ke database
     */
    protected $fillable = [
      
    'user_id', 'nim', 'nama', 'angkatan',
    // 'prodi_id', 'dosen_id',  <-- HAPUS INI
    'nik', 'nisn', 'tempat_lahir', 'tgl_lahir', 'jenis_kelamin', 
    'no_hp', 'alamat', 'asal_sekolah', 'jurusan_sekolah', 
    'tahun_lulus', 'pilihan_prodi_1', 'pilihan_prodi_2', 'status',
    'foto', 'file_ijazah', 'file_kk'
];
    

    /**
     * RELASI DATABASE
     */

    // Relasi ke Akun User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Program Studi (Jika menggunakan tabel Prodi)
    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    // Relasi ke Dosen Wali (Jika menggunakan tabel Dosen)
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }
}