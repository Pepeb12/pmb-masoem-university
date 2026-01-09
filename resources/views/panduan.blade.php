<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panduan Pendaftaran - Masoem University</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        masoem: {
                            primary: '#0e3b6b', 
                            light: '#1d4ed8',   
                            accent: '#f97316',  
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50 text-gray-700 font-sans antialiased">

    <nav class="bg-white shadow-sm border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-masoem-primary rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-md">M</div>
                <div>
                    <h1 class="text-xl font-extrabold text-masoem-primary leading-none">MASOEM</h1>
                    <span class="text-xs text-masoem-accent font-bold tracking-[0.2em]">UNIVERSITY</span>
                </div>
            </div>
            <a href="{{ url('/') }}" class="text-gray-500 hover:text-masoem-primary font-medium flex items-center gap-2 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Beranda
            </a>
        </div>
    </nav>

    <div class="bg-masoem-primary py-12 text-center text-white">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">Panduan Pendaftaran Mahasiswa Baru</h1>
            <p class="text-blue-200 text-lg">Informasi lengkap mengenai persyaratan berkas, rincian biaya, dan jadwal seleksi.</p>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 py-12 -mt-8">
        
        <div class="grid gap-8">
            <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-2 h-full bg-blue-500"></div>
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center text-xl font-bold shrink-0">1</div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Persyaratan Dokumen</h2>
                        <p class="text-gray-500 mt-1">Siapkan dokumen berikut dalam format PDF atau JPG sebelum mendaftar.</p>
                    </div>
                </div>
                
                <div class="grid md:grid-cols-2 gap-4 ml-0 md:ml-16">
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Scan Ijazah / SKL (Legalisir)</span>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Scan Kartu Keluarga (KK)</span>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Scan KTP / Kartu Pelajar</span>
                    </div>
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-lg">
                        <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span>Pas Foto 3x4 (Latar Merah/Biru)</span>
                    </div>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-2 h-full bg-masoem-accent"></div>
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-xl flex items-center justify-center text-xl font-bold shrink-0">2</div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Rincian Biaya Pendaftaran</h2>
                        <p class="text-gray-500 mt-1">Biaya formulir berdasarkan gelombang pendaftaran.</p>
                    </div>
                </div>

                <div class="overflow-x-auto ml-0 md:ml-16">
                    <table class="w-full text-sm text-left text-gray-600 border border-gray-200 rounded-lg overflow-hidden">
                        <thead class="text-xs text-white uppercase bg-masoem-primary">
                            <tr>
                                <th class="px-6 py-4">Gelombang</th>
                                <th class="px-6 py-4">Periode</th>
                                <th class="px-6 py-4">Biaya Formulir</th>
                                <th class="px-6 py-4">Promo DPP</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td class="px-6 py-4 font-bold text-gray-900">Gelombang 1</td>
                                <td class="px-6 py-4">Nov - Feb</td>
                                <td class="px-6 py-4">Rp 250.000</td>
                                <td class="px-6 py-4"><span class="bg-green-100 text-green-800 text-xs font-bold px-2.5 py-0.5 rounded">Diskon 50%</span></td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 font-bold text-gray-900">Gelombang 2</td>
                                <td class="px-6 py-4">Mar - Mei</td>
                                <td class="px-6 py-4">Rp 300.000</td>
                                <td class="px-6 py-4"><span class="bg-green-100 text-green-800 text-xs font-bold px-2.5 py-0.5 rounded">Diskon 25%</span></td>
                            </tr>
                            <tr>
                                <td class="px-6 py-4 font-bold text-gray-900">Gelombang 3</td>
                                <td class="px-6 py-4">Jun - Ags</td>
                                <td class="px-6 py-4">Rp 350.000</td>
                                <td class="px-6 py-4">-</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center text-xl font-bold shrink-0">3</div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Jadwal Seleksi</h2>
                        <p class="text-gray-500 mt-1">Tahapan yang harus diikuti oleh calon mahasiswa.</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 ml-0 md:ml-16">
                    <div class="p-5 bg-purple-50 rounded-xl border border-purple-100">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <h4 class="font-bold text-purple-800">Ujian Tulis (CBT)</h4>
                        </div>
                        <p class="text-sm text-gray-600">Dilaksanakan setiap hari <strong>Sabtu, Pukul 09.00 WIB</strong> secara daring (online) melalui portal ujian Masoem.</p>
                    </div>
                    <div class="p-5 bg-purple-50 rounded-xl border border-purple-100">
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"></path></svg>
                            <h4 class="font-bold text-purple-800">Wawancara</h4>
                        </div>
                        <p class="text-sm text-gray-600">Jadwal wawancara akan diinformasikan melalui WhatsApp atau Email setelah peserta dinyatakan <strong>LULUS</strong> ujian CBT.</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="flex justify-center gap-4 mt-12 mb-8">
            <a href="{{ route('register') }}" class="bg-masoem-primary text-white px-10 py-4 rounded-full font-bold hover:bg-masoem-light transition shadow-xl hover:shadow-blue-500/30 transform hover:-translate-y-1">
                Daftar Sekarang
            </a>
            <a href="#" class="bg-white border-2 border-masoem-primary text-masoem-primary px-10 py-4 rounded-full font-bold hover:bg-blue-50 transition">
                Download Brosur
            </a>
        </div>

    </div>

    <footer class="bg-white border-t border-gray-200 py-8 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} Masoem University. All rights reserved.
    </footer>

</body>
</html>