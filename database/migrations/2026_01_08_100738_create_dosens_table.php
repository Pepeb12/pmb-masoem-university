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
        Schema::create('dosens', function (Blueprint $table) {
            $table->id();
            
            // Kolom Wajib (Sesuai Controller)
            $table->string('kode_dosen')->unique(); // Ini yang tadi menyebabkan error
            $table->string('nama_dosen');
            
            // Kolom Opsional
            $table->string('nidn')->nullable();
            $table->string('prodi')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosens');
    }
};