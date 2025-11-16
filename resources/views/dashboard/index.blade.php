@extends('layouts.layouts')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-emerald-50 via-white to-blue-50">
    
    <!-- Header -->
    {{-- <div class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-40">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-4">
                    <button class="lg:hidden text-gray-600 hover:text-gray-900" onclick="toggleSidebar()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <h1 class="text-xl font-bold text-gray-900">Dashboard</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <button class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    </button>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-semibold">
                            {{ substr($nama_users, 0, 1) }}
                        </div>
                        <div class="hidden md:block">
                            <p class="text-sm font-semibold text-gray-900">{{ $nama_users }}</p>
                            <p class="text-xs text-gray-500">{{ $role }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Welcome Section -->
        <div class="mb-8">
            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-2xl shadow-lg p-6 md:p-8 text-white">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between">
                    <div class="mb-4 md:mb-0">
                        <h2 class="text-2xl md:text-3xl font-bold mb-2">Selamat Datang, {{ $nama_users }}!</h2>
                        <p class="text-emerald-100">Kelola surat dan administrasi desa Anda dengan mudah</p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('surat-pengajuan.create') }}" class="inline-flex items-center px-5 py-2.5 bg-white text-emerald-600 rounded-xl font-semibold hover:shadow-lg transition transform hover:scale-105">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Buat Surat
                        </a>
                        <a href="{{ route('surat-pengajuan') }}" class="inline-flex items-center px-5 py-2.5 bg-emerald-700 text-white rounded-xl font-semibold hover:bg-emerald-800 transition">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Lihat Riwayat
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            <!-- Surat Diajukan -->
            <a href="{{ route('surat-pengajuan', ['status' => 'diajukan']) }}#search" class="group">
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-purple-600 bg-purple-100 px-3 py-1 rounded-full">Baru</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $pengajuan_diajukan }}</h3>
                    <p class="text-sm text-gray-600">Surat Diajukan</p>
                    <div class="mt-4 flex items-center text-purple-600 text-sm font-medium">
                        Lihat detail
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Surat Diproses -->
            <a href="{{ route('surat-pengajuan', ['status' => 'diproses']) }}#search" class="group">
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-blue-600 bg-blue-100 px-3 py-1 rounded-full">Proses</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $pengajuan_diproses }}</h3>
                    <p class="text-sm text-gray-600">Surat Diproses</p>
                    <div class="mt-4 flex items-center text-blue-600 text-sm font-medium">
                        Lihat detail
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Surat Ditolak -->
            <a href="{{ route('surat-pengajuan', ['status' => 'ditolak']) }}#search" class="group">
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-red-600 bg-red-100 px-3 py-1 rounded-full">Ditolak</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $pengajuan_ditolak }}</h3>
                    <p class="text-sm text-gray-600">Surat Ditolak</p>
                    <div class="mt-4 flex items-center text-red-600 text-sm font-medium">
                        Lihat detail
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

            <!-- Surat Selesai -->
            <a href="{{ route('surat-pengajuan', ['status' => 'selesai']) }}#search" class="group">
                <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition transform hover:-translate-y-1 p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center group-hover:scale-110 transition">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-medium text-green-600 bg-green-100 px-3 py-1 rounded-full">Selesai</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $pengajuan_selesai }}</h3>
                    <p class="text-sm text-gray-600">Surat Selesai</p>
                    <div class="mt-4 flex items-center text-green-600 text-sm font-medium">
                        Lihat detail
                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            </a>

        </div>

        <!-- Quick Actions & Recent Activity -->
        <div class="grid lg:grid-cols-3 gap-6 mb-8">
            
            <!-- Quick Actions -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Aksi Cepat</h3>
                    <div class="space-y-3">
                        <a href="{{ route('surat-pengajuan.create') }}" class="flex items-center p-3 bg-emerald-50 hover:bg-emerald-100 rounded-xl transition group">
                            <div class="w-10 h-10 bg-emerald-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Buat Surat Baru</p>
                                <p class="text-xs text-gray-600">Ajukan permohonan surat</p>
                            </div>
                        </a>

                        <a href="{{ route('surat-pengajuan') }}" class="flex items-center p-3 bg-blue-50 hover:bg-blue-100 rounded-xl transition group">
                            <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Riwayat Surat</p>
                                <p class="text-xs text-gray-600">Lihat semua pengajuan</p>
                            </div>
                        </a>

                        <a href="{{ route('users.profile') }}" class="flex items-center p-3 bg-purple-50 hover:bg-purple-100 rounded-xl transition group">
                            <div class="w-10 h-10 bg-purple-500 rounded-lg flex items-center justify-center mr-3 group-hover:scale-110 transition">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">Profil Saya</p>
                                <p class="text-xs text-gray-600">Kelola data pribadi</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-md p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-gray-900">Aktivitas Terkini</h3>
                        <a href="{{ route('surat-pengajuan') }}" class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                            Lihat Semua
                        </a>
                    </div>
                    <div class="space-y-4">
                        @if($recent_activities->count() > 0)
                            @foreach($recent_activities as $activity)
                                <div class="flex items-start space-x-4 p-3 hover:bg-gray-50 rounded-xl transition">
                                    <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $activity->jenisSurat->nama ?? 'Jenis Surat Tidak Diketahui' }}
                                        </p>
                                        <p class="text-xs text-gray-600 mt-1">{{ \Carbon\Carbon::parse($activity->tanggal_pengajuan)->diffForHumans() }}</p>
                                    </div>
                                    <span class="text-xs font-medium px-3 py-1 rounded-full 
                                        @if($activity->status == 'selesai') bg-green-100 text-green-600
                                        @elseif($activity->status == 'diproses') bg-blue-100 text-blue-600
                                        @elseif($activity->status == 'ditolak') bg-red-100 text-red-600
                                        @else bg-purple-100 text-purple-600
                                        @endif">
                                        {{ ucfirst($activity->status) }}
                                    </span>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-8">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-gray-500 mb-2">Belum ada aktivitas</p>
                                <p class="text-sm text-gray-400">Mulai buat surat untuk melihat aktivitas Anda</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <!-- Information Cards -->
        <div class="grid md:grid-cols-2 gap-6">
            
            <!-- Tips & Info -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-amber-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Tips & Informasi</h3>
                </div>
                <ul class="space-y-3">
                    <li class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-emerald-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm text-gray-600">Pastikan data yang Anda masukkan sesuai dengan KTP</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-emerald-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm text-gray-600">Proses verifikasi surat membutuhkan waktu 1-3 hari kerja</span>
                    </li>
                    <li class="flex items-start space-x-3">
                        <svg class="w-5 h-5 text-emerald-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm text-gray-600">Anda akan mendapat notifikasi jika surat sudah selesai</span>
                    </li>
                </ul>
            </div>

            <!-- Contact Support -->
            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl shadow-md p-6 text-white">
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold">Butuh Bantuan?</h3>
                </div>
                <p class="text-emerald-100 mb-4">Hubungi kantor desa untuk informasi lebih lanjut atau bantuan terkait pengajuan surat</p>
                <div class="space-y-2">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        <span class="text-sm">0800-123-4567</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-sm">info@esuratdesa.id</span>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script>
function toggleSidebar() {
    // Add your sidebar toggle logic here
    const sidebar = document.getElementById('sidebar');
    if (sidebar) {
        sidebar.classList.toggle('hidden');
    }
}
</script>
@endsection