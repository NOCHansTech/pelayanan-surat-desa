<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="E-Surat Desa Karangmekar - Layanan surat elektronik untuk warga Desa Karangmekar yang praktis, cepat, dan efisien">
    <title>E-Surat Desa Karangmekar - Buat Surat Anda Secara Mudah dan Cepat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-emerald-50 via-white to-blue-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <span class="text-xl font-bold text-gray-800">E-Surat Desa Karangmekar</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#tentang" class="text-gray-600 hover:text-emerald-600 transition">Tentang Kami</a>
                    <a href="#fitur" class="text-gray-600 hover:text-emerald-600 transition">Fitur</a>
                    <a href="#hubungi" class="text-gray-600 hover:text-emerald-600 transition">Hubungi Kami</a>
                </div>

                <div class="flex items-center space-x-3">
                    <a href="{{ route('login') }}" class="px-5 py-2 text-emerald-600 hover:text-emerald-700 font-medium transition">Masuk</a>
                    <a href="{{ route('register') }}" class="px-5 py-2 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-full hover:shadow-lg transition transform hover:scale-105">Daftar</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="container mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <div class="inline-block px-4 py-2 bg-emerald-100 text-emerald-700 rounded-full text-sm font-medium">
                    Layanan Digital Desa Karangmekar
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                    Buat Surat Anda Secara <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 to-emerald-600">Mudah dan Cepat!</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-600 leading-relaxed">
                    Layanan surat elektronik untuk warga Desa Karangmekar, Kecamatan Cimanggu, Kabupaten Sukabumi. Praktis, Cepat, dan Efisien. Tidak perlu antri, buat surat resmi dari rumah Anda.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-full font-semibold hover:shadow-xl transition transform hover:scale-105 text-center">
                        Mulai Sekarang
                    </a>
                    <a href="#fitur" class="px-8 py-4 bg-white text-gray-700 rounded-full font-semibold border-2 border-gray-200 hover:border-emerald-500 hover:text-emerald-600 transition text-center">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
                <div class="flex items-center space-x-2 pt-4">
                    <svg class="w-5 h-5 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-sm text-gray-600 font-medium">Data Anda Aman dan Terenkripsi</span>
                </div>
            </div>
            
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-400 to-blue-400 rounded-3xl transform rotate-3 opacity-20"></div>
                <div class="relative bg-white rounded-3xl shadow-2xl p-8">
                    <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=600&h=400&fit=crop" alt="Community" class="rounded-2xl w-full h-64 object-cover mb-6">
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-center p-4 bg-emerald-50 rounded-xl">
                            <svg class="w-8 h-8 text-emerald-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            <p class="text-xs font-medium text-gray-700">Surat Keterangan</p>
                        </div>
                        <div class="text-center p-4 bg-blue-50 rounded-xl">
                            <svg class="w-8 h-8 text-blue-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                            </svg>
                            <p class="text-xs font-medium text-gray-700">Izin Usaha</p>
                        </div>
                        <div class="text-center p-4 bg-purple-50 rounded-xl">
                            <svg class="w-8 h-8 text-purple-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <p class="text-xs font-medium text-gray-700">Akta Kelahiran</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="fitur" class="bg-white py-16 md:py-24">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Fitur Unggulan</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Nikmati kemudahan layanan administrasi desa dengan berbagai fitur yang kami sediakan</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-gradient-to-br from-emerald-50 to-white p-8 rounded-2xl hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="w-14 h-14 bg-emerald-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Proses Cepat</h3>
                    <p class="text-gray-600 leading-relaxed">Buat dan ajukan surat dalam hitungan menit tanpa perlu datang ke kantor desa</p>
                </div>

                <div class="bg-gradient-to-br from-blue-50 to-white p-8 rounded-2xl hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="w-14 h-14 bg-blue-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Keamanan Terjamin</h3>
                    <p class="text-gray-600 leading-relaxed">Data pribadi Anda dilindungi dengan enkripsi tingkat tinggi dan sistem keamanan modern</p>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-white p-8 rounded-2xl hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="w-14 h-14 bg-purple-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Akses Mobile</h3>
                    <p class="text-gray-600 leading-relaxed">Gunakan layanan dari mana saja melalui smartphone, tablet, atau komputer Anda</p>
                </div>

                <div class="bg-gradient-to-br from-orange-50 to-white p-8 rounded-2xl hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="w-14 h-14 bg-orange-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Mudah Digunakan</h3>
                    <p class="text-gray-600 leading-relaxed">Interface yang intuitif dan ramah pengguna untuk semua kalangan usia</p>
                </div>

                <div class="bg-gradient-to-br from-pink-50 to-white p-8 rounded-2xl hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="w-14 h-14 bg-pink-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Notifikasi Real-time</h3>
                    <p class="text-gray-600 leading-relaxed">Dapatkan pemberitahuan langsung tentang status pengajuan surat Anda</p>
                </div>

                <div class="bg-gradient-to-br from-teal-50 to-white p-8 rounded-2xl hover:shadow-xl transition transform hover:-translate-y-2">
                    <div class="w-14 h-14 bg-teal-500 rounded-xl flex items-center justify-center mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Berbagai Jenis Surat</h3>
                    <p class="text-gray-600 leading-relaxed">Pilihan lengkap surat resmi desa yang dapat Anda buat dengan mudah</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="tentang" class="py-16 md:py-24 bg-gradient-to-br from-emerald-50 to-blue-50">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Tentang E-Surat Desa Karangmekar</h2>
                    <p class="text-lg text-gray-600 leading-relaxed mb-6">
                        E-Surat Desa adalah platform digital yang dirancang khusus untuk melayani warga Desa Karangmekar dalam mengurus berbagai keperluan administrasi tanpa harus datang langsung ke kantor desa.
                    </p>
                    <p class="text-lg text-gray-600 leading-relaxed mb-6">
                        Desa Karangmekar yang terletak di Kecamatan Cimanggu, Kabupaten Sukabumi, kini hadir dengan layanan digital yang memudahkan setiap warga untuk mengajukan berbagai jenis surat secara online. Dengan teknologi modern dan antarmuka yang mudah digunakan, kami berkomitmen untuk memberikan pelayanan terbaik kepada seluruh warga desa.
                    </p>
                    <div class="bg-white p-6 rounded-xl shadow-sm mb-6">
                        <h3 class="font-bold text-gray-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Profil Desa
                        </h3>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p><span class="font-medium text-gray-700">Nama Desa:</span> Karangmekar</p>
                            <p><span class="font-medium text-gray-700">Kecamatan:</span> Cimanggu</p>
                            <p><span class="font-medium text-gray-700">Kabupaten:</span> Sukabumi</p>
                            <p><span class="font-medium text-gray-700">Provinsi:</span> Jawa Barat</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-xl shadow-sm">
                            <div class="text-3xl font-bold text-emerald-600 mb-2">24/7</div>
                            <div class="text-gray-600">Layanan Aktif</div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm">
                            <div class="text-3xl font-bold text-blue-600 mb-2">100%</div>
                            <div class="text-gray-600">Aman & Terpercaya</div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=600&h=500&fit=crop" alt="About" class="rounded-2xl shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 md:py-24 bg-gradient-to-r from-emerald-500 to-emerald-600">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Siap Memulai?</h2>
            <p class="text-xl text-emerald-100 mb-8 max-w-2xl mx-auto">Bergabunglah dengan warga Desa Karangmekar lainnya yang telah merasakan kemudahan layanan E-Surat Desa</p>
            <a href="{{ route('register') }}" class="inline-block px-10 py-4 bg-white text-emerald-600 rounded-full font-bold text-lg hover:shadow-2xl transition transform hover:scale-105">
                Daftar Sekarang Gratis
            </a>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="hubungi" class="py-16 md:py-24 bg-white">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Hubungi Kami</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Ada pertanyaan? Tim kami siap membantu Anda</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Email</h3>
                    <p class="text-gray-600">info@e-surat.labhans.com</p>
                </div>

                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Telepon</h3>
                    <p class="text-gray-600">0858-8709-0989</p>
                </div>

                <div class="text-center p-6">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-2">Alamat</h3>
                    <p class="text-gray-600">Kantor Desa Karangmekar<br>Kec. Cimanggu, Kab. Sukabumi</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-300 py-12">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid md:grid-cols-4 gap-8 mb-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white">E-Surat Desa</span>
                    </div>
                    <p class="text-sm leading-relaxed mb-3">Solusi digital untuk administrasi Desa Karangmekar yang lebih mudah, cepat, dan efisien.</p>
                    <div class="text-xs text-gray-400">
                        <p>Desa Karangmekar</p>
                        <p>Kec. Cimanggu</p>
                        <p>Kab. Sukabumi, Jawa Barat</p>
                    </div>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4">Tautan Cepat</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#tentang" class="hover:text-emerald-400 transition">Tentang Kami</a></li>
                        <li><a href="#fitur" class="hover:text-emerald-400 transition">Fitur</a></li>
                        <li><a href="#hubungi" class="hover:text-emerald-400 transition">Hubungi Kami</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4">Layanan</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-emerald-400 transition">Surat Keterangan</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition">Izin Usaha</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition">Akta Kelahiran</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-white font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-emerald-400 transition">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition">Keamanan Data</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-sm">&copy; 2024 E-Surat Desa Karangmekar. Hak Cipta Dilindungi.</p>
                <div class="flex space-x-6 mt-4 md:mt-0">
                    <a href="#" class="hover:text-emerald-400 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="#" class="hover:text-emerald-400 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                        </svg>
                    </a>
                    <a href="#" class="hover:text-emerald-400 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0C8.74 0 8.333.015 7.053.072 5.775.132 4.905.333 4.14.63c-.789.306-1.459.717-2.126 1.384S.935 3.35.63 4.14C.333 4.905.131 5.775.072 7.053.012 8.333 0 8.74 0 12s.015 3.667.072 4.947c.06 1.277.261 2.148.558 2.913.306.788.717 1.459 1.384 2.126.667.666 1.336 1.079 2.126 1.384.766.296 1.636.499 2.913.558C8.333 23.988 8.74 24 12 24s3.667-.015 4.947-.072c1.277-.06 2.148-.262 2.913-.558.788-.306 1.459-.718 2.126-1.384.666-.667 1.079-1.335 1.384-2.126.296-.765.499-1.636.558-2.913.06-1.28.072-1.687.072-4.947s-.015-3.667-.072-4.947c-.06-1.277-.262-2.149-.558-2.913-.306-.789-.718-1.459-1.384-2.126C21.319 1.347 20.651.935 19.86.63c-.765-.297-1.636-.499-2.913-.558C15.667.012 15.26 0 12 0zm0 2.16c3.203 0 3.585.016 4.85.071 1.17.055 1.805.249 2.227.415.562.217.96.477 1.382.896.419.42.679.819.896 1.381.164.422.36 1.057.413 2.227.057 1.266.07 1.646.07 4.85s-.015 3.585-.074 4.85c-.061 1.17-.256 1.805-.421 2.227-.224.562-.479.96-.899 1.382-.419.419-.824.679-1.38.896-.42.164-1.065.36-2.235.413-1.274.057-1.649.07-4.859.07-3.211 0-3.586-.015-4.859-.074-1.171-.061-1.816-.256-2.236-.421-.569-.224-.96-.479-1.379-.899-.421-.419-.69-.824-.9-1.38-.165-.42-.359-1.065-.42-2.235-.045-1.26-.061-1.649-.061-4.844 0-3.196.016-3.586.061-4.861.061-1.17.255-1.814.42-2.234.21-.57.479-.96.9-1.381.419-.419.81-.689 1.379-.898.42-.166 1.051-.361 2.221-.421 1.275-.045 1.65-.06 4.859-.06l.045.03zm0 3.678c-3.405 0-6.162 2.76-6.162 6.162 0 3.405 2.76 6.162 6.162 6.162 3.405 0 6.162-2.76 6.162-6.162 0-3.405-2.76-6.162-6.162-6.162zM12 16c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zm7.846-10.405c0 .795-.646 1.44-1.44 1.44-.795 0-1.44-.646-1.44-1.44 0-.794.646-1.439 1.44-1.439.793-.001 1.44.645 1.44 1.439z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>