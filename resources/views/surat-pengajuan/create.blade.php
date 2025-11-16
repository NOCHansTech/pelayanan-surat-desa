@extends('layouts.layouts')

@section('page-title', 'Buat Surat')

@section('content')
<div class="space-y-6">
    
    <!-- Header Section -->
    <div>
        <div class="flex items-center space-x-3 mb-2">
            <a href="{{ route('surat-pengajuan') }}" class="p-2 hover:bg-gray-100 rounded-lg transition">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="text-2xl font-bold text-gray-900">Buat Surat Pengajuan</h2>
        </div>
        <p class="text-gray-600 ml-12">Silakan pilih jenis surat dan lengkapi data yang dibutuhkan untuk membuat surat</p>
    </div>

    <!-- Alert Messages -->
    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
            <div class="flex items-start">
                <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
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

    <!-- Form Card -->
    <form action="{{ route('surat-pengajuan.store') }}" method="POST" class="bg-white rounded-2xl shadow-md">
        @csrf
        
        <div class="p-6 space-y-8">
            
            <!-- Informasi Surat Section -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b-2 border-emerald-500">Informasi Surat</h3>
                <div class="grid md:grid-cols-2 gap-6">
                    
                    <!-- Jenis Surat -->
                    <div>
                        <label for="id_jenis_surat" class="block text-sm font-semibold text-gray-700 mb-2">
                            Jenis Surat <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <select name="id_jenis_surat" id="id_jenis_surat" required class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none appearance-none bg-white">
                                <option value="" disabled selected>-- Pilih Jenis Surat --</option>
                                @foreach ($jenisSurat as $surat)
                                    <option value="{{ $surat->id }}">{{ $surat->nama }} ({{ $surat->kode }})</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Pilih jenis surat yang akan diajukan</p>
                    </div>

                    <!-- Tanggal Pengajuan -->
                    <div>
                        <label for="tanggal_pengajuan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Pengajuan
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input type="date" name="tanggal_pengajuan" id="tanggal_pengajuan" readonly class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl bg-gray-50 text-gray-600 outline-none">
                        </div>
                    </div>

                </div>
            </div>

            <!-- Pilih Warga Section -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b-2 border-emerald-500">Data Pemohon</h3>
                
                <!-- Pilih Resident -->
                <div class="mb-6">
                    <label for="resident" class="block text-sm font-semibold text-gray-700 mb-2">
                        Pilih Warga (Opsional)
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <select name="resident_id" id="resident" class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none appearance-none bg-white">
                            <option value="">-- Pilih Warga Jika Sudah Terdaftar --</option>
                            @foreach ($residents as $resident)
                                <option value="{{ $resident->id }}">{{ $resident->nama_lengkap }} ({{ $resident->nik }})</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Pilih warga yang sudah terdaftar untuk otomatis mengisi data</p>
                </div>

                <div class="grid md:grid-cols-2 gap-6">
                    
                    <!-- NIK -->
                    <div>
                        <label for="nik" class="block text-sm font-semibold text-gray-700 mb-2">
                            NIK <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                </svg>
                            </div>
                            <input type="text" name="nik" id="nik" value="{{ old('nik') }}" required maxlength="16" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none" placeholder="Nomor Induk Kependudukan">
                        </div>
                    </div>

                    <!-- Nama Lengkap -->
                    <div>
                        <label for="nama_lengkap" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}" required class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none" placeholder="Nama lengkap sesuai KTP">
                        </div>
                    </div>

                    <!-- Tempat Lahir -->
                    <div>
                        <label for="tempat_lahir" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tempat Lahir <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir') }}" required class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none" placeholder="Tempat lahir">
                        </div>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none">
                        </div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label for="jenis_kelamin" class="block text-sm font-semibold text-gray-700 mb-2">
                            Jenis Kelamin <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                            </div>
                            <select name="jenis_kelamin" id="jenis_kelamin" required class="w-full pl-10 pr-10 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none appearance-none bg-white">
                                <option value="" disabled {{ old('jenis_kelamin') == null ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="block text-sm font-semibold text-gray-700 mb-2">
                            Alamat <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                                </svg>
                            </div>
                            <input type="text" name="alamat" id="alamat" value="{{ old('alamat') }}" required class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none" placeholder="Alamat lengkap">
                        </div>
                    </div>

                    <!-- Agama -->
                    <div>
                        <label for="agama" class="block text-sm font-semibold text-gray-700 mb-2">
                            Agama <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">
                            <!-- Icon -->
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/>
                                </svg>
                            </div>

                            <!-- Select -->
                            <select 
                                id="agama"
                                name="agama"
                                required
                                class="w-full pl-12 pr-10 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 appearance-none bg-white"
                            >
                                <option value="">Pilih Agama</option>
                                <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                                <option value="Katolik" {{ old('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                                <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                <option value="Buddha" {{ old('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                            </select>

                            <!-- Icon panah dropdown -->
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Status Perkawinan -->
                    <div>
                        <label for="status_perkawinan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Status Perkawinan <span class="text-red-500">*</span>
                        </label>

                        <div class="relative">
                            <!-- Icon -->
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                            </div>

                            <!-- Select -->
                            <select 
                                id="status_perkawinan"
                                name="status_perkawinan" 
                                required
                                class="w-full pl-12 pr-10 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none text-gray-700 appearance-none bg-white"
                            >
                                <option value="">Pilih Status Perkawinan</option>
                                <option value="Belum Menikah" {{ old('status_perkawinan') == 'Belum Menikah' ? 'selected' : '' }}>
                                    Belum Menikah
                                </option>
                                <option value="Kawin" {{ old('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>
                                    Menikah
                                </option>
                                <option value="Cerai Hidup" {{ old('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>
                                    Cerai Hidup
                                </option>
                                <option value="Cerai Mati" {{ old('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>
                                    Cerai Mati
                                </option>
                            </select>

                            <!-- Icon panah dropdown -->
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                        d="M19 9l-7 7-7-7"/>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Pekerjaan -->
                    <div>
                        <label for="pekerjaan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Pekerjaan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <input type="text" name="pekerjaan" id="pekerjaan" value="{{ old('pekerjaan') }}" required class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none" placeholder="Pekerjaan">
                        </div>
                    </div>

                    <!-- Kewarganegaraan -->
                    <div>
                        <label for="kewarganegaraan" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kewarganegaraan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/>
                                </svg>
                            </div>
                            <input type="text" name="kewarganegaraan" id="kewarganegaraan" value="{{ old('kewarganegaraan') }}" required class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none" placeholder="Indonesia">
                        </div>
                    </div>

                    <!-- Nama Ayah -->
                    <div>
                        <label for="nama_ayah" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Ayah <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input type="text" name="nama_ayah" id="nama_ayah" value="{{ old('nama_ayah') }}" required class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none" placeholder="Nama ayah">
                        </div>
                    </div>

                    <!-- Nama Ibu -->
                    <div>
                        <label for="nama_ibu" class="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Ibu <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <input type="text" name="nama_ibu" id="nama_ibu" value="{{ old('nama_ibu') }}" required class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none" placeholder="Nama ibu">
                        </div>
                    </div>

                </div>
            </div>

            <!-- Catatan Section -->
            <div>
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b-2 border-emerald-500">Catatan Tambahan</h3>
                
                <div id="catatan-wrapper" class="space-y-3">
                    <div class="flex gap-2 catatan-group">
                        <input type="text" name="catatan_multi[]" value="{{ old('catatan_multi.0') }}" class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none" placeholder="Tulis catatan...">
                        <button type="button" class="px-4 py-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transition btn-remove-catatan">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>

                <button type="button" id="add-catatan" class="mt-3 inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Catatan
                </button>

                @error('catatan_multi')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
                @error('catatan_multi.*')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <!-- Action Buttons -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-2xl flex flex-col sm:flex-row gap-3 justify-end">
            <a href="{{ route('surat-pengajuan') }}" class="px-6 py-3 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-300 transition text-center">
                Kembali
            </a>
            <button type="reset" class="px-6 py-3 bg-amber-100 text-amber-700 rounded-xl font-semibold hover:bg-amber-200 transition">
                Reset Form
            </button>
            <button type="submit" class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl font-semibold hover:shadow-lg transition transform hover:scale-105">
                Ajukan Surat
            </button>
        </div>
    </form>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set tanggal pengajuan
    // Set tanggal hari ini untuk tanggal pengajuan (menggunakan waktu lokal)
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0'); // bulan 0-11
    const dd = String(today.getDate()).padStart(2, '0');

    document.getElementById('tanggal_pengajuan').value = `${yyyy}-${mm}-${dd}`;

    // Resident auto-fill
    const residentSelect = document.getElementById('resident');
    residentSelect.addEventListener('change', function() {
        const residentId = this.value;

        if (!residentId) {
            document.querySelectorAll(
                '#nik, #nama_lengkap, #tempat_lahir, #tanggal_lahir, #jenis_kelamin, #alamat, #agama, #status_perkawinan, #pekerjaan, #kewarganegaraan, #nama_ayah, #nama_ibu'
            ).forEach(input => input.value = '');
            return;
        }

        fetch(`/get-resident-data/${residentId}`)
            .then(response => response.json())
            .then(data => {
                // Input teks biasa
                const fields = ['nik', 'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'pekerjaan', 'kewarganegaraan', 'nama_ayah', 'nama_ibu'];
                fields.forEach(field => {
                    const el = document.getElementById(field);
                    if (el) el.value = data[field] || '';
                });

                // Fungsi set select
                const setSelect = (id, value) => {
                    const el = document.getElementById(id);
                    if (el) {
                        let found = false;
                        for (let i = 0; i < el.options.length; i++) {
                            if (el.options[i].value.trim().toLowerCase() === value.trim().toLowerCase()) {
                                el.selectedIndex = i;
                                found = true;
                                break;
                            }
                        }
                        if (!found) el.selectedIndex = 0; // default ke option pertama
                    }
                };

                // Set select option
                if (data.jenis_kelamin) setSelect('jenis_kelamin', data.jenis_kelamin);
                if (data.agama) setSelect('agama', data.agama);
                if (data.status_perkawinan) setSelect('status_perkawinan', data.status_perkawinan);

            })
                .catch(error => console.error('Error fetching resident data:', error));
    });

    // Catatan functionality
    const wrapper = document.getElementById('catatan-wrapper');
    const addBtn = document.getElementById('add-catatan');

    addBtn.addEventListener('click', function() {
        const newField = document.createElement('div');
        newField.classList.add('flex', 'gap-2', 'catatan-group');
        newField.innerHTML = `
            <input type="text" name="catatan_multi[]" class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none" placeholder="Tulis catatan...">
            <button type="button" class="px-4 py-3 bg-red-500 text-white rounded-xl hover:bg-red-600 transition btn-remove-catatan">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        `;
        wrapper.appendChild(newField);
    });

    wrapper.addEventListener('click', function(e) {
        if (e.target.closest('.btn-remove-catatan')) {
            const group = e.target.closest('.catatan-group');
            if (wrapper.children.length > 1) {
                group.remove();
            }
        }
    });
});
</script>
@endpush
@endsection