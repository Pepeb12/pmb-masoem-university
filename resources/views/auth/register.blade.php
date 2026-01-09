<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - PMB Masoem University</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        masoem: {
                            primary: '#0e3b6b', // Navy Blue
                            light: '#1d4ed8',   
                            accent: '#f97316',  
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased text-gray-900 bg-gray-50">

    <div class="min-h-screen flex">
        
        <div class="hidden lg:flex w-1/2 bg-gradient-to-br from-masoem-primary to-blue-900 relative overflow-hidden justify-center items-center">
            <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/diamond-upholstery.png')]"></div>
            
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
            <div class="absolute bottom-0 right-0 w-80 h-80 bg-masoem-accent rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>

            <div class="relative z-10 text-center px-12">
                <div class="w-24 h-24 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center text-white font-extrabold text-5xl mb-6 mx-auto shadow-2xl border border-white/20">
                    M
                </div>
                <h2 class="text-4xl font-bold text-white mb-4">Bergabunglah Bersama Kami</h2>
                <p class="text-blue-100 text-lg leading-relaxed">
                    Langkah awal menuju masa depan gemilang dimulai di sini. <br>Daftarkan dirimu sekarang juga.
                </p>
                <div class="mt-8">
                    <a href="{{ url('/') }}" class="inline-flex items-center text-white hover:text-masoem-accent transition font-semibold">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 bg-white overflow-y-auto">
            <div class="w-full max-w-md">
                
                <div class="lg:hidden text-center mb-8">
                    <div class="w-14 h-14 bg-masoem-primary rounded-lg flex items-center justify-center text-white font-bold text-2xl mx-auto mb-3 shadow-md">M</div>
                    <h2 class="text-2xl font-bold text-masoem-primary">Masoem University</h2>
                </div>

                <div class="mb-8">
                    <h3 class="text-2xl font-bold text-gray-800">Buat Akun Baru</h3>
                    <p class="text-gray-500 text-sm mt-2">Isi data diri Anda untuk memulai pendaftaran.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" 
                                class="pl-10 w-full rounded-lg border border-gray-300 focus:border-masoem-primary focus:ring-masoem-primary shadow-sm h-11 transition" placeholder="Nama Sesuai Ijazah">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Alamat Email</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                            </div>
                            <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" 
                                class="pl-10 w-full rounded-lg border border-gray-300 focus:border-masoem-primary focus:ring-masoem-primary shadow-sm h-11 transition" placeholder="email@aktif.com">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            </div>
                            <input id="password" type="password" name="password" required autocomplete="new-password"
                                class="pl-10 w-full rounded-lg border border-gray-300 focus:border-masoem-primary focus:ring-masoem-primary shadow-sm h-11 transition" placeholder="Minimal 8 karakter">
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                class="pl-10 w-full rounded-lg border border-gray-300 focus:border-masoem-primary focus:ring-masoem-primary shadow-sm h-11 transition" placeholder="Ulangi password">
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-masoem-primary hover:bg-blue-800 text-white font-bold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5 flex justify-center items-center gap-2">
                            Daftar Sekarang
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="text-masoem-primary font-bold hover:underline">
                            Masuk di sini
                        </a>
                    </p>
                </div>
                
                 <div class="lg:hidden mt-8 text-center pb-4">
                    <a href="{{ url('/') }}" class="text-gray-400 text-sm hover:text-gray-600">Kembali ke Beranda</a>
               </div>

            </div>
        </div>
    </div>
</body>
</html>