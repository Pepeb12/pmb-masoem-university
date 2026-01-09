<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    // 1. TAMPILKAN DATA
    public function index()
    {
        $dosens = Dosen::latest()->get();
        return view('dosen.index', compact('dosens'));
    }

    // 2. FORM TAMBAH
    public function create()
    {
        return view('dosen.create');
    }

    // 3. SIMPAN DATA (SUDAH DIPERBAIKI)
    public function store(Request $request)
    {
        // Validasi Input
        $request->validate([
            'kode_dosen' => 'required|unique:dosens,kode_dosen',
            'nama_dosen' => 'required|string|max:255',
            'nidn'       => 'required|numeric', // Pastikan numeric jika NIDN hanya angka
            'prodi'      => 'required|string',
        ]);

        // Simpan ke Database
        Dosen::create([
            'kode_dosen' => $request->kode_dosen,
            'nama_dosen' => $request->nama_dosen,
            'nidn'       => $request->nidn,
            'prodi'      => $request->prodi,
        ]);

        return redirect()->route('dosen.index')->with('success', 'Data Dosen Berhasil Ditambahkan');
    }

    // 4. FORM EDIT
    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', compact('dosen'));
    }

    // 5. UPDATE DATA (DISESUAIKAN DENGAN KOLOM BARU)
    public function update(Request $request, Dosen $dosen)
    {
        $request->validate([
            // Unique tapi abaikan ID dosen ini sendiri
            'kode_dosen' => 'required|unique:dosens,kode_dosen,' . $dosen->id,
            'nama_dosen' => 'required|string|max:255',
            'nidn'       => 'required',
            'prodi'      => 'required',
        ]);

        $dosen->update([
            'kode_dosen' => $request->kode_dosen,
            'nama_dosen' => $request->nama_dosen,
            'nidn'       => $request->nidn,
            'prodi'      => $request->prodi,
        ]);

        return redirect()->route('dosen.index')->with('success', 'Data Dosen Berhasil Diupdate');
    }

    // 6. HAPUS DATA
    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return redirect()->route('dosen.index')->with('success', 'Data Dosen Berhasil Dihapus');
    }
}