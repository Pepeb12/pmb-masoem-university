<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Data Dosen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('dosen.update', $dosen->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kode Dosen</label>
                                <input type="text" name="kode_dosen" value="{{ old('kode_dosen', $dosen->kode_dosen) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">NIDN</label>
                                <input type="number" name="nidn" value="{{ old('nidn', $dosen->nidn) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input type="text" name="nama_dosen" value="{{ old('nama_dosen', $dosen->nama_dosen) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Program Studi</label>
                                <select name="prodi" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="">-- Pilih Prodi --</option>
                                    @php
                                        $prodis = ['S1 Sistem Informasi', 'S1 Teknik Informatika', 'D3 Manajemen Informatika', 'S1 Bisnis Digital', 'S1 Agribisnis', 'S1 Teknologi Pangan'];
                                    @endphp
                                    @foreach($prodis as $p)
                                        <option value="{{ $p }}" {{ $dosen->prodi == $p ? 'selected' : '' }}>{{ $p }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-6 flex justify-end gap-2">
                            <a href="{{ route('dosen.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Batal</a>
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Data</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>