<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Dosen;
use App\Models\Mahasiswa;

class DataController extends Controller
{
    public function listProdi()
    {
        $prodi = Prodi::all();
        return response()->json(['status' => 'success', 'data' => $prodi]);
    }

    public function listDosen()
    {
        $dosen = Dosen::all();
        return response()->json(['status' => 'success', 'data' => $dosen]);
    }

    public function listMahasiswa()
    {
        // Mengambil data mahasiswa beserta relasi prodi
        $mahasiswa = Mahasiswa::with('prodi')->latest()->get();
        return response()->json(['status' => 'success', 'data' => $mahasiswa]);
    }
}