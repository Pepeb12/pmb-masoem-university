<x-app-layout>
    {{-- Header Background (Warna Biru Khas) --}}
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-blue-900 leading-tight flex items-center gap-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                {{ __('Penerimaan Mahasiswa Baru') }}
            </h2>
            <span class="text-sm font-medium text-blue-600 bg-blue-50 px-3 py-1 rounded-full">
                Tahun Ajaran {{ date('Y') }}/{{ date('Y')+1 }}
            </span>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Error Handling UI --}}
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded shadow-sm animate-pulse">
                    <p class="font-bold flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Mohon periksa kembali inputan Anda:
                    </p>
                    <ul class="list-disc list-inside mt-2 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Kartu Formulir --}}
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border-t-8 border-blue-900">
                
                {{-- Form Header --}}
                <div class="bg-blue-50 px-8 py-6 border-b border-blue-100">
                    <h3 class="text-2xl font-extrabold text-blue-900">Formulir Pendaftaran</h3>
                    <p class="text-blue-600 text-sm mt-1">Silakan lengkapi data diri Anda dengan benar dan valid.</p>
                </div>

                <div class="p-8">
                    <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- BAGIAN 1: DATA PRIBADI --}}
                        <div class="mb-8">
                            <h4 class="text-lg font-bold text-blue-800 border-b-2 border-blue-100 pb-2 mb-6 flex items-center gap-2">
                                <span class="bg-blue-800 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">1</span>
                                Identitas Diri
                            </h4>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- NIM Sementara --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">NIM Sementara / No. Registrasi</label>
                                    <input type="number" name="nim" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition" required placeholder="Contoh: 240001">
                                </div>

                                {{-- Nama Lengkap --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                    <input type="text" name="nama" value="{{ Auth::user()->name }}" class="w-full border-gray-300 rounded-lg shadow-sm bg-gray-50 text-gray-500 cursor-not-allowed" readonly title="Sesuai akun login">
                                </div>

                                {{-- NIK --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Induk Kependudukan (NIK)</label>
                                    <input type="number" name="nik" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition" required placeholder="16 Digit Angka">
                                </div>

                                {{-- No HP --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">No. HP (WhatsApp Aktif)</label>
                                    <input type="text" name="no_hp" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition" required placeholder="08xxxxxxxxxx">
                                </div>

                                {{-- Tempat Lahir --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tempat Lahir</label>
                                    <input type="text" name="tempat_lahir" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition" required>
                                </div>

                                {{-- Tanggal Lahir --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir</label>
                                    <input type="date" name="tgl_lahir" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition" required>
                                </div>

                                {{-- Jenis Kelamin --}}
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin</label>
                                    <div class="relative">
                                        <select name="jenis_kelamin" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition appearance-none">
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Alamat --}}
                            <div class="mt-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap (Sesuai KTP)</label>
                                <textarea name="alamat" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition h-24" required placeholder="Nama Jalan, RT/RW, Kelurahan, Kecamatan, Kota/Kabupaten"></textarea>
                            </div>
                        </div>

                        {{-- BAGIAN 2: SEKOLAH & PRODI --}}
                        <div class="mb-8">
                            <h4 class="text-lg font-bold text-blue-800 border-b-2 border-blue-100 pb-2 mb-6 flex items-center gap-2">
                                <span class="bg-blue-800 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">2</span>
                                Data Pendidikan & Jurusan
                            </h4>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Asal Sekolah</label>
                                    <input type="text" name="asal_sekolah" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition" required placeholder="Nama SMA/SMK/MA">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jurusan Sekolah</label>
                                    <input type="text" name="jurusan_sekolah" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition" required placeholder="Contoh: IPA / IPS / TKJ / Akuntansi">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tahun Lulus</label>
                                    <input type="number" name="tahun_lulus" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition" required placeholder="Contoh: 2024">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pilihan Program Studi</label>
                                    <div class="relative">
                                        <select name="pilihan_prodi_1" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition">
                                            <option value="" disabled selected>-- Pilih Prodi --</option>
                                            <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                                            <option value="S1 Teknik Informatika">S1 Teknik Informatika</option>
                                            <option value="D3 Manajemen Informatika">D3 Manajemen Informatika</option>
                                            <option value="S1 Agribisnis">S1 Agribisnis</option>
                                            <option value="S1 Teknologi Pangan">S1 Teknologi Pangan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- BAGIAN 3: UPLOAD FOTO --}}
                        <div class="mb-8">
                            <h4 class="text-lg font-bold text-blue-800 border-b-2 border-blue-100 pb-2 mb-6 flex items-center gap-2">
                                <span class="bg-blue-800 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs">3</span>
                                Upload Foto
                            </h4>

                            <div class="mt-2 flex justify-center px-6 pt-5 pb-6 border-2 border-blue-300 border-dashed rounded-xl bg-blue-50 hover:bg-blue-100 transition duration-300">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-blue-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="foto-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 px-2">
                                            <span>Upload Pas Foto</span>
                                            <input id="foto-upload" name="foto" type="file" class="sr-only" required accept="image/*">
                                        </label>
                                        <p class="pl-1">atau tarik file ke sini</p>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PNG, JPG, JPEG (Maks. 2MB). Wajah harus terlihat jelas, background merah/biru.
                                    </p>
                                    <p id="file-name" class="text-sm font-bold text-blue-800 mt-2"></p>
                                </div>
                            </div>
                        </div>

                        {{-- TOMBOL SUBMIT --}}
                        <div class="pt-4 border-t border-gray-200">
                            <button type="submit" class="w-full flex justify-center py-4 px-4 border border-transparent rounded-xl shadow-sm text-lg font-bold text-white bg-blue-900 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-900 transition transform hover:-translate-y-1 hover:shadow-lg">
                                Kirim Formulir Pendaftaran
                            </button>
                            <p class="text-center text-xs text-gray-400 mt-3">
                                Dengan mengirim formulir ini, Anda menyatakan bahwa data yang diisi adalah benar.
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Script sederhana untuk menampilkan nama file yang diupload --}}
    <script>
        document.getElementById('foto-upload').addEventListener('change', function(e) {
            var fileName = e.target.files[0].name;
            document.getElementById('file-name').textContent = 'File terpilih: ' + fileName;
        });
    </script>
</x-app-layout>