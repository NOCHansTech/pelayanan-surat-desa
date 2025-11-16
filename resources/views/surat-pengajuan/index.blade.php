@extends('layouts.layouts')

@section('page-title', 'Surat Pengajuan')

@section('content')
<div class="space-y-6">
    
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Surat Pengajuan</h2>
            <p class="text-gray-600 mt-1">Kelola dan pantau semua pengajuan surat</p>
        </div>
        @if (Auth::check() && (Auth::user()->role == 'warga' || Auth::user()->role == 'admin'))
            <a href="{{ route('surat-pengajuan.create') }}" class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl font-semibold hover:shadow-lg transition transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Ajukan Surat
            </a>
        @endif
    </div>

    <!-- Alert Messages -->
    @if (Session::get('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-start">
            <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
            </svg>
            <span>{{ Session::get('success') }}</span>
        </div>
    @endif

    @if (Session::get('warning'))
        <div class="bg-amber-50 border border-amber-200 text-amber-700 px-4 py-3 rounded-xl flex items-start">
            <svg class="w-5 h-5 mr-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <span>{{ Session::get('warning') }}</span>
        </div>
    @endif

    <!-- Filter Section -->
    <div class="bg-white rounded-2xl shadow-md p-6">
        <form method="GET" action="{{ route('surat-pengajuan') }}" class="grid grid-cols-1 md:grid-cols-12 gap-4">
            <div class="md:col-span-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Cari Surat</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Jenis/No Surat..." class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none">
                </div>
            </div>

            <div class="md:col-span-3">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none appearance-none bg-white">
                    <option value="">Semua Status</option>
                    @foreach (['diajukan', 'diproses', 'ditolak', 'selesai'] as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="md:col-span-5 flex items-end gap-3">
                <button type="submit" class="flex-1 px-5 py-2.5 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition">
                    Filter
                </button>
                <a href="{{ route('surat-pengajuan') }}" class="flex-1 px-5 py-2.5 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-300 transition text-center">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Jenis Surat</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No Surat</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tgl Pengajuan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Tgl Disetujui</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Catatan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($data as $i => $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $data->firstItem() + $i }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item->jenisSurat->nama ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item->nomor_surat }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item->resident->nama_lengkap }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item->tanggal_pengajuan }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item->tanggal_disetujui ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    @if($item->status == 'selesai') bg-green-100 text-green-700
                                    @elseif($item->status == 'diproses') bg-blue-100 text-blue-700
                                    @elseif($item->status == 'ditolak') bg-red-100 text-red-700
                                    @else bg-purple-100 text-purple-700
                                    @endif">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{ $item->catatan ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('surat-pengajuan.detail', $item->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>

                                    @if (Auth::check() && Auth::user()->role == 'admin')
                                        @php
                                            $canEdit = $item->status !== 'selesai' && $item->status !== 'ditolak';
                                            $canDelete = $item->status !== 'ditolak' && $item->status !== 'selesai';
                                        @endphp

                                        @if ($canEdit)
                                            <button type="button" data-modal-target="editModal{{ $item->id }}" onclick="openModal('editModal{{ $item->id }}')" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition" title="Edit Status">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                            </button>
                                        @endif

                                        @if ($canDelete)
                                            <form action="{{ route('surat-pengajuan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat ini?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center">
                                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <p class="text-gray-500 text-lg font-medium">Tidak ada data ditemukan</p>
                                <p class="text-gray-400 text-sm mt-1">Silakan ajukan surat untuk melihat data</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($data->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <!-- Info -->
                    <div class="text-sm text-gray-600">
                        Menampilkan <span class="font-semibold text-gray-900">{{ $data->firstItem() }}</span> 
                        sampai <span class="font-semibold text-gray-900">{{ $data->lastItem() }}</span> 
                        dari <span class="font-semibold text-gray-900">{{ $data->total() }}</span> data
                    </div>

                    <!-- Pagination Links -->
                    <nav class="flex items-center space-x-2">
                        {{-- Previous Button --}}
                        @if ($data->onFirstPage())
                            <span class="px-3 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </span>
                        @else
                            <a href="{{ $data->appends(['search' => request('search'), 'status' => request('status')])->previousPageUrl() }}" 
                               class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-emerald-50 hover:border-emerald-500 transition-colors duration-150">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                </svg>
                            </a>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($data->appends(['search' => request('search'), 'status' => request('status')])->getUrlRange(1, $data->lastPage()) as $page => $url)
                            @if ($page == $data->currentPage())
                                <span class="px-4 py-2 bg-emerald-600 text-white font-semibold rounded-lg shadow">
                                    {{ $page }}
                                </span>
                            @else
                                <a href="{{ $url }}" 
                                   class="px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-emerald-50 hover:border-emerald-500 transition-colors duration-150">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach

                        {{-- Next Button --}}
                        @if ($data->hasMorePages())
                            <a href="{{ $data->appends(['search' => request('search'), 'status' => request('status')])->nextPageUrl() }}" 
                               class="px-3 py-2 bg-white border border-gray-300 text-gray-700 rounded-lg hover:bg-emerald-50 hover:border-emerald-500 transition-colors duration-150">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </a>
                        @else
                            <span class="px-3 py-2 bg-gray-100 text-gray-400 rounded-lg cursor-not-allowed">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </span>
                        @endif
                    </nav>
                </div>
            </div>
        @endif
    </div>
</div>

<!-- Edit Modal -->
@foreach ($data as $item)
    <div id="editModal{{ $item->id }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 bg-black bg-opacity-50 transition-opacity" onclick="closeModal('editModal{{ $item->id }}')"></div>
            
            <div class="relative bg-white rounded-2xl shadow-xl max-w-md w-full p-6">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Edit Status Surat</h3>
                    <button onclick="closeModal('editModal{{ $item->id }}')" class="text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('surat-pengajuan.update_status', $item->id) }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Surat</label>
                        <input type="text" 
                            id="nomor_surat_{{ $item->id }}" 
                            value="{{ isset($nomorSurat) ? $nomorSurat : $item->nomor_surat }}" 
                            readonly
                            class="w-full px-4 py-2.5 border border-gray-300 rounded-xl bg-gray-50 text-gray-600 outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Status Persetujuan</label>
                        <select name="status" required class="w-full px-4 py-2.5 border border-gray-300 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition outline-none appearance-none bg-white">
                            <option value="">-- Pilih Status --</option>
                            <option value="diajukan" {{ $item->status == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                            <option value="diproses" {{ $item->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                            <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>

                    <div class="flex gap-3 pt-4">
                        <button type="button" onclick="closeModal('editModal{{ $item->id }}')" class="flex-1 px-5 py-2.5 bg-gray-200 text-gray-700 rounded-xl font-semibold hover:bg-gray-300 transition">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 px-5 py-2.5 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl font-semibold hover:shadow-lg transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

@push('scripts')
<script>
function openModal(modalId) {
    document.getElementById(modalId).classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        const modals = document.querySelectorAll('[id^="editModal"]');
        modals.forEach(modal => {
            modal.classList.add('hidden');
        });
        document.body.style.overflow = 'auto';
    }
});

// Auto-reload every 60 seconds
setTimeout(function() {
    location.reload();
}, 60000);
</script>
@endpush
@endsection