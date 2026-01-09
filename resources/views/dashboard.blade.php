<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <x-slot name="header">
        <div class="bg-gray-800 -m-6 mb-6 p-8 pt-10 pb-20 text-white rounded-b-3xl shadow-lg relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="relative z-10 max-w-7xl mx-auto flex justify-between items-center">
                <div>
                    <h2 class="font-extrabold text-3xl leading-tight">
                        @if(Auth::user()->role == 'admin')
                            Dashboard Monitoring
                        @else
                            Halo, {{ Auth::user()->name }}! 👋
                        @endif
                    </h2>
                    <p class="text-gray-400 mt-2 text-lg">
                        @if(Auth::user()->role == 'admin')
                            Pantau statistik pendaftaran mahasiswa baru secara realtime.
                        @else
                            Pantau status pendaftaran Anda di sini.
                        @endif
                    </p>
                </div>
                
                @if(Auth::user()->role == 'admin')
                <div class="text-right hidden md:block">
                    <p class="text-sm text-gray-400">Tanggal Hari Ini</p>
                    <p class="text-xl font-bold">{{ date('d F Y') }}</p>
                </div>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20 pb-12">
        
        @if(Auth::user()->role == 'admin')
        
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-xl">
                        {{ $totalPendaftar ?? 0 }}
                    </div>
                    <div>
                        <h4 class="text-gray-500 text-xs font-bold uppercase">Total Pendaftar</h4>
                        <p class="text-gray-800 font-bold text-sm">Semua Jalur</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center font-bold text-xl">
                        {{ $totalBaru ?? 0 }}
                    </div>
                    <div>
                        <h4 class="text-gray-500 text-xs font-bold uppercase">Perlu Verifikasi</h4>
                        <p class="text-gray-800 font-bold text-sm">Status Baru</p>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition">
                    <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold text-xl">
                        {{ $totalLulus ?? 0 }}
                    </div>
                    <div>
                        <h4 class="text-gray-500 text-xs font-bold uppercase">Diterima</h4>
                        <p class="text-gray-800 font-bold text-sm">Lulus Seleksi</p>
                    </div>
                </div>

                <a href="{{ route('profile.edit') }}" class="bg-gray-800 p-6 rounded-xl shadow-sm border border-gray-700 flex items-center gap-4 hover:bg-gray-700 transition group cursor-pointer">
                    <div class="w-12 h-12 bg-gray-600 text-white rounded-full flex items-center justify-center font-bold text-xl group-hover:bg-gray-500">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <h4 class="text-gray-400 text-xs font-bold uppercase">Akun Admin</h4>
                        <p class="text-white font-bold text-sm">Pengaturan</p>
                    </div>
                </a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                
                <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold text-gray-800">Tren Pendaftaran (7 Hari Terakhir)</h3>
                        <span class="text-xs bg-blue-50 text-blue-600 px-2 py-1 rounded font-bold animate-pulse">Live Data</span>
                    </div>
                    <div class="relative h-72 w-full">
                        <canvas id="trendChart"></canvas>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 mb-6">Top 5 Program Studi</h3>
                    <div class="relative h-60 w-full flex justify-center">
                        <canvas id="prodiChart"></canvas>
                    </div>
                    <div class="mt-4 text-center">
                        <p class="text-xs text-gray-400">Berdasarkan Pilihan 1</p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                
                <div class="lg:col-span-2 bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                        <h3 class="font-bold text-gray-800">5 Pendaftar Masuk Terakhir</h3>
                        <a href="{{ route('admin.pendaftaran.index') }}" class="text-xs text-blue-600 hover:underline font-semibold">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3">Nama</th>
                                    <th class="px-6 py-3">Prodi</th>
                                    <th class="px-6 py-3">Waktu</th>
                                    <th class="px-6 py-3">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendaftarTerbaru as $mhs)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-3 font-medium text-gray-900">{{ $mhs->nama }}</td>
                                    <td class="px-6 py-3 truncate max-w-xs">{{ $mhs->pilihan_prodi_1 }}</td>
                                    <td class="px-6 py-3 text-xs">{{ $mhs->created_at->diffForHumans() }}</td>
                                    <td class="px-6 py-3">
                                        @if($mhs->status == 'baru')
                                            <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2 py-0.5 rounded">Baru</span>
                                        @elseif($mhs->status == 'diverifikasi')
                                            <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-0.5 rounded">Lulus</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs font-bold px-2 py-0.5 rounded">Ditolak</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-gray-400">Belum ada data pendaftar baru.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl p-6 text-white shadow-lg flex flex-col justify-between">
                    <div>
                        <h3 class="text-xl font-bold mb-2">Aksi Cepat</h3>
                        <p class="text-blue-100 text-sm mb-6">Menu pintas pengelolaan data.</p>
                        
                        <div class="space-y-3">
                            <a href="{{ route('admin.pendaftaran.index') }}" class="block w-full bg-white/10 hover:bg-white/20 border border-white/20 p-3 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                Verifikasi Berkas
                            </a>
                            
                            <a href="{{ route('mahasiswa.exportExcel') }}" class="block w-full bg-white/10 hover:bg-white/20 border border-white/20 p-3 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"></path>
                                </svg>
                                Download Data Excel (CSV)
                            </a>

                            <a href="{{ route('mahasiswa.cetakLaporan') }}" target="_blank" class="block w-full bg-white/10 hover:bg-white/20 border border-white/20 p-3 rounded-lg text-sm font-semibold transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                Cetak Laporan PDF
                            </a>
                        </div>
                    </div>
                    <div class="mt-6 pt-6 border-t border-white/10 text-xs text-blue-200">
                        PMB System v1.0 • Masoem University
                    </div>
                </div>
            </div>

            <script>
                // Data dari Controller
                const dates = @json($dates);
                const totals = @json($totals);
                const prodiLabels = @json($prodiLabels);
                const prodiTotals = @json($prodiTotals);

                // 1. Config Grafik Tren
                const ctxTrend = document.getElementById('trendChart').getContext('2d');
                new Chart(ctxTrend, {
                    type: 'line',
                    data: {
                        labels: dates,
                        datasets: [{
                            label: 'Jumlah Pendaftar',
                            data: totals,
                            borderColor: '#2563EB', // Blue 600
                            backgroundColor: 'rgba(37, 99, 235, 0.1)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
                    }
                });

                // 2. Config Grafik Prodi
                const ctxProdi = document.getElementById('prodiChart').getContext('2d');
                new Chart(ctxProdi, {
                    type: 'doughnut',
                    data: {
                        labels: prodiLabels,
                        datasets: [{
                            data: prodiTotals,
                            backgroundColor: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { 
                            legend: { position: 'bottom', labels: { boxWidth: 10, font: { size: 11 } } } 
                        }
                    }
                });
            </script>

        @else
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-bold mb-4 border-b pb-2">Status Pendaftaran</h3>
                        
                        @if($mahasiswa)
                            <div class="mb-4">
                                <p class="text-sm text-gray-500 mb-1">Status Saat Ini:</p>
                                @if($mahasiswa->status == 'baru')
                                    <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded-lg font-bold flex items-center gap-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Menunggu Verifikasi Admin
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">Data Anda sedang diperiksa. Mohon cek berkala.</p>
                                @elseif($mahasiswa->status == 'diverifikasi')
                                    <div class="bg-green-100 text-green-800 px-4 py-3 rounded-lg font-bold flex items-center gap-2">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        Selamat! Anda Diterima
                                    </div>
                                    <p class="text-xs text-green-600 mt-2">Silakan tunggu info daftar ulang.</p>
                                @else
                                    <div class="bg-red-100 text-red-800 px-4 py-3 rounded-lg font-bold flex items-center gap-2">
                                        Maaf, Pendaftaran Ditolak
                                    </div>
                                @endif
                            </div>

                            <div class="mt-6">
                                <a href="{{ route('pendaftaran.biodata') }}" class="block w-full text-center bg-blue-600 text-white px-4 py-3 rounded-lg hover:bg-blue-700 transition font-bold shadow-md">
                                    Lihat Biodata Lengkap Saya
                                </a>
                            </div>
                        @else
                            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-4">
                                <p class="text-red-700 font-bold">Anda belum mengisi formulir.</p>
                            </div>
                            <a href="{{ route('pendaftaran.index') }}" class="block w-full text-center bg-indigo-600 text-white px-6 py-3 rounded-lg font-bold hover:bg-indigo-700 transition shadow-lg animate-pulse">
                                Isi Formulir Pendaftaran Sekarang →
                            </a>
                        @endif
                    </div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="font-bold mb-4 border-b pb-2">Informasi Penting</h3>
                        <ul class="space-y-3 text-sm text-gray-600">
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>Pastikan data <strong>NIK</strong> sesuai KTP/Ijazah.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span>Verifikasi data maksimal <strong>1x24 jam kerja</strong>.</span>
                            </li>
                        </ul>
                        <div class="mt-8 p-4 bg-blue-50 rounded-xl border border-blue-100">
                            <p class="font-bold text-blue-800 mb-1">Butuh Bantuan?</p>
                            <a href="https://wa.me/6289512336537" target="_blank" class="text-sm text-blue-600 hover:underline flex items-center gap-1">
                                Hubungi Admin via WhatsApp
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        
    </div>
</x-app-layout>