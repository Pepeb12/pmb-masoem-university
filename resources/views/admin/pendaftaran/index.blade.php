<x-app-layout>
    <x-slot name="header">
        <div class="bg-gray-800 -m-6 mb-6 p-8 pt-10 pb-20 text-white rounded-b-3xl shadow-lg relative overflow-hidden">
             <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="relative z-10 max-w-7xl mx-auto flex justify-between items-center">
                <div>
                    <h2 class="font-extrabold text-3xl leading-tight">Data Pendaftar PMB</h2>
                    <p class="text-gray-400 mt-2 text-lg">Kelola data masuk calon mahasiswa baru.</p>
                </div>
                <div class="hidden md:block opacity-30">
                    <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20 pb-12">
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-xl">
                    {{ $pendaftar->count() }}
                </div>
                <div>
                    <h4 class="text-gray-500 text-sm font-bold uppercase">Total Pendaftar</h4>
                    <p class="text-gray-800 font-bold">Semua Jalur</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center font-bold text-xl">
                    {{ $pendaftar->where('status', 'baru')->count() }}
                </div>
                <div>
                    <h4 class="text-gray-500 text-sm font-bold uppercase">Perlu Verifikasi</h4>
                    <p class="text-gray-800 font-bold">Status Baru</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-green-100 text-green-600 rounded-full flex items-center justify-center font-bold text-xl">
                    {{ $pendaftar->where('status', 'diverifikasi')->count() }}
                </div>
                <div>
                    <h4 class="text-gray-500 text-sm font-bold uppercase">Diterima</h4>
                    <p class="text-gray-800 font-bold">Lulus Seleksi</p>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100">
            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-gray-50">
                <h3 class="text-lg font-bold text-masoem-primary">Daftar Calon Mahasiswa</h3>
                <button class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-green-700 transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Export Excel
                </button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-white uppercase bg-masoem-primary">
                        <tr>
                            <th scope="col" class="px-6 py-4">No</th>
                            <th scope="col" class="px-6 py-4">Nama & NIK</th>
                            <th scope="col" class="px-6 py-4">Asal Sekolah</th>
                            <th scope="col" class="px-6 py-4">Pilihan Prodi</th>
                            <th scope="col" class="px-6 py-4">Status</th>
                            <th scope="col" class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pendaftar as $index => $mhs)
                        <tr class="bg-white border-b hover:bg-blue-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-900">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $mhs->nama }}</div>
                                <div class="text-xs text-gray-400">{{ $mhs->nik }}</div>
                            </td>
                            <td class="px-6 py-4">
                                {{ $mhs->asal_sekolah }}
                                <div class="text-xs text-blue-500 font-bold">{{ $mhs->jurusan_sekolah }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ $mhs->pilihan_prodi_1 }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if($mhs->status == 'baru')
                                    <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2.5 py-0.5 rounded">Baru</span>
                                @elseif($mhs->status == 'diverifikasi')
                                    <span class="bg-green-100 text-green-800 text-xs font-bold px-2.5 py-0.5 rounded">Lulus</span>
                                @else
                                    <span class="bg-red-100 text-red-800 text-xs font-bold px-2.5 py-0.5 rounded">Ditolak</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.pendaftaran.show', $mhs->id) }}" class="text-blue-600 hover:text-blue-900 font-bold border border-blue-200 px-3 py-1 rounded hover:bg-blue-50">
                                        Detail
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                Belum ada data pendaftar masuk.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>