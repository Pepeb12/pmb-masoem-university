<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Data Dosen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    {{-- Tampilkan Error Validasi --}}
                    @if ($errors->any())
                        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                            <strong class="font-bold">Terjadi Kesalahan!</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('dosen.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kode Dosen</label>
                                <input type="text" name="kode_dosen" value="{{ old('kode_dosen') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required placeholder="Contoh: DSN001">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">NIDN</label>
                                <input type="number" name="nidn" value="{{ old('nidn') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required placeholder="Nomor Induk Dosen Nasional">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="nama_dosen" value="{{ old('nama_dosen') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Program Studi</label>
                                <select name="prodi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="">-- Pilih Prodi --</option>
                                    <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                                    <option value="S1 Teknik Informatika">S1 Teknik Informatika</option>
                                    <option value="D3 Manajemen Informatika">D3 Manajemen Informatika</option>
                                    <option value="S1 Bisnis Digital">S1 Bisnis Digital</option>
                                    <option value="S1 Agribisnis">S1 Agribisnis</option>
                                    <option value="S1 Teknologi Pangan">S1 Teknologi Pangan</option>
                                </select>
                            </div>

                        </div>

                        <div class="mt-6 flex justify-end gap-2">
                            <a href="{{ route('dosen.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Batal</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Simpan Data</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>