<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Surat Desa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-emerald-50 via-white to-blue-50 min-h-screen">
    <div class="container mx-auto px-4 py-8 min-h-screen flex items-center justify-center">
        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center max-w-6xl w-full">
            
            <!-- Left Side - Welcome Section -->
            <div class="hidden lg:block">
                <div class="space-y-6">
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 leading-tight">
                        Selamat Datang di<br />
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-emerald-600">E-Surat Desa</span>
                    </h1>
                    
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Platform digital untuk memudahkan warga desa dalam mengurus berbagai keperluan administrasi secara online. Praktis, cepat, dan efisien.
                    </p>

                    <div class="bg-white rounded-2xl shadow-lg p-8">
                        <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=500&h=350&fit=crop" alt="Community" class="rounded-xl w-full h-64 object-cover mb-6">
                        <div class="grid grid-cols-3 gap-4">
                            <div class="text-center p-4 bg-emerald-50 rounded-xl">
                                <div class="text-2xl font-bold text-emerald-600 mb-1">24/7</div>
                                <div class="text-xs text-gray-600">Layanan Aktif</div>
                            </div>
                            <div class="text-center p-4 bg-blue-50 rounded-xl">
                                <div class="text-2xl font-bold text-blue-600 mb-1">Aman</div>
                                <div class="text-xs text-gray-600">Data Terlindungi</div>
                            </div>
                            <div class="text-center p-4 bg-purple-50 rounded-xl">
                                <div class="text-2xl font-bold text-purple-600 mb-1">Mudah</div>
                                <div class="text-xs text-gray-600">User Friendly</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Login Form -->
            <div class="w-full">
                <div class="bg-white rounded-3xl shadow-2xl p-8 lg:p-12">
                    
                    <!-- Logo -->
                    <div class="flex justify-center mb-8">
                        <a href="{{ route('login') }}">
                            <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" class="h-24 w-auto">
                        </a>
                    </div>

                    <div class="mb-8 text-center lg:text-left">
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Masuk ke Akun Anda</h2>
                        <p class="text-gray-600">Website Pelayanan Surat Desa</p>
                    </div>

                    @if (session('success'))
                        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl flex items-start space-x-3">
                            <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    @if (Session::get('warning'))
                        <div class="mb-6 p-4 bg-amber-50 border border-amber-200 text-amber-700 rounded-xl flex items-start space-x-3">
                            <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                            </svg>
                            <span>{{ Session::get('warning') }}</span>
                        </div>
                    @endif

                    <form action="{{ route('proseslogin') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">Nama Pengguna</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input 
                                    type="text" 
                                    id="username"
                                    name="username" 
                                    required
                                    class="w-full pl-12 pr-4 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 placeholder-gray-400"
                                    placeholder="Masukkan nama pengguna Anda"
                                >
                            </div>
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input 
                                    type="password" 
                                    id="password"
                                    name="password" 
                                    required
                                    class="w-full pl-12 pr-12 py-3.5 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 placeholder-gray-400"
                                    placeholder="Masukkan password Anda"
                                >
                                <button 
                                    type="button"
                                    id="togglePassword"
                                    class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-gray-600 transition focus:outline-none"
                                >
                                    <svg id="eyeIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                    <svg id="eyeOffIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center cursor-pointer">
                                <input type="checkbox" class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500">
                                <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                            </label>
                            <a href="#" class="text-sm font-medium text-emerald-600 hover:text-emerald-700 transition">
                                Lupa Kata Sandi?
                            </a>
                        </div>

                        <button 
                            type="submit" 
                            class="w-full bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-semibold py-4 rounded-xl hover:shadow-xl transition transform hover:scale-[1.02] active:scale-[0.98]"
                        >
                            Masuk
                        </button>
                    </form>

                    <div class="mt-8 text-center">
                        <p class="text-gray-600">
                            Belum punya akun? 
                            <a href="{{ route('register') }}" class="font-semibold text-emerald-600 hover:text-emerald-700 transition">
                                Buat Akun
                            </a>
                        </p>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100">
                        <div class="flex items-center justify-center space-x-2 text-sm text-gray-500">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Data Anda aman dan terenkripsi</span>
                        </div>
                    </div>
                </div>

                <!-- Mobile Welcome Text -->
                <div class="lg:hidden mt-8 text-center">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Selamat Datang di E-Surat Desa</h2>
                    <p class="text-gray-600">Platform pelayanan surat desa yang praktis dan efisien</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        const eyeOffIcon = document.getElementById('eyeOffIcon');

        togglePassword.addEventListener('click', function() {
            // Toggle tipe input antara password dan text
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle ikon mata
            eyeIcon.classList.toggle('hidden');
            eyeOffIcon.classList.toggle('hidden');
        });
    </script>
</body>
</html