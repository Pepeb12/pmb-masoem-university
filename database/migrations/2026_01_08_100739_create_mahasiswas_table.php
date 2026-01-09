<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            
            // Data Akun & Registrasi
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('nim')->unique();
            $table->string('nama');
            $table->string('angkatan');
            
            // --- RELASI DIHAPUS SEMENTARA AGAR TIDAK ERROR ---
            // $table->foreignId('prodi_id')...
            // $table->foreignId('dosen_id')...
            // -------------------------------------------------

            // Biodata Pribadi (Nullable agar aman saat simpan draft)
            $table->string('nik')->nullable();
            $table->string('nisn')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('no_hp')->nullable();
            $table->text('alamat')->nullable();
            
            // Data Sekolah & Pilihan Prodi
            $table->string('asal_sekolah')->nullable();
            $table->string('jurusan_sekolah')->nullable();
            $table->year('tahun_lulus')->nullable();
            $table->string('pilihan_prodi_1')->nullable(); // Menyimpan nama jurusan (teks)
            $table->string('pilihan_prodi_2')->nullable(); // Menyimpan nama jurusan (teks)
            
            // Dokumen & Status
            $table->string('foto')->nullable();
            $table->string('file_ijazah')->nullable();
            $table->string('file_kk')->nullable();
            $table->enum('status', ['baru', 'diverifikasi', 'ditolak'])->default('baru');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mahasiswas');
    }
};