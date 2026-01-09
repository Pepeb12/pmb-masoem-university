<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Formulir Pendaftaran Online</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg">
                <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ Auth::user()->name }}" class="w-full border rounded p-2 bg-gray-100" readonly>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Pilih Program Studi</label>
                        <select name="prodi_id" class="w-full border rounded p-2" required>
                            @foreach($prodis as $prodi)
                                <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Pas Foto (Formal)</label>
                        <input type="file" name="foto" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Scan Ijazah / SKL (PDF/JPG)</label>
                        <input type="file" name="file_ijazah" class="w-full border p-2 rounded" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 dark:text-gray-300 font-bold mb-2">Scan Kartu Keluarga (PDF/JPG)</label>
                        <input type="file" name="file_kk" class="w-full border p-2 rounded" required>
                    </div>

                    <button type="submit" class="bg-blue-600 text-white font-bold py-2 px-4 rounded w-full hover:bg-blue-700">
                        Kirim Pendaftaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>