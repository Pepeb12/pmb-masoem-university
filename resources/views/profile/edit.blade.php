<x-app-layout>
    <x-slot name="header">
        <div class="bg-gray-800 -m-6 mb-6 p-8 pt-10 pb-20 text-white rounded-b-3xl shadow-lg relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')]"></div>
            <div class="relative z-10 max-w-7xl mx-auto flex justify-between items-center">
                <div>
                    <h2 class="font-extrabold text-3xl leading-tight">
                        Profil & Akun
                    </h2>
                    <p class="text-gray-400 mt-2 text-lg">
                        Kelola informasi akun dan keamanan login Anda.
                    </p>
                </div>
                <div class="hidden md:block opacity-30">
                    <svg class="w-20 h-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20 pb-12">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <div class="col-span-1">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6 text-center sticky top-24">
                    <div class="w-32 h-32 mx-auto bg-gray-800 rounded-full flex items-center justify-center text-white mb-4 ring-4 ring-gray-100 shadow-sm">
                        <span class="text-4xl font-bold">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                    
                    <h3 class="font-bold text-gray-800 text-xl">{{ $user->name }}</h3>
                    <p class="text-blue-600 font-medium text-sm mb-4">{{ $user->email }}</p>
                    
                    <div class="inline-block px-4 py-1.5 rounded-full text-sm font-bold bg-gray-100 text-gray-600 uppercase tracking-wide">
                        Role: {{ $user->role }}
                    </div>

                    <div class="mt-8 border-t border-gray-100 pt-6 text-left">
                        <h4 class="text-xs font-bold text-gray-400 uppercase mb-3">Info Login</h4>
                        <div class="flex items-center gap-3 text-sm text-gray-600 mb-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span>Bergabung: {{ $user->created_at->format('d M Y') }}</span>
                        </div>
                         <div class="flex items-center gap-3 text-sm text-gray-600">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>Terakhir Update: {{ $user->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-1 lg:col-span-2 space-y-6">
                
                <div class="p-4 sm:p-8 bg-white shadow-lg sm:rounded-2xl border border-gray-100">
                    <div class="max-w-xl">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Informasi Akun</h3>
                        <p class="text-sm text-gray-500 mb-6">Ubah nama tampilan dan alamat email akun Anda.</p>
                        
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow-lg sm:rounded-2xl border border-gray-100">
                    <div class="max-w-xl">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Ganti Password</h3>
                        <p class="text-sm text-gray-500 mb-6">Pastikan akun Anda aman dengan menggunakan password yang kuat.</p>
                        
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow-lg sm:rounded-2xl border border-red-100">
                    <div class="max-w-xl">
                        <h3 class="text-lg font-bold text-red-600 mb-1">Hapus Akun</h3>
                        <p class="text-sm text-gray-500 mb-6">Setelah akun dihapus, semua data akan hilang permanen.</p>
                        
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>