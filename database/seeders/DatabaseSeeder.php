<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Prodi;
use App\Models\Dosen;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. User Admin
        User::updateOrCreate(
            ['email' => 'admin@masoem.ac.id'],
            [
                'name' => 'Admin PMB',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );

        // 2. User Mahasiswa
        User::updateOrCreate(
            ['email' => 'maba@gmail.com'],
            [
                'name' => 'Calon Mahasiswa',
                'password' => bcrypt('password'),
                'role' => 'mahasiswa',
            ]
        );

        // 3. Prodi
        // Menggunakan daftar prodi yang lebih lengkap
        $daftarProdi = [
            'S1 Sistem Informasi',
            'S1 Bisnis Digital',
            'S1 Teknik Informatika',
            'D3 Manajemen Informatika',
            'S1 Perbankan Syariah',
            'S1 Teknologi Pangan',
            'S1 Agribisnis',
            'S1 Pendidikan Bahasa Inggris',
            'S1 Informatika',
            'S1 Teknik Industri',
        ];
        
        // Cek class Prodi untuk menghindari error jika model belum ada
        if (class_exists(Prodi::class)) {
            foreach ($daftarProdi as $nama) {
                Prodi::firstOrCreate(['nama_prodi' => $nama]);
            }
        }

        // 4. Dosen (PASTIKAN KODE_DOSEN ADA DI SINI)
        Dosen::updateOrCreate(
            ['kode_dosen' => 'DSN001'], 
            [
                'nidn'       => '12345',
                'nama_dosen' => 'Bpk. Iin Solihin',
                'prodi'      => 'S1 Sistem Informasi'
            ]
        );

        Dosen::updateOrCreate(
            ['kode_dosen' => 'DSN002'],
            [
                'nidn'       => '67890',
                'nama_dosen' => 'Ibu Dosen Contoh',
                'prodi'      => 'S1 Teknik Informatika'
            ]
        );

        // 5. Mahasiswa Dummy
        $this->call([MahasiswaSeeder::class]);
    }
}