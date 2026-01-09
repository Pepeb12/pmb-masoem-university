<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white border-l-4 border-blue-800 rounded-r-lg shadow-sm p-6 mb-6 flex justify-between items-center bg-blue-50">
                <div>
                    <h3 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ Auth::user()->name }}</h3>
                    <p class="text-gray-600 text-sm mt-1">Sistem Penerimaan Mahasiswa Baru (PMB) Masoem University.</p>
                </div>
                <div class="hidden sm:block text-right">
                    <p class="text-xs text-gray-500 uppercase tracking-wider font-bold">Tanggal Hari Ini</p>
                    <p class="text-lg font-bold text-blue-800">{{ now()->format('d F Y') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <div class="lg:col-span-2 space-y-6">
                    
                    @php
                        $mhs = App\Models\Mahasiswa::where('user_id', Auth::id())->first();
                    @endphp

                    @if(!$mhs)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200">
                            <div class="flex items-start">
                                <div class="flex-shrink-0 bg-red-100 rounded-md p-3">
                                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="ml-4">
                                    <h3 class="text-lg font-bold text-gray-900">Status: Belum Terdaftar</h3>
                                    <p class="text-sm text-gray-500 mt-1 mb-4">Anda belum melengkapi data pendaftaran. Silakan isi formulir untuk melanjutkan proses seleksi.</p>
                                    
                                    <a href="{{ route('pendaftaran.index') }}" 
                                       class="inline-flex items-center px-4 py-2 border border-blue-600 rounded-md shadow-sm text-sm font-bold text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition"
                                       style="background-color: #eff6ff; color: #1d4ed8; border: 1px solid #2563eb;">
                                        Isi Formulir Pendaftaran &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden border border-gray-200">
                            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                                <h4 class="text-xs font-bold text-gray-500 uppercase tracking-wider">Status Pendaftaran</h4>
                                @if($mhs->status == 'baru')
                                    <span class="px-2 py-1 text-xs font-bold rounded bg-yellow-100 text-yellow-800 border border-yellow-200">VERIFIKASI</span>
                                @elseif($mhs->status == 'diverifikasi')
                                    <span class="px-2 py-1 text-xs font-bold rounded bg-green-100 text-green-800 border border-green-200">VALID</span>
                                @else
                                    <span class="px-2 py-1 text-xs font-bold rounded bg-red-100 text-red-800 border border-red-200">DITOLAK</span>
                                @endif
                            </div>
                            
                            <div class="p-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        @if($mhs->status == 'baru')
                                            <h2 class="text-xl font-bold text-gray-800">Menunggu Verifikasi</h2>
                                            <p class="text-sm text-gray-500 mt-1">Admin sedang memeriksa berkas Anda.</p>
                                        @elseif($mhs->status == 'diverifikasi')
                                            <h2 class="text-xl font-bold text-gray-800">Pendaftaran Diterima</h2>
                                            <p class="text-sm text-gray-500 mt-1">Silakan cetak kartu ujian untuk dibawa saat tes.</p>
                                        @else
                                            <h2 class="text-xl font-bold text-red-600">Pendaftaran Bermasalah</h2>
                                            <p class="text-sm text-gray-500 mt-1">Silakan perbaiki dokumen Anda.</p>
                                        @endif
                                    </div>

                                    @if($mhs->status == 'diverifikasi')
                                        <a href="{{ route('pendaftaran.kartu') }}" target="_blank" 
                                           class="inline-flex items-center px-4 py-2 border border-green-600 rounded-md shadow-sm text-sm font-bold text-green-800 bg-green-50 hover:bg-green-100 focus:outline-none transition"
                                           style="background-color: #f0fdf4; color: #166534; border: 1px solid #16a34a;">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                                            Cetak Kartu
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 border border-gray-200">
                            <h4 class="font-bold text-sm text-gray-700 mb-4 uppercase">Tahapan Seleksi</h4>
                            <div class="relative">
                                <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-gray-200 rounded"></div>
                                <div class="relative flex justify-between">
                                    <div class="text-center bg-white px-2">
                                        <div class="w-8 h-8 mx-auto bg-blue-600 rounded-full flex items-center justify-center text-white text-xs font-bold ring-4 ring-white" style="background-color: #2563eb;">
                                            ✓
                                        </div>
                                        <p class="mt-2 text-xs font-bold text-blue-700">Daftar</p>
                                    </div>
                                    <div class="text-center bg-white px-2">
                                        <div class="w-8 h-8 mx-auto {{ $mhs->status != 'baru' ? 'bg-blue-600 text-white' : 'bg-white border-2 border-blue-600 text-blue-600' }} rounded-full flex items-center justify-center text-xs font-bold ring-4 ring-white">
                                            @if($mhs->status != 'baru') ✓ @else 2 @endif
                                        </div>
                                        <p class="mt-2 text-xs font-bold {{ $mhs->status == 'baru' ? 'text-blue-600' : 'text-gray-500' }}">Verifikasi</p>
                                    </div>
                                    <div class="text-center bg-white px-2">
                                        <div class="w-8 h-8 mx-auto {{ $mhs->status == 'diverifikasi' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500' }} rounded-full flex items-center justify-center text-xs font-bold ring-4 ring-white">
                                            3
                                        </div>
                                        <p class="mt-2 text-xs font-bold {{ $mhs->status == 'diverifikasi' ? 'text-blue-600' : 'text-gray-400' }}">Selesai</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

                <div class="space-y-6">
                    
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 p-5">
                        <div class="flex items-center space-x-4">
                            @if(isset($mhs) && $mhs->foto)
                                <img src="{{ asset('storage/' . $mhs->foto) }}" class="w-16 h-16 rounded-md object-cover border border-gray-300">
                            @else
                                <div class="w-16 h-16 rounded-md bg-gray-200 flex items-center justify-center text-gray-500 font-bold text-xl">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm">{{ Auth::user()->name }}</h4>
                                <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                                @if(isset($mhs))
                                    <p class="text-xs font-bold text-blue-600 mt-1">NIM: {{ $mhs->nim }}</p>
                                @endif
                            </div>
                        </div>
                        
                        @if(isset($mhs))
                            <div class="mt-4 pt-4 border-t border-gray-100 text-xs text-gray-600">
                                <strong>Prodi Pilihan:</strong><br>
                                {{ $mhs->prodi->nama_prodi ?? '-' }}
                            </div>
                        @endif
                    </div>

                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 p-5">
                        <h4 class="font-bold text-gray-800 text-sm mb-2">Pusat Bantuan</h4>
                        <p class="text-xs text-gray-500 mb-4">Kesulitan saat mendaftar? Hubungi kami segera.</p>
                        
                        <a href="#" class="block w-full py-2 px-4 bg-white border border-green-500 text-green-700 text-center rounded-md text-sm font-bold hover:bg-green-50 transition"
                           style="color: #15803d; border-color: #22c55e;">
                            <span class="mr-2">📞</span> WhatsApp Admin
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>