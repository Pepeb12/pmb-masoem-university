<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Dosen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <a href="{{ route('dosen.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-blue-700">
                        + Tambah Dosen
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="px-6 py-3">No</th>
                                <th class="px-6 py-3">Kode/NIP</th>
                                <th class="px-6 py-3">Nama Dosen</th>
                                <th class="px-6 py-3">Email</th>
                                <th class="px-6 py-3 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($dosens as $index => $dosen)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $index + 1 }}</td>
                                <td class="px-6 py-4 font-bold">{{ $dosen->kode_dosen }}</td>
                                <td class="px-6 py-4">{{ $dosen->nama_dosen }}</td>
                                <td class="px-6 py-4">{{ $dosen->email }}</td>
                                <td class="px-6 py-4 text-center flex justify-center gap-2">
                                    <a href="{{ route('dosen.edit', $dosen->id) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                    <span class="text-gray-300">|</span>
                                    <form action="{{ route('dosen.destroy', $dosen->id) }}" method="POST" onsubmit="return confirm('Hapus data ini?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-400">Belum ada data dosen.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>