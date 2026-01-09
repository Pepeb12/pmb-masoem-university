<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB; // Diperlukan untuk query statistik

class DashboardController extends Controller
{
    /**
     * Menampilkan Dashboard Utama
     */
    public function index()
    {
        $user = Auth::user();

        // ==========================================
        // 1. LOGIKA DASHBOARD ADMIN
        // ==========================================
        if ($user->role == 'admin') {
            
            // A. Statistik Card Utama (Total, Baru, Lulus)
            $totalPendaftar = Mahasiswa::count();
            $totalBaru      = Mahasiswa::where('status', 'baru')->count();
            $totalLulus     = Mahasiswa::where('status', 'diverifikasi')->count();

            // B. Data Grafik Tren Pendaftaran (7 Hari Terakhir)
            // Mengambil jumlah pendaftar per tanggal
            $chartData = Mahasiswa::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
                ->where('created_at', '>=', now()->subDays(7))
                ->groupBy('date')
                ->orderBy('date', 'ASC')
                ->get();

            // Memisahkan data tanggal dan total agar mudah dibaca Chart.js
            $dates  = $chartData->pluck('date');
            $totals = $chartData->pluck('total');

            // C. Data Grafik Sebaran Prodi (Top 5 Peminat)
            $prodiData = Mahasiswa::select('pilihan_prodi_1', DB::raw('count(*) as total'))
                ->groupBy('pilihan_prodi_1')
                ->orderByDesc('total')
                ->limit(5)
                ->get();
            
            $prodiLabels = $prodiData->pluck('pilihan_prodi_1');
            $prodiTotals = $prodiData->pluck('total');
            
            // Variabel statistikProdi untuk list text (kompatibilitas dengan view lama)
            $statistikProdi = $prodiData; 

            // D. Tabel Pendaftar Terbaru (5 Orang Terakhir)
            $pendaftarTerbaru = Mahasiswa::latest()->take(5)->get();

            // Kirim semua data ke view
            return view('dashboard', compact(
                'totalPendaftar', 
                'totalBaru', 
                'totalLulus',
                'dates',
                'totals',
                'prodiLabels',
                'prodiTotals',
                'statistikProdi',
                'pendaftarTerbaru'
            ));
        }

        // ==========================================
        // 2. LOGIKA DASHBOARD MAHASISWA
        // ==========================================
        
        // Ambil data pendaftaran milik user yang sedang login
        $mahasiswa = Mahasiswa::where('user_id', $user->id)->first();
        
        return view('dashboard', compact('mahasiswa'));
    }
}