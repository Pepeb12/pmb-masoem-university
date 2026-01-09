<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Biodata Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex flex-col md:flex-row gap-8">
                        <div class="w-full md:w-1/3 flex flex-col items-center">
                            <div class="w-48 h-60 bg-gray-200 rounded-lg overflow-hidden shadow-md mb-4 border-4 border-white">
                                @if($mahasiswa->foto)
                                    <img src="{{ asset('storage/' . $mahasiswa->foto) }}" class="w-full h-full object-cover">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-400 font-bold">No Photo</div>
                                @endif
                            </div>

                            <div class="w-full text-center">
                                <p class="text-sm text-gray-500 mb-1">Status Pendaftaran</p>
                                @if($mahasiswa->status == 'baru')
                                    <span class="inline-block bg-yellow-100 text-yellow-800 text-sm font-bold px-4 py-2 rounded-full">
                                        Menunggu Verifikasi
                                    </span>
                                @elseif($mahasiswa->status == 'diverifikasi')
                                    <span class="inline-block bg-green-100 text-green-800 text-sm font-bold px-4 py-2 rounded-full">
                                        Diterima / Lulus
                                    </span>
                                @else
                                    <span class="inline-block bg-red-100 text-red-800 text-sm font-bold px-4 py-2 rounded-full">
                                        Ditolak
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="w-full md:w-2/3">
                            <h3 class="text-2xl font-bold text-gray-800 border-b pb-2 mb-4">{{ $mahasiswa->nama }}</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 text-sm">
                                <div>
                                    <p class="text-gray-500">NIM / No. Reg</p>
                                    <p class="font-bold text-gray-800">{{ $mahasiswa->nim }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500">Program Studi</p>
                                    <p class="font-bold text-gray-800">{{ $mahasiswa->pilihan_prodi_1 }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500">NIK</p>
                                    <p class="font-bold text-gray-800">{{ $mahasiswa->nik }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500">Angkatan</p>
                                    <p class="font-bold text-gray-800">{{ $mahasiswa->angkatan }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500">Tempat, Tgl Lahir</p>
                                    <p class="font-bold text-gray-800">{{ $mahasiswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($mahasiswa->tgl_lahir)->format('d M Y') }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500">Jenis Kelamin</p>
                                    <p class="font-bold text-gray-800">{{ $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500">No. HP</p>
                                    <p class="font-bold text-gray-800">{{ $mahasiswa->no_hp }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-500">Asal Sekolah</p>
                                    <p class="font-bold text-gray-800">{{ $mahasiswa->asal_sekolah }} ({{ $mahasiswa->jurusan_sekolah }})</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-gray-500">Alamat</p>
                                    <p class="font-bold text-gray-800">{{ $mahasiswa->alamat }}</p>
                                </div>
                            </div>

                            {{-- TOMBOL AKSI (Hanya muncul jika status Lulus/Diverifikasi) --}}
                            @if($mahasiswa->status == 'diverifikasi')
                            <div class="mt-8 flex flex-wrap gap-4">
                                {{-- Tombol KTM --}}
                                <a href="{{ route('mahasiswa.cetakPdf', $mahasiswa->id) }}" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded shadow flex items-center gap-2 w-fit transition transform hover:scale-105">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path></svg>
                                    Cetak KTM
                                </a>

                                {{-- Tombol KRS (BARU) --}}
                                <a href="{{ route('pendaftaran.cetakKrs') }}" target="_blank" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded shadow flex items-center gap-2 w-fit transition transform hover:scale-105">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    Cetak KRS (Smt 1)
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>