@extends('layouts.layouts')

@section('page-title', 'Detail Surat')

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
            <h2 class="text-2xl font-bold text-gray-900">Detail Pengajuan Surat</h2>
        </div>
        <p class="text-gray-600 ml-12">Berikut adalah informasi lengkap pengajuan surat Anda</p>
    </div>

    <!-- Status Alert -->
    @if($surat->status == 'selesai')
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-start">
            <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="font-semibold">Surat Telah Selesai</p>
                <p class="text-sm mt-1">Surat Anda telah selesai diproses dan siap untuk dicetak. silahkan datang ke kantor desa untuk mengambil surat</p>
            </div>
        </div>
    @elseif($surat->status == 'ditolak')
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-start">
            <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="font-semibold">Pengajuan Ditolak</p>
                <p class="text-sm mt-1">Mohon periksa catatan untuk informasi lebih lanjut</p>
            </div>
        </div>
    @elseif($surat->status == 'diproses')
        <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-xl flex items-start">
            <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="font-semibold">Sedang Diproses</p>
                <p class="text-sm mt-1">Pengajuan surat Anda sedang dalam proses verifikasi</p>
            </div>
        </div>
    @else
        <div class="bg-purple-50 border border-purple-200 text-purple-700 px-4 py-3 rounded-xl flex items-start">
            <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <div>
                <p class="font-semibold">Menunggu Verifikasi</p>
                <p class="text-sm mt-1">Pengajuan Anda telah diterima dan menunggu verifikasi</p>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <div class="grid lg:grid-cols-3 gap-6">
        
        <!-- Informasi Surat -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Card Informasi Surat -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Informasi Surat</h3>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between py-3 border-b border-gray-100">
                        <span class="text-sm font-medium text-gray-600">Jenis Surat</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $surat->jenisSurat->nama }} ({{ $surat->jenisSurat->kode }})</span>
                    </div>

                    <div class="flex justify-between py-3 border-b border-gray-100">
                        <span class="text-sm font-medium text-gray-600">Nomor Surat</span>
                        <span class="text-sm font-semibold text-gray-900">{{ $surat->nomor_surat }}</span>
                    </div>

                    <div class="flex justify-between py-3 border-b border-gray-100">
                        <span class="text-sm font-medium text-gray-600">Tanggal Pengajuan</span>
                        <span class="text-sm font-semibold text-gray-900">{{ \Carbon\Carbon::parse($surat->tanggal_pengajuan)->locale('id')->translatedFormat('d F Y') }}</span>
                    </div>

                    <div class="flex justify-between py-3 border-b border-gray-100">
                        <span class="text-sm font-medium text-gray-600">Tanggal Disetujui</span>
                        <span class="text-sm font-semibold text-gray-900">
                            {{ $surat->tanggal_disetujui ? \Carbon\Carbon::parse($surat->tanggal_disetujui)->locale('id')->translatedFormat('d F Y') : '-' }}
                        </span>
                    </div>

                    <div class="flex justify-between py-3">
                        <span class="text-sm font-medium text-gray-600">Status</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                            @if($surat->status == 'selesai') bg-green-100 text-green-700
                            @elseif($surat->status == 'diproses') bg-blue-100 text-blue-700
                            @elseif($surat->status == 'ditolak') bg-red-100 text-red-700
                            @else bg-purple-100 text-purple-700
                            @endif">
                            {{ ucfirst($surat->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Card Data Pemohon -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Data Pemohon</h3>
                </div>

                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-1">NIK</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $surat->resident->nik }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-1">Nama Lengkap</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $surat->resident->nama_lengkap }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-1">Tempat Lahir</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $surat->resident->tempat_lahir }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-1">Tanggal Lahir</p>
                        <p class="text-sm font-semibold text-gray-900">{{ \Carbon\Carbon::parse($surat->resident->tanggal_lahir)->locale('id')->translatedFormat('d F Y') }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-1">Jenis Kelamin</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $surat->resident->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-1">Agama</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $surat->resident->agama }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-1">Status Perkawinan</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $surat->resident->status_perkawinan }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-1">Pekerjaan</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $surat->resident->pekerjaan }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-1">Kewarganegaraan</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $surat->resident->kewarganegaraan }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-1">Nama Ayah</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $surat->resident->nama_ayah }}</p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-gray-500 mb-1">Nama Ibu</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $surat->resident->nama_ibu }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-xs font-medium text-gray-500 mb-1">Alamat</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $surat->resident->alamat }}</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            
            <!-- Card Catatan -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <div class="flex items-center space-x-3 mb-4">
                    <div class="w-10 h-10 bg-amber-100 rounded-xl flex items-center justify-center">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Catatan</h3>
                </div>

                @if($surat->catatan)
                    <div class="space-y-2">
                        @foreach (explode("\n", $surat->catatan) as $item)
                            <div class="flex items-start space-x-2">
                                <svg class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-sm text-gray-700">{{ $item }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500 italic">Tidak ada catatan</p>
                @endif
            </div>

            <!-- Card Action Buttons -->
            <div class="bg-white rounded-2xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Aksi</h3>
                
                <div class="space-y-3">
                    @if(auth()->user()->role == 'admin' && $surat->status == 'selesai')
                        @switch($surat->jenisSurat->kode)
                            @case('SKTM')
                                <a href="{{ route('surat-pengajuan.cetaksktm', $surat->id) }}" target="_blank" class="flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl font-semibold hover:shadow-lg transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                    </svg>
                                    Cetak Surat
                                </a>
                                @break

                            @case('SKU')
                                <a href="{{ route('surat-pengajuan.cetaksku', $surat->id) }}" target="_blank" class="flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl font-semibold hover:shadow-lg transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                    </svg>
                                    Cetak Surat
                                </a>
                                @break

                            @case('SKD')
                                <a href="{{ route('surat-pengajuan.cetakdomisili', $surat->id) }}" target="_blank" class="flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl font-semibold hover:shadow-lg transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                    </svg>
                                    Cetak Surat
                                </a>
                                @break

                            @case('SKDL')
                                <a href="{{ route('surat-pengajuan.cetakdomisililembaga', $surat->id) }}" target="_blank" class="flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl font-semibold hover:shadow-lg transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                    </svg>
                                    Cetak Surat
                                </a>
                                @break

                            @default
                                <a href="{{ route('surat-pengajuan.cetakumum', $surat->id) }}" target="_blank" class="flex items-center justify-center px-4 py-3 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-xl font-semibold hover:shadow-lg transition">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                                    </svg>
                                    Cetak Surat
                                </a>
                        @endswitch
                    @endif

                    <a href="{{ route('surat-pengajuan') }}" class="flex items-center justify-center px-4 py-3 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-300 transition">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection