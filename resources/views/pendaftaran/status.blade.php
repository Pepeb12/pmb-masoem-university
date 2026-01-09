<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Status Pendaftaran</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 p-6 shadow sm:rounded-lg text-center">
                
                <img src="{{ asset('storage/' . $mahasiswa->foto) }}" class="w-32 h-32 object-cover rounded-full mx-auto mb-4 border-4 border-blue-500">
                <h3 class="text-2xl font-bold text-gray-800 dark:text-white">{{ $mahasiswa->nama }}</h3>
                <p class="text-gray-500">Prodi: {{ $mahasiswa->prodi->nama_prodi }}</p>
                <p class="text-gray-500 mb-6">No. Reg: {{ $mahasiswa->nim }}</p>

                @if($mahasiswa->status == 'baru')
                    <div class="bg-yellow-100 text-yellow-800 p-4 rounded mb-6">
                        <span class="font-bold">STATUS: MENUNGGU VERIFIKASI</span>
                        <p class="text-sm">Admin sedang memeriksa berkas Ijazah & KK Anda.</p>
                    </div>
                @elseif($mahasiswa->status == 'diverifikasi')
                    <div class="bg-green-100 text-green-800 p-4 rounded mb-6">
                        <span class="font-bold">STATUS: TERVERIFIKASI</span>
                        <p class="text-sm">Selamat! Berkas Anda valid. Silakan cetak kartu ujian.</p>
                    </div>
                    
                    <a href="{{ route('pendaftaran.kartu') }}" target="_blank" class="bg-blue-600 text-white font-bold py-3 px-6 rounded shadow hover:bg-blue-700">
                        🖨 Cetak Kartu Ujian
                    </a>
                @else
                    <div class="bg-red-100 text-red-800 p-4 rounded mb-6">
                        <span class="font-bold">STATUS: DITOLAK</span>
                        <p class="text-sm">Mohon perbaiki berkas Anda dan hubungi Admin.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>