<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - E-Surat Desa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-emerald-50 via-white to-blue-50 min-h-screen">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-6xl mx-auto">
            
            <!-- Logo and Header -->
            <div class="text-center mb-8">
                <a href="{{ route('login') }}">
                    <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" class="h-24 w-auto mx-auto mb-4">
                </a>
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-2">Daftar Akun E-Surat Desa</h1>
                <p class="text-gray-600">Lengkapi data diri Anda untuk membuat akun</p>
            </div>

            <div class="bg-white rounded-3xl shadow-2xl p-6 lg:p-10">
                
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                            <ul class="list-disc list-inside space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="{{ route('prosesregister') }}" method="POST" class="space-y-8">
                    @csrf

                    <!-- Data Akun Section -->
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-6 pb-2 border-b-2 border-emerald-500">Data Akun</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            
                            <!-- Username -->
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
                                        value="{{ old('username') }}"
                                        required
                                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 placeholder-gray-400"
                                        placeholder="Masukkan nama pengguna"
                                    >
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Nama pengguna untuk login ke sistem</p>
                            </div>

                            <div></div>

                            <!-- Password -->
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
                                        class="w-full pl-12 pr-12 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 placeholder-gray-400"
                                        placeholder="Masukkan password"
                                    >
                                    <button type="button" onclick="togglePassword('password', this)" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Minimal 8 karakter, kombinasi huruf dan angka disarankan</p>
                            </div>

                            <!-- Konfirmasi Password -->
                            <div>
                                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                        </svg>
                                    </div>
                                    <input 
                                        type="password" 
                                        id="password_confirmation"
                                        name="password_confirmation" 
                                        required
                                        class="w-full pl-12 pr-12 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 placeholder-gray-400"
                                        placeholder="Ulangi password"
                                    >
                                    <button type="button" onclick="togglePassword('password_confirmation', this)" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                                        <svg class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </button>
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Harus sama dengan password yang dimasukkan sebelumnya</p>
                            </div>

                        </div>
                    </div>

                    <!-- Data Diri Section -->
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-6 pb-2 border-b-2 border-emerald-500">Data Diri</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            
                            <!-- NIK -->
                            <div>
                                <label for="nik" class="block text-sm font-semibold text-gray-700 mb-2">NIK</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="nik"
                                        name="nik" 
                                        value="{{ old('nik') }}"
                                        required
                                        maxlength="16"
                                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 placeholder-gray-400"
                                        placeholder="Nomor Induk Kependudukan"
                                    >
                                </div>
                                <p class="mt-1 text-xs text-gray-500">16 digit NIK sesuai KTP</p>
                            </div>

                            <!-- Nama Lengkap -->
                            <div>
                                <label for="nama_lengkap" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="nama_lengkap"
                                        name="nama_lengkap" 
                                        value="{{ old('nama_lengkap') }}"
                                        required
                                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 placeholder-gray-400"
                                        placeholder="Nama lengkap"
                                    >
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Masukkan nama lengkap sesuai KTP</p>
                            </div>

                            <!-- Tempat Lahir -->
                            <div>
                                <label for="tempat_lahir" class="block text-sm font-semibold text-gray-700 mb-2">Tempat Lahir</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="tempat_lahir"
                                        name="tempat_lahir" 
                                        value="{{ old('tempat_lahir') }}"
                                        required
                                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 placeholder-gray-400"
                                        placeholder="Tempat lahir"
                                    >
                                </div>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div>
                                <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Lahir</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input 
                                        type="date" 
                                        id="tanggal_lahir"
                                        name="tanggal_lahir" 
                                        value="{{ old('tanggal_lahir') }}"
                                        required
                                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700"
                                    >
                                </div>
                            </div>

                            <!-- Jenis Kelamin -->
                            <div>
                                <label for="jenis_kelamin" class="block text-sm font-semibold text-gray-700 mb-2">Jenis Kelamin</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                        </svg>
                                    </div>
                                    <select 
                                        id="jenis_kelamin"
                                        name="jenis_kelamin" 
                                        required
                                        class="w-full pl-12 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 appearance-none bg-white"
                                    >
                                        <option value="">Pilih Jenis Kelamin</option>
                                        <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                        <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Alamat Lengkap -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Lengkap</label>
                                <div class="grid grid-cols-1 md:grid-cols-12 gap-4">
                                    <!-- Kampung -->
                                    <div class="md:col-span-6">
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                                </svg>
                                            </div>
                                            <input 
                                                type="text" 
                                                id="kampung"
                                                name="kampung" 
                                                value="{{ old('kampung', 'Kp. ') }}"
                                                required
                                                class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 placeholder-gray-400"
                                                placeholder="Kp. Nama Kampung"
                                            >
                                        </div>
                                    </div>
                                    <!-- RT -->
                                    <div class="md:col-span-3">
                                        <input 
                                            type="text" 
                                            id="rt"
                                            name="rt" 
                                            value="{{ old('rt') }}"
                                            required
                                            maxlength="3"
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 placeholder-gray-400"
                                            placeholder="RT 001"
                                        >
                                    </div>
                                    <!-- RW -->
                                    <div class="md:col-span-3">
                                        <input 
                                            type="text" 
                                            id="rw"
                                            name="rw" 
                                            value="{{ old('rw') }}"
                                            required
                                            maxlength="3"
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 placeholder-gray-400"
                                            placeholder="RW 001"
                                        >
                                    </div>
                                    <!-- Desa/Kec/Prov -->
                                    <div class="md:col-span-12 mt-2">
                                        <div class="relative">
                                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                                                </svg>
                                            </div>
                                            <input 
                                                type="text" 
                                                id="desa_kec_prov"
                                                name="desa_kec_prov" 
                                                value="Desa. Karangmekar, Kec. Cimanggu, Kab. Sukabumi, Prov. Jawa Barat"
                                                readonly
                                                class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl bg-gray-50 text-gray-600 outline-none"
                                            >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Agama -->
                            <div>
                                <label for="agama" class="block text-sm font-semibold text-gray-700 mb-2">Agama</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                        </svg>
                                    </div>
                                    <select 
                                        id="agama"
                                        name="agama" 
                                        required
                                        class="w-full pl-12 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 appearance-none bg-white"
                                    >
                                        <option value="">Pilih Agama</option>
                                        <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                        <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                        <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                        <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>Budha</option>
                                        <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Perkawinan -->
                            <div>
                                  <label for="status_perkawinan" class="block text-sm font-semibold text-gray-700 mb-2">Status Perkawinan</label>
                                  <div class="relative">
                                      <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none z-10">
                                          <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                          </svg>
                                      </div>
                                      <select 
                                          id="status_perkawinan"
                                          name="status_perkawinan" 
                                          required
                                          class="w-full pl-12 pr-10 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 appearance-none bg-white"
                                      >
                                          <option value="">Pilih Status Perkawinan</option>
                                          <option value="Belum Menikah" {{ old('status_perkawinan') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                                          <option value="Menikah" {{ old('status_perkawinan') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                                          <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                                          <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                                      </select>
                                      <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                          <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                          </svg>
                                      </div>
                                  </div>
                              </div>


                            <!-- Pekerjaan -->
                            <div>
                                <label for="pekerjaan" class="block text-sm font-semibold text-gray-700 mb-2">Pekerjaan</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="pekerjaan"
                                        name="pekerjaan" 
                                        value="{{ old('pekerjaan') }}"
                                        required
                                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 placeholder-gray-400"
                                        placeholder="Pekerjaan"
                                    >
                                </div>
                            </div>

                            <!-- Kewarganegaraan -->
                            <div>
                                <label for="kewarganegaraan" class="block text-sm font-semibold text-gray-700 mb-2">Kewarganegaraan</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="kewarganegaraan"
                                        name="kewarganegaraan" 
                                        value="{{ old('kewarganegaraan', 'Indonesia') }}"
                                        required
                                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 placeholder-gray-400"
                                        placeholder="Kewarganegaraan"
                                    >
                                </div>
                            </div>

                            <!-- Nama Ayah -->
                            <div>
                                <label for="nama_ayah" class="block text-sm font-semibold text-gray-700 mb-2">Nama Ayah</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="nama_ayah"
                                        name="nama_ayah" 
                                        value="{{ old('nama_ayah') }}"
                                        required
                                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 placeholder-gray-400"
                                        placeholder="Nama ayah"
                                    >
                                </div>
                            </div>

                            <!-- Nama Ibu -->
                            <div>
                                <label for="nama_ibu" class="block text-sm font-semibold text-gray-700 mb-2">Nama Ibu</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                        </svg>
                                    </div>
                                    <input 
                                        type="text" 
                                        id="nama_ibu"
                                        name="nama_ibu" 
                                        value="{{ old('nama_ibu') }}"
                                        required
                                        class="w-full pl-12 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 placeholder-gray-400"
                                        placeholder="Nama ibu"
                                    >
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-6">
                        <button 
                            type="submit" 
                            class="w-full bg-gradient-to-r from-emerald-500 to-emerald-600 text-white font-semibold py-4 rounded-xl hover:shadow-xl transition transform hover:scale-[1.02] active:scale-[0.98]"
                        >
                            Daftar Sekarang
                        </button>
                    </div>
                </form>

                <!-- Link to Login -->
                <div class="mt-8 text-center">
                    <p class="text-gray-600">
                        Sudah punya akun? 
                        <a href="{{ route('login') }}" class="font-semibold text-emerald-600 hover:text-emerald-700 transition">
                            Masuk di sini
                        </a>
                    </p>
                </div>

                <!-- Security Message -->
                <div class="mt-6 pt-6 border-t border-gray-100">
                    <div class="flex items-center justify-center space-x-2 text-sm text-gray-500">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span>Data Anda aman dan terenkripsi</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Toggle Password Visibility
        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            const svg = btn.querySelector('svg');
            
            if (input.type === 'password') {
                input.type = 'text';
                svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>';
            } else {
                input.type = 'password';
                svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
            }
        }

        // Capitalize After Space
        function capitalizeAfterSpace(text) {
            return text
                .split(' ')
                .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                .join(' ');
        }

        // Enforce Prefix for Kampung
        function enforcePrefix(input, prefix) {
            if (!input.value.startsWith(prefix)) {
                input.value = prefix;
            }
            if (input.value.length > prefix.length) {
                const afterPrefix = input.value.slice(prefix.length);
                input.value = prefix + capitalizeAfterSpace(afterPrefix);
            }
        }

        // Initialize on Page Load
        window.addEventListener('DOMContentLoaded', () => {
            // Handle Kampung Input
            const kampungInput = document.getElementById('kampung');
            const prefix = 'Kp. ';
            
            if (!kampungInput.value.startsWith(prefix)) {
                kampungInput.value = prefix;
            }
            
            if (kampungInput.value.length > prefix.length) {
                const afterPrefix = kampungInput.value.slice(prefix.length);
                kampungInput.value = prefix + capitalizeAfterSpace(afterPrefix);
            }

            kampungInput.addEventListener('input', () => {
                enforcePrefix(kampungInput, prefix);
            });

            // Auto-capitalize inputs
            const skipNames = ['nik', 'rt', 'rw', 'kampung', 'desa_kec_prov', 'username'];
            const inputs = document.querySelectorAll('input[type="text"]:not([readonly])');

            inputs.forEach(input => {
                if (skipNames.includes(input.name)) return;

                input.addEventListener('input', () => {
                    const cursorPos = input.selectionStart;
                    input.value = capitalizeAfterSpace(input.value);
                    input.setSelectionRange(cursorPos, cursorPos);
                });

                if (input.value) {
                    input.value = capitalizeAfterSpace(input.value);
                }
            });
        });
    </script>
</body>
</html>