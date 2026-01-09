<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-blue-700 to-blue-900 -m-6 mb-6 p-8 pt-10 pb-20 text-white rounded-b-3xl shadow-lg relative overflow-hidden">
             <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="relative z-10 max-w-7xl mx-auto flex justify-between items-center">
                <div>
                    <h2 class="font-extrabold text-3xl leading-tight">Biodata Saya</h2>
                    <p class="text-blue-100 mt-2 text-lg">Data diri resmi calon mahasiswa Masoem University.</p>
                </div>
                <div class="hidden md:block opacity-30">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20 pb-12">
        
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            <div class="col-span-1">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 text-center">
                    <div class="w-32 h-32 mx-auto bg-blue-50 rounded-full flex items-center justify-center text-blue-600 mb-4 ring-4 ring-blue-50 overflow-hidden">
                        @if($mahasiswa->foto)
                            <img src="{{ asset('storage/' . $mahasiswa->foto) }}" class="w-full h-full object-cover">
                        @else
                            <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                        @endif
                    </div>
                    
                    <h3 class="font-bold text-gray-800 text-xl">{{ $mahasiswa->nama }}</h3>
                    <p class="text-gray-500 text-sm mb-4">{{ $mahasiswa->nim }}</p>
                    
                    <div class="inline-block px-4 py-1.5 rounded-full text-sm font-bold 
                        @if($mahasiswa->status == 'diverifikasi') bg-green-100 text-green-700 
                        @elseif($mahasiswa->status == 'ditolak') bg-red-100 text-red-700
                        @else bg-yellow-100 text-yellow-700 @endif">
                        {{ ucfirst($mahasiswa->status) }}
                    </div>

                    <div class="mt-6 border-t border-gray-100 pt-4">
                        <a href="{{ route('pendaftaran.index') }}" class="block w-full py-2 px-4 bg-white border border-blue-600 text-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition">
                            Edit Biodata
                        </a>
                        <a href="{{ route('dashboard') }}" class="mt-2 block w-full py-2 px-4 text-gray-500 hover:text-gray-800 text-sm">
                            &larr; Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-span-1 lg:col-span-3">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    
                    <div class="bg-blue-50/50 px-8 py-5 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-800 rounded-lg flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-blue-800">Informasi Pribadi</h3>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Nomor Induk Mahasiswa (NIM)</label>
                                <p class="text-gray-800 font-semibold text-lg mt-1">{{ $mahasiswa->nim }}</p>
                            </div>

                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">NIK KTP</label>
                                <p class="text-gray-800 font-semibold text-lg mt-1">{{ $mahasiswa->nik }}</p>
                            </div>

                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Tempat, Tanggal Lahir</label>
                                <p class="text-gray-800 font-semibold text-lg mt-1">
                                    {{ $mahasiswa->tempat_lahir }}, {{ \Carbon\Carbon::parse($mahasiswa->tgl_lahir)->format('d F Y') }}
                                </p>
                            </div>

                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Jenis Kelamin</label>
                                <p class="text-gray-800 font-semibold text-lg mt-1">
                                    {{ $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </p>
                            </div>

                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Nomor HP / WhatsApp</label>
                                <p class="text-gray-800 font-semibold text-lg mt-1">{{ $mahasiswa->no_hp }}</p>
                            </div>

                            <div class="md:col-span-2">
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Alamat Lengkap</label>
                                <p class="text-gray-800 font-semibold text-lg mt-1">{{ $mahasiswa->alamat }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-100"></div>

                    <div class="bg-blue-50/50 px-8 py-5 border-b border-gray-100 flex items-center gap-3">
                        <div class="w-8 h-8 bg-blue-800 rounded-lg flex items-center justify-center text-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-blue-800">Data Akademik</h3>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-12">
                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Asal Sekolah</label>
                                <p class="text-gray-800 font-semibold text-lg mt-1">{{ $mahasiswa->asal_sekolah }}</p>
                            </div>
                            <div>
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Jurusan & Tahun Lulus</label>
                                <p class="text-gray-800 font-semibold text-lg mt-1">{{ $mahasiswa->jurusan_sekolah }} (Lulus {{ $mahasiswa->tahun_lulus }})</p>
                            </div>
                            <div class="p-4 bg-blue-50 rounded-lg border border-blue-100 md:col-span-2">
                                <label class="text-xs font-bold text-blue-500 uppercase tracking-wider">Pilihan Program Studi Utama</label>
                                <p class="text-blue-800 font-bold text-xl mt-1">{{ $mahasiswa->pilihan_prodi_1 }}</p>
                            </div>
                            @if($mahasiswa->pilihan_prodi_2)
                            <div class="md:col-span-2">
                                <label class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pilihan Program Studi Kedua</label>
                                <p class="text-gray-800 font-semibold text-lg mt-1">{{ $mahasiswa->pilihan_prodi_2 }}</p>
                            </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>