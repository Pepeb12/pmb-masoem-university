<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Administrator') }}
        </h2>
    </x-slot>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="py-12"> 
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border-l-8 border-blue-600 flex items-center justify-between transition hover:shadow-lg">
                    <div>
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Total Pendaftar</p>
                        <p class="text-4xl font-extrabold text-gray-800 dark:text-white">{{ $totalMhs }}</p>
                    </div>
                    <div class="p-4 bg-blue-50 rounded-full text-blue-600">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border-l-8 border-indigo-500 flex items-center justify-between transition hover:shadow-lg">
                    <div>
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Program Studi</p>
                        <p class="text-4xl font-extrabold text-gray-800 dark:text-white">{{ $totalProdi }}</p>
                    </div>
                    <div class="p-4 bg-indigo-50 rounded-full text-indigo-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6 border-l-8 border-green-500 flex items-center justify-between transition hover:shadow-lg">
                    <div>
                        <p class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-1">Status Server</p>
                        <p class="text-3xl font-extrabold text-green-600">ONLINE</p>
                    </div>
                    <div class="p-4 bg-green-50 rounded-full text-green-500">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M5 12a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v4a2 2 0 01-2 2M5 12a2 2 0 00-2 2v4a2 2 0 002 2h14a2 2 0 002-2v-4a2 2 0 00-2-2m-2-4h.01M17 16h.01"></path></svg>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8 border border-gray-100">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">Statistik Peminat Prodi</h3>
                    </div>
                    <div class="h-80"> <canvas id="prodiChart"></canvas>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-6">Menu Pintas</h3>
                    <div class="space-y-4">
                        <a href="{{ route('mahasiswa.index') }}" class="flex items-center justify-between p-4 text-base font-medium rounded-lg border border-blue-200 bg-blue-50 text-blue-800 hover:bg-blue-100 hover:shadow transition">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                Data Mahasiswa
                            </div>
                            <span>&rarr;</span>
                        </a>
                        
                        <a href="{{ route('mahasiswa.create') }}" class="flex items-center justify-between p-4 text-base font-medium rounded-lg border border-green-200 bg-green-50 text-green-800 hover:bg-green-100 hover:shadow transition">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Input Manual
                            </div>
                            <span>+</span>
                        </a>

                        <a href="{{ route('mahasiswa.cetakLaporan') }}" target="_blank" class="w-full flex items-center justify-between p-4 text-base font-medium rounded-lg border border-gray-200 bg-gray-50 text-gray-700 hover:bg-gray-100 hover:shadow transition">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 mr-3 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                Download Laporan PDF
                            </div>
                            <span class="text-gray-400">&darr;</span>
                        </a>

                    </div>
                </div>
            </div>

            <div class="mt-8 bg-white dark:bg-gray-800 shadow-lg rounded-xl p-8 border border-gray-100">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-gray-200">Pendaftar Terbaru</h3>
                    <a href="{{ route('mahasiswa.index') }}" class="text-sm font-bold text-blue-600 hover:text-blue-800 hover:underline transition">Lihat Semua Data &rarr;</a>
                </div>
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="w-full text-sm text-left text-gray-600">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 font-bold">Nama Lengkap</th>
                                <th class="px-6 py-4 font-bold">NIM / No. Reg</th>
                                <th class="px-6 py-4 font-bold">Prodi Pilihan</th>
                                <th class="px-6 py-4 font-bold">Waktu Daftar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentMhs as $mhs)
                            <tr class="bg-white border-b hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-bold text-gray-900">{{ $mhs->nama }}</td>
                                <td class="px-6 py-4 font-mono text-gray-600">{{ $mhs->nim }}</td>
                                <td class="px-6 py-4">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-bold px-3 py-1 rounded-full border border-blue-200">
                                        {{ $mhs->prodi->nama_prodi }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-500 font-medium">{{ $mhs->created_at->format('d M Y, H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script>
        const ctx = document.getElementById('prodiChart');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Jumlah Pendaftar',
                    data: {!! json_encode($data) !!},
                    backgroundColor: ['rgba(37, 99, 235, 0.8)', 'rgba(79, 70, 229, 0.8)', 'rgba(16, 185, 129, 0.8)'],
                    borderWidth: 0,
                    borderRadius: 6,
                    barThickness: 40
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: { 
                    y: { 
                        beginAtZero: true, 
                        ticks: { stepSize: 1, font: { size: 12 } },
                        grid: { color: '#f3f4f6' }
                    },
                    x: {
                        ticks: { font: { size: 12, weight: 'bold' } },
                        grid: { display: false }
                    }
                },
                plugins: { legend: { display: false } }
            }
        });
    </script>
</x-app-layout>