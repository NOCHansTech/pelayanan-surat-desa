<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-emerald-50 via-teal-50 to-cyan-50">
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="max-w-2xl w-full">
            <!-- Card Container -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <!-- Header with Gradient -->
                <div class="bg-gradient-to-r from-emerald-500 to-teal-500 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center">
                                <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-white">E-Surat Desa</h1>
                                <p class="text-emerald-100 text-sm">Sistem Pengelolaan Surat</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="px-8 py-12 text-center">
                    <!-- Error Code -->
                    <div class="mb-8">
                        <h1 class="text-9xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600">
                            404
                        </h1>
                    </div>

                    <!-- Icon -->
                    <div class="mb-6">
                        <svg class="w-32 h-32 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>

                    <!-- Message -->
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">
                        Halaman Tidak Ditemukan
                    </h2>
                    <p class="text-gray-600 text-lg mb-8 max-w-md mx-auto">
                        Maaf, halaman yang Anda cari tidak dapat ditemukan. Halaman mungkin telah dipindahkan atau dihapus.
                    </p>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            Kembali ke Dashboard
                        </a>
                        <button onclick="window.history.back()" class="inline-flex items-center px-8 py-3 bg-gray-200 text-gray-700 font-semibold rounded-xl hover:bg-gray-300 transition-all duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Halaman Sebelumnya
                        </button>
                    </div>

                    <!-- Helpful Links -->
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <p class="text-gray-600 text-sm mb-4">Link yang mungkin membantu:</p>
                        <div class="flex flex-wrap justify-center gap-4">
                            <a href="{{ route('surat-pengajuan') }}" class="text-emerald-600 hover:text-emerald-700 font-medium text-sm transition">
                                Surat Pengajuan
                            </a>
                            <span class="text-gray-300">•</span>
                            <a href="{{ route('resident.index') }}" class="text-emerald-600 hover:text-emerald-700 font-medium text-sm transition">
                                Data Warga
                            </a>
                            <span class="text-gray-300">•</span>
                            <a href="{{ route('users.profile') }}" class="text-emerald-600 hover:text-emerald-700 font-medium text-sm transition">
                                Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-8 py-4 border-t border-gray-200">
                    <p class="text-center text-sm text-gray-600">
                        &copy; {{ date('Y') }} E-Surat Desa. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>