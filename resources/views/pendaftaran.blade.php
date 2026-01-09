<x-app-layout>
    <x-slot name="header">
        <div class="bg-gradient-to-r from-masoem-primary to-blue-800 -m-6 mb-6 p-8 pt-10 pb-20 text-white rounded-b-3xl shadow-lg relative overflow-hidden">
             <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="relative z-10 max-w-7xl mx-auto flex justify-between items-center">
                <div>
                    <h2 class="font-extrabold text-3xl leading-tight">Formulir Pendaftaran</h2>
                    <p class="text-blue-100 mt-2 text-lg">Lengkapi data diri Anda dengan benar dan teliti.</p>
                </div>
                <div class="hidden md:block opacity-30">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path></svg>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20 pb-12">
        
        <form action="#" method="POST"> @csrf

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100 mb-8">
                <div class="bg-blue-50/50 px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-10 h-10 bg-masoem-primary rounded-full flex items-center justify-center text-white font-bold shadow-sm">1</div>
                    <h3 class="text-lg font-bold text-gray-800">Identitas Diri Calon Mahasiswa</h3>
                </div>
                
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap (Sesuai Ijazah)</label>
                            <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full rounded-xl border-gray-300 focus:border-masoem-primary focus:ring-masoem-primary shadow-sm h-12 px-4 bg-gray-50 text-gray-500 cursor-not-allowed" readonly>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">NIK (Nomor Induk Kependudukan)</label>
                            <input type="number" name="nik" class="w-full rounded-xl border-gray-300 focus:border-masoem-primary focus:ring-masoem-primary shadow-sm h-12 px-4 transition" placeholder="16 digit NIK" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">NISN</label>
                            <input type="number" name="nisn" class="w-full rounded-xl border-gray-300 focus:border-masoem-primary focus:ring-masoem-primary shadow-sm h-12 px-4 transition" placeholder="Nomor Induk Siswa Nasional">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tempat Lahir</label>
                            <input type="text" name="tempat_lahir" class="w-full rounded-xl border-gray-300 focus:border-masoem-primary focus:ring-masoem-primary shadow-sm h-12 px-4 transition" placeholder="Contoh: Bandung" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="w-full rounded-xl border-gray-300 focus:border-masoem-primary focus:ring-masoem-primary shadow-sm h-12 px-4 transition" required>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jenis Kelamin</label>
                            <select name="gender" class="w-full rounded-xl border-gray-300 focus:border-masoem-primary focus:ring-masoem-primary shadow-sm h-12 px-4 transition">
                                <option value="">-- Pilih --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nomor WhatsApp Aktif</label>
                            <div class="relative">
                                <span class="absolute left-4 top-3 text-gray-500 font-bold">+62</span>
                                <input type="number" name="no_hp" class="w-full rounded-xl border-gray-300 focus:border-masoem-primary focus:ring-masoem-primary shadow-sm h-12 pl-12 pr-4 transition" placeholder="81234567890">
                            </div>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap (Sesuai KTP)</label>
                            <textarea name="alamat" rows="3" class="w-full rounded-xl border-gray-300 focus:border-masoem-primary focus:ring-masoem-primary shadow-sm px-4 py-3 transition" placeholder="Nama Jalan, RT/RW, Kelurahan, Kecamatan"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100 mb-8">
                <div class="bg-blue-50/50 px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-10 h-10 bg-masoem-primary rounded-full flex items-center justify-center text-white font-bold shadow-sm">2</div>
                    <h3 class="text-lg font-bold text-gray-800">Data Sekolah Asal</h3>
                </div>
                
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Sekolah Asal</label>
                            <input type="text" name="asal_sekolah" class="w-full rounded-xl border-gray-300 focus:border-masoem-primary focus:ring-masoem-primary shadow-sm h-12 px-4 transition" placeholder="Contoh: SMA Negeri 1 Cileunyi">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Jurusan di Sekolah</label>
                            <select name="jurusan_sekolah" class="w-full rounded-xl border-gray-300 focus:border-masoem-primary focus:ring-masoem-primary shadow-sm h-12 px-4 transition">
                                <option value="">-- Pilih --</option>
                                <option value="IPA">IPA / MIPA</option>
                                <option value="IPS">IPS / Sosial</option>
                                <option value="Bahasa">Bahasa</option>
                                <option value="SMK Teknik">SMK Teknik (TKJ/RPL/dll)</option>
                                <option value="SMK Bisnis">SMK Bisnis/Akuntansi</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Tahun Lulus</label>
                            <input type="number" name="tahun_lulus" class="w-full rounded-xl border-gray-300 focus:border-masoem-primary focus:ring-masoem-primary shadow-sm h-12 px-4 transition" placeholder="Contoh: 2024">
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl border border-gray-100 mb-8">
                <div class="bg-blue-50/50 px-6 py-4 border-b border-gray-100 flex items-center gap-3">
                    <div class="w-10 h-10 bg-masoem-primary rounded-full flex items-center justify-center text-white font-bold shadow-sm">3</div>
                    <h3 class="text-lg font-bold text-gray-800">Pilihan Program Studi</h3>
                </div>
                
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Pilihan Program Studi 1 (Utama)</label>
                            <select name="prodi_1" class="w-full rounded-xl border-gray-300 focus:border-masoem-primary focus:ring-masoem-primary shadow-sm h-12 px-4 transition bg-blue-50 border-blue-200">
                                <option value="">-- Pilih Program Studi --</option>
                                <optgroup label="Fakultas Komputer & Teknik">
                                    <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                                    <option value="S1 Teknik Informatika">S1 Teknik Informatika</option>
                                    <option value="D3 Manajemen Informatika">D3 Manajemen Informatika</option>
                                </optgroup>
                                <optgroup label="Fakultas Ekonomi Bisnis">
                                    <option value="S1 Manajemen Bisnis Syariah">S1 Manajemen Bisnis Syariah</option>
                                    <option value="S1 Perbankan Syariah">S1 Perbankan Syariah</option>
                                    <option value="S1 Akuntansi">S1 Akuntansi</option>
                                </optgroup>
                                <optgroup label="Fakultas Pertanian">
                                    <option value="S1 Agribisnis">S1 Agribisnis</option>
                                    <option value="S1 Teknologi Pangan">S1 Teknologi Pangan</option>
                                </optgroup>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Pilihan Program Studi 2 (Opsional)</label>
                            <select name="prodi_2" class="w-full rounded-xl border-gray-300 focus:border-masoem-primary focus:ring-masoem-primary shadow-sm h-12 px-4 transition">
                                <option value="">-- Pilih Alternatif --</option>
                                <optgroup label="Fakultas Komputer & Teknik">
                                    <option value="S1 Sistem Informasi">S1 Sistem Informasi</option>
                                    <option value="S1 Teknik Informatika">S1 Teknik Informatika</option>
                                </optgroup>
                                <optgroup label="Fakultas Ekonomi Bisnis">
                                    <option value="S1 Manajemen Bisnis Syariah">S1 Manajemen Bisnis Syariah</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4">
                <a href="{{ route('dashboard') }}" class="text-gray-500 font-bold hover:text-gray-700 px-6 py-3">Batal</a>
                <button type="submit" class="bg-masoem-primary hover:bg-blue-800 text-white font-bold py-4 px-10 rounded-xl shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Formulir
                </button>
            </div>

        </form>
    </div>
</x-app-layout>