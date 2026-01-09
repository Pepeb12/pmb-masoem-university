<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Mahasiswa;
use Faker\Factory as Faker;
use Carbon\Carbon;

class MahasiswaSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Daftar Prodi di Masoem University
        $prodis = [
            'S1 Sistem Informasi',
            'S1 Teknik Informatika',
            'D3 Manajemen Informatika',
            'S1 Bisnis Digital',
            'S1 Perbankan Syariah',
            'S1 Teknologi Pangan',
            'S1 Agribisnis',
            'S1 Pendidikan Bahasa Inggris',
        ];

        // Status pendaftaran
        $statuses = ['baru', 'diverifikasi', 'ditolak'];

        echo "Menambahkan 25 Data Calon Mahasiswa Dummy (Tanpa Gelar)...\n";

        for ($i = 0; $i < 25; $i++) {
            // Random tanggal pendaftaran (dalam 30 hari terakhir)
            $tanggalDaftar = Carbon::now()->subDays(rand(0, 30));

            
            // Kita gabungkan Nama Depan + Nama Belakang
            $namaPolos = $faker->firstName . ' ' . $faker->lastName;

            Mahasiswa::create([
                'user_id'         => 1, // Numpang ID admin
                'nim'             => $faker->unique()->numerify('25#####'), // NIM Angkatan 25
                'nama'            => $namaPolos, // Menggunakan nama tanpa gelar
                'nik'             => $faker->unique()->numerify('32##############'),
                'angkatan'        => date('Y'),
                'pilihan_prodi_1' => $faker->randomElement($prodis), // Acak Jurusan
                'tempat_lahir'    => $faker->city,
                'tgl_lahir'       => $faker->date('Y-m-d', '2006-01-01'),
                'jenis_kelamin'   => $faker->randomElement(['L', 'P']),
                'no_hp'           => $faker->phoneNumber,
                'alamat'          => $faker->address,
                'asal_sekolah'    => 'SMA ' . $faker->city,
                'jurusan_sekolah' => $faker->randomElement(['IPA', 'IPS', 'SMK TKJ', 'SMK RPL']),
                'tahun_lulus'     => 2024,
                'status'          => $faker->randomElement($statuses), 
                'foto'            => null, 
                'created_at'      => $tanggalDaftar,
                'updated_at'      => $tanggalDaftar,
            ]);
        }

        echo "Selesai! 25 Data berhasil ditambahkan.";
    }
}