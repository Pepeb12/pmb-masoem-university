<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    // PENTING: Daftar kolom yang diizinkan untuk diisi (Mass Assignment)
    protected $fillable = [
        'kode_dosen', // Wajib ada agar tidak error "Field doesn't have default value"
        'nama_dosen',
        'nidn',
        'prodi',
        'email',
        'no_hp'
    ];

    /**
     * Relasi: Satu Dosen bisa memiliki banyak Mahasiswa (Dosen Wali)
     */
    public function mahasiswas() {
        return $this->hasMany(Mahasiswa::class);
    }
}