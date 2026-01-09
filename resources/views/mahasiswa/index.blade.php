<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Kelola Data Mahasiswa') }}
            </h2>
            <div class="text-sm text-gray-500">
                Total Pendaftar: {{ $mahasiswas->count() }}
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Berhasil!</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if(session('warning'))
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
                    <p class="font-bold">Perhatian!</p>
                    <p>{{ session('warning') }}</p>
                </div>
            @endif

            @if(isset($pendaftarBaru) && $pendaftarBaru->count() > 0)
            <div class="bg-orange-50 border border-orange-200 rounded-xl shadow-sm p-6">
                <div class="flex items-center gap-3 mb-4">
                    <div class="bg-orange-100 p-2 rounded-full">
                        <svg class="w-6 h-6 text-orange-600 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-orange-800">Perlu Verifikasi ({{ $pendaftarBaru->count() }})</h3>
                        <p class="text-sm text-orange-600">Mohon segera cek data pendaftar baru berikut ini.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($pendaftarBaru as $baru)
                    <div class="bg-white border border-orange-100 p-4 rounded-lg shadow-sm flex flex-col justify-between">
                        <div class="flex items-center gap-3 mb-3">
                            @if($baru->foto)
                                <img src="{{ asset('storage/' . $baru->foto) }}" class="w-12 h-12 rounded-full object-cover border">
                            @else
                                <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-xs font-bold">No Foto</div>
                            @endif
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm">{{ $baru->nama }}</h4>
                                <p class="text-xs text-gray-500">{{ $baru->pilihan_prodi_1 }}</p>
                            </div>
                        </div>
                        
                        <div class="flex gap-2 mt-2">
                            <a href="{{ route('admin.pendaftaran.show', $baru->id) }}" class="flex-1 bg-blue-50 text-blue-600 text-center py-1.5 rounded text-xs font-bold hover:bg-blue-100">
                                Cek Detail
                            </a>
                            <form action="{{ route('admin.pendaftaran.verifikasi', $baru->id) }}" method="POST" class="flex-1">
                                @csrf @method('PATCH')
                                <button type="submit" class="w-full bg-green-600 text-white py-1.5 rounded text-xs font-bold hover:bg-green-700" onclick="return confirm('Verifikasi mahasiswa ini?')">
                                    Verifikasi
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                    <div class="flex gap-2">
                        <a href="{{ route('mahasiswa.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            Tambah
                        </a>
                        <a href="{{ route('mahasiswa.exportExcel') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            Excel
                        </a>
                        <a href="{{ route('mahasiswa.cetakLaporan') }}" target="_blank" class="bg-gray-700 hover:bg-gray-800 text-white font-bold py-2 px-4 rounded shadow transition flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            PDF Laporan
                        </a>
                    </div>

                    <form action="{{ route('mahasiswa.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center gap-2 bg-gray-50 p-2 rounded-lg border border-gray-200">
                        @csrf
                        <input type="file" name="file" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow">Import</button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">Foto</th>
                                <th class="py-3 px-6 text-left">NIM</th>
                                <th class="py-3 px-6 text-left">Nama</th>
                                <th class="py-3 px-6 text-left">Prodi</th>
                                <th class="py-3 px-6 text-left">Status</th>
                                <th class="py-3 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 dark:text-gray-300 text-sm font-light">
                            @forelse($mahasiswas as $mhs)
                            <tr class="border-b border-gray-200 hover:bg-gray-50 {{ $mhs->status == 'baru' ? 'bg-yellow-50' : '' }}">
                                <td class="py-3 px-6 text-left">
                                    @if($mhs->foto)
                                        <img src="{{ asset('storage/' . $mhs->foto) }}" class="w-10 h-10 rounded-full object-cover border">
                                    @else
                                        <span class="text-xs text-red-500">No Image</span>
                                    @endif
                                </td>
                                <td class="py-3 px-6 text-left font-medium">{{ $mhs->nim }}</td>
                                <td class="py-3 px-6 text-left">{{ $mhs->nama }}</td>
                                <td class="py-3 px-6 text-left">
                                    <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $mhs->pilihan_prodi_1 ?? '-' }}</span>
                                </td>
                                <td class="py-3 px-6 text-left">
                                    @if($mhs->status == 'baru')
                                        <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2 py-1 rounded">Menunggu</span>
                                    @elseif($mhs->status == 'diverifikasi')
                                        <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded">Lulus</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs font-bold px-2 py-1 rounded">Ditolak</span>
                                    @endif
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex items-center justify-center gap-3">
                                        
                                        <a href="{{ route('admin.pendaftaran.show', $mhs->id) }}" class="text-blue-600 hover:text-blue-900 transform hover:scale-110" title="Lihat Detail & Verifikasi">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                        </a>

                                        <a href="{{ route('mahasiswa.cetakPdf', $mhs->id) }}" target="_blank" class="text-purple-600 hover:text-purple-900 transform hover:scale-110" title="Cetak Kartu Mahasiswa">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                        </a>

                                        <a href="{{ route('mahasiswa.edit', $mhs->id) }}" class="text-yellow-600 hover:text-yellow-900 transform hover:scale-110" title="Edit Data">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>

                                        <form action="{{ route('mahasiswa.destroy', $mhs->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 transform hover:scale-110" title="Hapus Data">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-8 px-6 text-center text-gray-500">Belum ada data mahasiswa.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>