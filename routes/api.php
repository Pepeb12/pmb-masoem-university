<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DataController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// --- PUBLIC ROUTES (Tidak butuh Token) ---
Route::post('/login', [AuthController::class, 'login']);
Route::get('/prodi', [DataController::class, 'listProdi']); // List prodi biasanya public untuk form daftar

// --- PROTECTED ROUTES (Butuh Token Bearer) ---
Route::middleware('auth:sanctum')->group(function () {
    
    // Auth & Profile
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/profile/update', [AuthController::class, 'updateProfile']);

    // Data Master
    Route::get('/dosen', [DataController::class, 'listDosen']);
    Route::get('/mahasiswa', [DataController::class, 'listMahasiswa']);
    
});