<x-app-layout>
    <x-slot name="header">
        <div class="bg-gray-800 -m-6 mb-6 p-8 pt-10 pb-20 text-white rounded-b-3xl shadow-lg relative">
            <div class="max-w-7xl mx-auto flex justify-between items-center relative z-10">
                <div>
                    <h2 class="font-extrabold text-3xl leading-tight">Detail Calon Mahasiswa</h2>
                    <p class="text-gray-400 mt-2 text-lg">Periksa data lengkap sebelum melakukan verifikasi.</p>
                </div>
                <a href="{{ route('pendaftaran.index') }}" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-bold transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="col-span-1">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 text-center">
                    <div class="w-32 h-32 mx-auto bg-gray-100 rounded-full flex items-center justify-center text-gray-400 mb-4 border-4 border-white shadow-sm">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                    </div>
                    
                    <h3 class="font-bold text-gray-800 text-xl">{{ $mahasiswa->nama }}</h3>
                    <p class="text-gray-500 text-sm mb-4">{{ $mahasiswa->nim }}</p>
                    
                    <div class="mb-6">
                        @if($mahasiswa->status == 'baru')
                            <span class="bg-yellow-100 text-yellow-800 px-4 py-1.5 rounded-full text-sm font-bold">Menunggu Verifikasi</span>
                        @elseif($mahasiswa->status == 'diverifikasi')
                            <span class="bg-green-100 text-green-800 px-4 py-1.5 rounded-full text-sm font-bold">Sudah Diverifikasi</span>
                        @else
                            <span class="bg-red-100 text-red-800 px-4 py-1.5 rounded-full text-sm font-bold">Ditolak</span>
                        @endif
                    </div>

                    <div class="border-t border-gray-100 pt-6 space-y-3">
                        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Aksi Admin</h4>
                        
                        @if($mahasiswa->status == 'baru')
                            <form action="{{ route('admin.pendaftaran.verifikasi', $mahasiswa->id) }}" method="POST" class="w-full">
                                @csrf
                                @method('PATCH')
                                <button type="submit" onclick="return confirm('Data sudah benar? Verifikasi mahasiswa ini?')" class="w-full py-2.5 px-4 bg-green-500 hover:bg-green-600 text-white rounded-lg font-bold shadow-md hover:shadow-lg transition flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    Verifikasi & Terima
                                </button>
                            </form>

                            <form action="{{ route('admin.pendaftaran.tolak', $mahasiswa->id) }}" method="POST" class="w-full">
                                @csrf
                                @method('PATCH')
                                <button type="submit" onclick="return confirm('Yakin ingin menolak pendaftaran ini?')" class="w-full py-2.5 px-4 bg-white border-2 border-red-500 text-red-500 hover:bg-red-50 rounded-lg font-bold transition flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    Tolak Pendaftaran
                                </button>
                            </form>
                        @else
                            <div class="p-3 bg-gray-50 text-gray-500 text-sm rounded-lg border border-gray-200">
                                Mahasiswa ini sudah diproses. Tidak ada aksi yang diperlukan.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-span-1 lg:col-span-2 space-y-6">
                
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 font-bold text-gray-700">
                        Biodata Pribadi
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-4">
                        <div>
                            <label class="text-xs text-gray-400 font-bold uppercase">NIK (KTP)</label>
                            <p class="font-semibold text-gray-800">{{ $mahasiswa->nik }}</p>
                        </div>
                         <div>
                            <label class="text-xs text-gray-400 font-bold uppercase">NISN</label>
                            <p class="font-semibold text-gray-800">{{ $mahasiswa->nisn }}</p>
                        </div>
                        <div>
                            <label class="text-xs text-gray-400 font-bold uppercase">Tempat, Tanggal Lahir</label>
                            <p class="font-semibold text-gray-800">{{ $mahasiswa->tempat_lahir }}, {{ $mahasiswa->tgl_lahir }}</p>
                        </div>
                        <div>
                            <label class="text-xs text-gray-400 font-bold uppercase">Jenis Kelamin</label>
                            <p class="font-semibold text-gray-800">{{ $mahasiswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                        </div>
                        <div>
                            <label class="text-xs text-gray-400 font-bold uppercase">No HP / WA</label>
                            <div class="flex items-center gap-2">
                                <p class="font-semibold text-gray-800">{{ $mahasiswa->no_hp }}</p>
                                <a href="https://wa.me/{{ $mahasiswa->no_hp }}" target="_blank" class="text-green-500 hover:text-green-600">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.506-.669-.514-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.48 0 1.461 1.066 2.875 1.215 3.074.149.198 2.095 3.199 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.084 1.758-.717 2.006-1.413.248-.695.248-1.29.173-1.414z"/></svg>
                                </a>
                            </div>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-xs text-gray-400 font-bold uppercase">Alamat Lengkap</label>
                            <p class="font-semibold text-gray-800">{{ $mahasiswa->alamat }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                     <div class="bg-gray-50 px-6 py-4 border-b border-gray-100 font-bold text-gray-700">
                        Data Sekolah & Jurusan
                    </div>
                     <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-y-6 gap-x-4">
                        <div>
                            <label class="text-xs text-gray-400 font-bold uppercase">Asal Sekolah</label>
                            <p class="font-semibold text-gray-800">{{ $mahasiswa->asal_sekolah }}</p>
                        </div>
                         <div>
                            <label class="text-xs text-gray-400 font-bold uppercase">Jurusan & Tahun Lulus</label>
                            <p class="font-semibold text-gray-800">{{ $mahasiswa->jurusan_sekolah }} ({{ $mahasiswa->tahun_lulus }})</p>
                        </div>
                        <div class="md:col-span-2">
                             <label class="text-xs text-blue-500 font-bold uppercase">Pilihan Program Studi Utama</label>
                            <p class="font-bold text-xl text-masoem-primary">{{ $mahasiswa->pilihan_prodi_1 }}</p>
                        </div>
                        <div class="md:col-span-2">
                             <label class="text-xs text-gray-400 font-bold uppercase">Pilihan Program Studi Kedua</label>
                            <p class="font-semibold text-gray-600">{{ $mahasiswa->pilihan_prodi_2 ?? '-' }}</p>
                        </div>
                     </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>