<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PendaftaranController;
use App\Http\Controllers\DosenController;

// ====================================================
// 1. ROUTE PUBLIC
// ====================================================
Route::get('/', function () { return view('welcome'); });
Route::get('/panduan-pendaftaran', function () { return view('panduan'); })->name('panduan');

// ====================================================
// 2. ROUTE WAJIB LOGIN
// ====================================================
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- PROFILE USER ---
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --- PENDAFTARAN (Area Calon Mahasiswa) ---
    Route::get('/pendaftaran', [PendaftaranController::class, 'index'])->name('pendaftaran.index');
    Route::post('/pendaftaran', [PendaftaranController::class, 'store'])->name('pendaftaran.store');
    Route::get('/biodata', [PendaftaranController::class, 'biodata'])->name('pendaftaran.biodata');
    Route::get('/kartu-ujian', [PendaftaranController::class, 'kartu'])->name('pendaftaran.kartu');
    Route::get('/cetak-krs', [PendaftaranController::class, 'cetakKrs'])->name('pendaftaran.cetakKrs');

    // --- ADMIN PENDAFTARAN (Khusus Admin PMB) ---
    // Menggunakan fungsi 'adminIndex' untuk mencegah error looping redirect
    Route::get('/admin/pendaftaran', [PendaftaranController::class, 'adminIndex'])->name('admin.pendaftaran.index');
    Route::get('/admin/pendaftaran/{id}', [PendaftaranController::class, 'show'])->name('admin.pendaftaran.show');
    Route::patch('/admin/pendaftaran/{id}/verifikasi', [PendaftaranController::class, 'verifikasi'])->name('admin.pendaftaran.verifikasi');
    Route::patch('/admin/pendaftaran/{id}/tolak', [PendaftaranController::class, 'tolak'])->name('admin.pendaftaran.tolak');

    // --- MASTER DATA MAHASISWA ---
    // Route custom diletakkan sebelum resource agar tidak tertimpa
    Route::get('mahasiswa/cetak-laporan', [MahasiswaController::class, 'cetakLaporan'])->name('mahasiswa.cetakLaporan');
    Route::get('mahasiswa/export-excel', [MahasiswaController::class, 'exportExcel'])->name('mahasiswa.exportExcel');
    Route::get('mahasiswa/export', [MahasiswaController::class, 'export'])->name('mahasiswa.export');
    Route::post('mahasiswa/import', [MahasiswaController::class, 'import'])->name('mahasiswa.import');
    Route::get('mahasiswa/{id}/cetak-pdf', [MahasiswaController::class, 'cetakPdf'])->name('mahasiswa.cetakPdf');
    Route::get('mahasiswa/generate-dummy', [MahasiswaController::class, 'generateDummyCsv']); // Route Sementara
    
    Route::resource('mahasiswa', MahasiswaController::class);

    // --- MASTER DATA DOSEN ---
    Route::resource('dosen', DosenController::class);

});

require __DIR__.'/auth.php';