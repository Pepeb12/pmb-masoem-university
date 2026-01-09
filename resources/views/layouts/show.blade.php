<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <div class="flex flex-col md:flex-row gap-8">
                    <div class="w-full md:w-1/3 flex justify-center">
                        @if($mahasiswa->foto)
                            <img src="{{ asset('storage/' . $mahasiswa->foto) }}" class="rounded-lg shadow-lg max-w-full h-auto object-cover border-4 border-gray-100" style="max-height: 300px;">
                        @else
                            <div class="w-48 h-64 bg-gray-200 flex items-center justify-center rounded-lg text-gray-500 font-bold">
                                No Photo
                            </div>
                        @endif
                    </div>

                    <div class="w-full md:w-2/3 space-y-4">
                        <h3 class="text-2xl font-bold text-gray-800 dark:text-white border-b pb-2">
                            {{ $mahasiswa->nama }}
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-gray-500 font-bold uppercase">NIM / No. Reg</p>
                                <p class="text-lg font-mono text-gray-800 dark:text-gray-300">{{ $mahasiswa->nim }}</p>
                            </div>
                            
                            <div>
                                <p class="text-gray-500 font-bold uppercase">Angkatan</p>
                                <p class="text-lg text-gray-800 dark:text-gray-300">{{ $mahasiswa->angkatan }}</p>
                            </div>

                            <div>
                                <p class="text-gray-500 font-bold uppercase">Program Studi</p>
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                                    {{ $mahasiswa->prodi->nama_prodi }}
                                </span>
                            </div>

                            <div>
                                <p class="text-gray-500 font-bold uppercase">Dosen Wali</p>
                                <p class="text-lg text-gray-800 dark:text-gray-300">{{ $mahasiswa->dosen->nama_dosen }}</p>
                            </div>

                            <div>
                                <p class="text-gray-500 font-bold uppercase">Status Pendaftaran</p>
                                @if($mahasiswa->status == 'baru')
                                    <span class="text-yellow-600 font-bold">Menunggu Verifikasi</span>
                                @elseif($mahasiswa->status == 'diverifikasi')
                                    <span class="text-green-600 font-bold">Diverifikasi / Diterima</span>
                                @else
                                    <span class="text-red-600 font-bold">Ditolak</span>
                                @endif
                            </div>
                            
                            <div>
                                <p class="text-gray-500 font-bold uppercase">Tanggal Daftar</p>
                                <p class="text-gray-800 dark:text-gray-300">{{ $mahasiswa->created_at->format('d F Y, H:i') }}</p>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t flex gap-3">
                            <a href="{{ route('mahasiswa.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded transition">
                                &larr; Kembali
                            </a>
                            <a href="{{ route('mahasiswa.edit', $mahasiswa->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded transition">
                                Edit Data
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>