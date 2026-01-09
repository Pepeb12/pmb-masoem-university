<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PMB Masoem University - Penerimaan Mahasiswa Baru</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        masoem: {
                            primary: '#0e3b6b', // Navy Blue
                            light: '#1d4ed8',   // Blue Highlight
                            accent: '#f97316',  // Orange Accent
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="antialiased bg-white text-gray-700 font-sans scroll-smooth">

    <nav class="bg-white/95 backdrop-blur-md shadow-sm fixed w-full z-50 top-0 border-b border-gray-100 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-masoem-primary rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-md">
                        M
                    </div>
                    <div>
                        <h1 class="text-xl font-extrabold text-masoem-primary leading-none tracking-tight">MASOEM</h1>
                        <span class="text-xs text-masoem-accent font-bold tracking-[0.2em]">UNIVERSITY</span>
                    </div>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-600 hover:text-masoem-primary font-semibold transition">Beranda</a>
                    <a href="#prodi" class="text-gray-600 hover:text-masoem-primary font-semibold transition">Program Studi</a>
                    <a href="#alur" class="text-gray-600 hover:text-masoem-primary font-semibold transition">Alur Daftar</a>
                    <a href="#beasiswa" class="text-gray-600 hover:text-masoem-primary font-semibold transition">Beasiswa</a>
                </div>

                <div class="flex items-center gap-3">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="bg-masoem-primary text-white px-6 py-2.5 rounded-full font-semibold hover:bg-masoem-light transition shadow-md">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-masoem-primary font-bold hover:bg-blue-50 px-4 py-2 rounded-full transition">Masuk</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="bg-masoem-primary text-white px-6 py-2.5 rounded-full font-semibold hover:bg-masoem-light shadow-lg hover:shadow-blue-500/30 transition transform hover:-translate-y-0.5">
                                    Daftar Sekarang
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <section class="relative pt-32 pb-24 lg:pt-48 lg:pb-40 overflow-hidden bg-gradient-to-br from-masoem-primary to-blue-800">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/diamond-upholstery.png')]"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-blue-900/50 text-blue-100 text-sm font-semibold mb-8 border border-blue-400/30 backdrop-blur-sm">
                <span class="w-2 h-2 rounded-full bg-masoem-accent animate-pulse"></span>
                Penerimaan Mahasiswa Baru T.A 2025/2026 Dibuka!
            </span>
            <h1 class="text-4xl md:text-6xl font-extrabold text-white tracking-tight mb-6 leading-tight drop-shadow-sm">
                Raih Masa Depan Gemilang <br> 
                Bersama <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 to-white">Masoem University</span>
            </h1>
            <p class="text-lg md:text-xl text-blue-100 mb-10 max-w-2xl mx-auto font-light leading-relaxed">
                Kampus berbasis teknologi dan wirausaha dengan fasilitas modern dan kurikulum terkini. Siapkan dirimu menjadi pemimpin masa depan yang berkarakter.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ route('register') }}" class="bg-white text-masoem-primary text-lg px-8 py-4 rounded-full font-bold hover:bg-blue-50 transition shadow-xl hover:shadow-white/20">
                    Buat Akun Pendaftaran
                </a>
                <a href="#prodi" class="bg-transparent border-2 border-white/30 text-white text-lg px-8 py-4 rounded-full font-bold hover:bg-white/10 transition backdrop-blur-sm">
                    Lihat Program Studi
                </a>
            </div>
        </div>
        <div class="absolute bottom-0 w-full translate-y-1">
             <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" class="h-16 w-full">
                <path d="M0 0C240 100 480 100 720 50C960 0 1200 0 1440 100V100H0V0Z" fill="white"/>
            </svg>
        </div>
    </section>

    <div class="bg-white py-12 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-gray-100/0 md:divide-gray-200">
            <div class="p-4">
                <h3 class="text-4xl font-extrabold text-masoem-primary mb-1">5+</h3>
                <p class="text-sm uppercase tracking-wider text-gray-500 font-semibold">Fakultas</p>
            </div>
            <div class="p-4">
                <h3 class="text-4xl font-extrabold text-masoem-primary mb-1">15+</h3>
                <p class="text-sm uppercase tracking-wider text-gray-500 font-semibold">Program Studi</p>
            </div>
            <div class="p-4">
                <h3 class="text-4xl font-extrabold text-masoem-primary mb-1">1000+</h3>
                <p class="text-sm uppercase tracking-wider text-gray-500 font-semibold">Mahasiswa Baru</p>
            </div>
            <div class="p-4">
                <h3 class="text-4xl font-extrabold text-masoem-primary mb-1">A</h3>
                <p class="text-sm uppercase tracking-wider text-gray-500 font-semibold">Akreditasi Institusi</p>
            </div>
        </div>
    </div>

    <section id="alur" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-masoem-primary mb-4">Alur Pendaftaran Online</h2>
                <p class="text-gray-500 max-w-2xl mx-auto">Proses mudah, cepat, dan transparan dari rumah.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300 group text-center">
                    <div class="w-16 h-16 mx-auto bg-blue-50 rounded-2xl flex items-center justify-center text-masoem-primary mb-6 group-hover:bg-masoem-primary group-hover:text-white transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">1. Daftar Akun</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Buat akun PMB menggunakan email aktif Anda untuk memulai.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300 group text-center">
                    <div class="w-16 h-16 mx-auto bg-blue-50 rounded-2xl flex items-center justify-center text-masoem-primary mb-6 group-hover:bg-masoem-primary group-hover:text-white transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">2. Isi Formulir</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Lengkapi biodata diri, data sekolah, dan pilih jurusan minat.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300 group text-center">
                    <div class="w-16 h-16 mx-auto bg-blue-50 rounded-2xl flex items-center justify-center text-masoem-primary mb-6 group-hover:bg-masoem-primary group-hover:text-white transition">
                         <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">3. Upload Berkas</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Unggah pas foto dan scan dokumen pendukung yang diminta.</p>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition duration-300 group text-center">
                    <div class="w-16 h-16 mx-auto bg-blue-50 rounded-2xl flex items-center justify-center text-masoem-primary mb-6 group-hover:bg-masoem-primary group-hover:text-white transition">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">4. Pengumuman</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">Pantau status seleksi dan kelulusan langsung di dashboard.</p>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('panduan') }}" class="inline-flex items-center justify-center px-8 py-3 text-base font-bold text-masoem-primary bg-white border-2 border-masoem-primary rounded-full hover:bg-masoem-primary hover:text-white transition duration-300 shadow-sm group">
                    <svg class="w-5 h-5 mr-2 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Lihat Panduan Lengkap & Syarat
                </a>
            </div>
        </div>
    </section>

    <section id="prodi" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-4">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-masoem-primary mb-4">Fakultas & Program Studi</h2>
                    <p class="text-gray-500 max-w-xl">Temukan passion-mu di salah satu program studi unggulan kami yang telah terakreditasi.</p>
                </div>
                <a href="{{ route('register') }}" class="text-masoem-primary font-bold hover:text-masoem-light flex items-center gap-2 group">
                    Lihat Selengkapnya 
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition duration-300 group">
                    <div class="bg-masoem-primary p-6 relative overflow-hidden h-32 flex items-center">
                        <div class="absolute right-0 top-0 opacity-10">
                            <svg class="w-32 h-32 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white relative z-10">Komputer & Teknik</h3>
                    </div>
                    <div class="p-8">
                        <ul class="space-y-4">
                            <li class="flex items-start text-gray-600">
                                <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                S1 Sistem Informasi
                            </li>
                            <li class="flex items-start text-gray-600">
                                <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                S1 Teknik Informatika
                            </li>
                            <li class="flex items-start text-gray-600">
                                <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                D3 Manajemen Informatika
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition duration-300 group">
                    <div class="bg-blue-600 p-6 relative overflow-hidden h-32 flex items-center">
                        <div class="absolute right-0 top-0 opacity-10">
                            <svg class="w-32 h-32 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white relative z-10">Ekonomi Bisnis</h3>
                    </div>
                    <div class="p-8">
                         <ul class="space-y-4">
                            <li class="flex items-start text-gray-600">
                                <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                S1 Manajemen Bisnis Syariah
                            </li>
                            <li class="flex items-start text-gray-600">
                                <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                S1 Perbankan Syariah
                            </li>
                            <li class="flex items-start text-gray-600">
                                <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                S1 Akuntansi
                            </li>
                        </ul>
                    </div>
                </div>
                 <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transition duration-300 group">
                    <div class="bg-[#2B6CB0] p-6 relative overflow-hidden h-32 flex items-center">
                         <div class="absolute right-0 top-0 opacity-10">
                            <svg class="w-32 h-32 text-white" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l3.954 1.582 1.599-.8a1 1 0 01.894 1.79l-1.233.616 1.738 5.42a1 1 0 01-.285 1.05A3.989 3.989 0 0115 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.715-5.349L11 6.477V16h2a1 1 0 110 2H7a1 1 0 110-2h2V6.477L6.237 7.582l1.715 5.349a1 1 0 01-.285 1.05A3.989 3.989 0 015 15a3.989 3.989 0 01-2.667-1.019 1 1 0 01-.285-1.05l1.738-5.42-1.233-.617a1 1 0 01.894-1.788l1.599.799L9 4.323V3a1 1 0 011-1zM5 12a2 2 0 100 4 2 2 0 000-4zm10 0a2 2 0 100 4 2 2 0 000-4z" clip-rule="evenodd"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-white relative z-10">Fakultas Pertanian</h3>
                    </div>
                    <div class="p-8">
                         <ul class="space-y-4">
                            <li class="flex items-start text-gray-600">
                                <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                S1 Agribisnis
                            </li>
                            <li class="flex items-start text-gray-600">
                                <svg class="w-5 h-5 text-blue-500 mr-3 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                S1 Teknologi Pangan
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="beasiswa" class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <span class="text-masoem-primary font-bold tracking-wider uppercase text-sm mb-2 block">Dukungan Finansial</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Program Beasiswa</h2>
                <p class="text-gray-500 max-w-2xl mx-auto">Masoem University berkomitmen mendukung mahasiswa berprestasi dan kurang mampu melalui berbagai jalur beasiswa.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-2xl shadow-lg border-t-4 border-masoem-accent overflow-hidden hover:shadow-2xl transition duration-300 relative group">
                    <div class="absolute top-0 right-0 bg-masoem-accent text-white text-xs font-bold px-3 py-1 rounded-bl-lg">FULL FUNDED</div>
                    <div class="p-8 text-center">
                        <div class="w-20 h-20 mx-auto bg-orange-100 rounded-full flex items-center justify-center text-masoem-accent mb-6 group-hover:scale-110 transition">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">KIP Kuliah Merdeka</h3>
                        <p class="text-masoem-accent font-bold text-lg mb-4">Gratis Kuliah 100%</p>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6">Program bantuan biaya pendidikan penuh dari pemerintah ditambah bantuan biaya hidup bulanan bagi siswa berprestasi dengan keterbatasan ekonomi.</p>
                        <a href="{{ route('register') }}" class="inline-block w-full py-3 bg-masoem-accent text-white font-bold rounded-lg hover:bg-orange-600 transition">Daftar KIPK</a>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition duration-300 text-center">
                    <div class="p-8">
                        <div class="w-20 h-20 mx-auto bg-blue-50 rounded-full flex items-center justify-center text-masoem-primary mb-6">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Beasiswa Tahfidz</h3>
                        <p class="text-masoem-primary font-bold text-lg mb-4">Potongan Biaya</p>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6">Apresiasi bagi penghafal Al-Qur'an. Dapatkan potongan biaya DPP mulai dari 25% hingga 100% sesuai dengan jumlah juz hafalan Anda.</p>
                        <a href="{{ route('register') }}" class="inline-block w-full py-3 bg-white border-2 border-masoem-primary text-masoem-primary font-bold rounded-lg hover:bg-masoem-primary hover:text-white transition">Cek Syarat</a>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl transition duration-300 text-center">
                    <div class="p-8">
                        <div class="w-20 h-20 mx-auto bg-blue-50 rounded-full flex items-center justify-center text-masoem-primary mb-6">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Beasiswa Prestasi</h3>
                        <p class="text-masoem-primary font-bold text-lg mb-4">Diskon Khusus</p>
                        <p class="text-gray-500 text-sm leading-relaxed mb-6">Untuk kamu yang juara lomba Akademik, Olahraga, atau Seni tingkat Kota, Provinsi, hingga Nasional. Nikmati potongan biaya masuk yang menarik.</p>
                        <a href="{{ route('register') }}" class="inline-block w-full py-3 bg-white border-2 border-masoem-primary text-masoem-primary font-bold rounded-lg hover:bg-masoem-primary hover:text-white transition">Ajukan Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-masoem-primary text-white pt-20 pb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-masoem-primary font-bold text-xl">M</div>
                        <span class="text-2xl font-bold tracking-tight">Masoem University</span>
                    </div>
                    <p class="text-blue-200 leading-relaxed max-w-sm">
                        Menyelenggarakan pendidikan tinggi yang berkualitas dengan memadukan ilmu pengetahuan, teknologi, dan nilai-nilai Islami untuk mencetak generasi unggul.
                    </p>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-6 text-white border-b border-blue-800 pb-2 inline-block">Hubungi Kami</h3>
                    <ul class="space-y-4 text-blue-200">
                        <li class="flex items-start gap-3">
                            <svg class="w-6 h-6 shrink-0 text-masoem-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Jl. Raya Cipacing No. 22 Jatinangor, Sumedang
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-6 h-6 shrink-0 text-masoem-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            info@masoem.ac.id
                        </li>
                        <li class="flex items-center gap-3">
                            <svg class="w-6 h-6 shrink-0 text-masoem-accent" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            (022) 12345678
                        </li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-lg font-bold mb-6 text-white border-b border-blue-800 pb-2 inline-block">Akses Cepat</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('login') }}" class="text-blue-200 hover:text-white hover:pl-2 transition-all">Login Mahasiswa</a></li>
                        <li><a href="{{ route('register') }}" class="text-blue-200 hover:text-white hover:pl-2 transition-all">Daftar Online</a></li>
                        <li><a href="#" class="text-blue-200 hover:text-white hover:pl-2 transition-all">Cek Kelulusan</a></li>
                        <li><a href="#" class="text-blue-200 hover:text-white hover:pl-2 transition-all">Download Brosur</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-blue-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-blue-300 text-sm">
                <p>&copy; {{ date('Y') }} Masoem University. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-white transition">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-white transition">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>