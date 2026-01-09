<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Data Mahasiswa</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">NIM / No. Daftar</label>
                            <input type="number" name="nim" value="{{ $mahasiswa->nim }}" class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-100" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                            <input type="text" name="nama" value="{{ $mahasiswa->nama }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Angkatan</label>
                            <input type="number" name="angkatan" value="{{ $mahasiswa->angkatan }}" class="w-full border-gray-300 rounded-lg shadow-sm" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Program Studi</label>
                            <select name="prodi_1" class="w-full border-gray-300 rounded-lg shadow-sm">
                                <option value="{{ $mahasiswa->pilihan_prodi_1 }}" selected>{{ $mahasiswa->pilihan_prodi_1 }} (Saat Ini)</option>
                                <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                                <option value="S1 Teknik Informatika">S1 Teknik Informatika</option>
                                <option value="D3 Manajemen Informatika">D3 Manajemen Informatika</option>
                                <option value="S1 Agribisnis">S1 Agribisnis</option>
                                <option value="S1 Teknologi Pangan">S1 Teknologi Pangan</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Dosen Wali</label>
                            <select name="dosen_id" class="w-full border-gray-300 rounded-lg shadow-sm">
                                <option value="">-- Tidak Ada --</option>
                                @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}" {{ $mahasiswa->dosen_id == $dosen->id ? 'selected' : '' }}>
                                        {{ $dosen->nama_dosen }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Ganti Foto (Opsional)</label>
                            @if($mahasiswa->foto)
                                <img src="{{ asset('storage/' . $mahasiswa->foto) }}" class="w-20 h-20 mb-2 rounded border">
                            @endif
                            <input type="file" name="foto" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50">
                        </div>

                    </div>

                    <div class="flex gap-2 mt-6">
                        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 font-bold">Update Data</button>
                        <a href="{{ route('mahasiswa.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 font-bold">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>