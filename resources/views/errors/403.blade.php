<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-red-50 via-orange-50 to-amber-50">
    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="max-w-2xl w-full">
            <!-- Card Container -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <!-- Header with Gradient -->
                <div class="bg-gradient-to-r from-red-500 to-orange-500 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center">
                                <svg class="w-7 h-7 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-white">E-Surat Desa</h1>
                                <p class="text-red-100 text-sm">Sistem Pengelolaan Surat</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="px-8 py-12 text-center">
                    <!-- Error Code -->
                    <div class="mb-8">
                        <h1 class="text-9xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-red-600 to-orange-600">
                            403
                        </h1>
                    </div>

                    <!-- Icon -->
                    <div class="mb-6">
                        <svg class="w-32 h-32 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>

                    <!-- Message -->
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">
                        Akses Ditolak
                    </h2>
                    <p class="text-gray-600 text-lg mb-8 max-w-md mx-auto">
                        Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. Silakan hubungi administrator jika Anda merasa ini adalah kesalahan.
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

                    <!-- Info Box -->
                    <div class="mt-12 bg-amber-50 border border-amber-200 rounded-xl p-6">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-amber-600 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                            </svg>
                            <div class="text-left">
                                <h4 class="font-semibold text-amber-900 mb-1">Informasi</h4>
                                <p class="text-amber-700 text-sm">
                                    Jika Anda merasa membutuhkan akses ke halaman ini, silakan hubungi administrator sistem untuk mendapatkan izin yang sesuai.
                                </p>
                            </div>
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