<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah Data Mahasiswa</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">NIM / No. Daftar</label>
                            <input type="number" name="nim" class="w-full border-gray-300 rounded-lg shadow-sm" required value="{{ old('nim') }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                            <input type="text" name="nama" class="w-full border-gray-300 rounded-lg shadow-sm" required value="{{ old('nama') }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Angkatan (Tahun)</label>
                            <input type="number" name="angkatan" class="w-full border-gray-300 rounded-lg shadow-sm" required value="{{ date('Y') }}">
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Program Studi</label>
                            <select name="prodi_1" class="w-full border-gray-300 rounded-lg shadow-sm">
                                <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                                <option value="S1 Teknik Informatika">S1 Teknik Informatika</option>
                                <option value="D3 Manajemen Informatika">D3 Manajemen Informatika</option>
                                <option value="S1 Agribisnis">S1 Agribisnis</option>
                                <option value="S1 Teknologi Pangan">S1 Teknologi Pangan</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Dosen Wali (Opsional)</label>
                            <select name="dosen_id" class="w-full border-gray-300 rounded-lg shadow-sm">
                                <option value="">-- Pilih Dosen --</option>
                                @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 font-bold mb-2">Foto Mahasiswa</label>
                            <input type="file" name="foto" class="w-full border border-gray-300 rounded-lg p-2 bg-gray-50">
                            <p class="text-xs text-gray-500 mt-1">*Format: JPG, PNG. Max: 2MB</p>
                        </div>

                    </div>

                    <div class="flex gap-2 mt-6">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 font-bold">Simpan Data</button>
                        <a href="{{ route('mahasiswa.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 font-bold">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>