@extends('layouts.layouts')
@section('content')
    <!-- Page Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Data Jenis Surat</h1>
        <p class="text-gray-600 text-sm mt-1">Kelola jenis-jenis surat yang tersedia di sistem</p>
    </div>

    <!-- Alert Messages -->
    @if (Session::get('success'))
        <div class="mb-4 bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-md">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-emerald-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-emerald-700 font-medium">{{ Session::get('success') }}</p>
            </div>
        </div>
    @endif

    @if (Session::get('warning'))
        <div class="mb-4 bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r-md">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-amber-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <p class="text-amber-700 font-medium">{{ Session::get('warning') }}</p>
            </div>
        </div>
    @endif

    <!-- Main Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Card Header -->
        <div class="px-6 py-4 bg-gradient-to-r from-emerald-50 to-teal-50 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">Daftar Jenis Surat</h2>
                    <p class="text-sm text-gray-600 mt-0.5">Manage dan atur semua jenis surat</p>
                </div>
                <button type="button" onclick="openModal('modalJenisSurat')" class="inline-flex items-center justify-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Tambah Jenis Surat
                </button>
            </div>
        </div>

        <!-- Card Body -->
        <div class="p-6">
            <!-- Search Bar -->
            <div class="mb-5">
                <form method="GET" action="{{ route('jenis-surat') }}" class="flex items-center max-w-md">
                    <div class="relative flex-1">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari berdasarkan kode atau nama surat..." class="block w-full pl-10 pr-3 py-2.5 border border-gray-300 rounded-l-lg text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200">
                    </div>
                    <a href="{{ route('jenis-surat') }}" class="ml-2 px-4 py-2 bg-gray-200 text-gray-700 rounded-r-lg hover:bg-gray-300 transition">Reset</a>
                </form>
            </div>
            <!-- Table Container -->
            <div class="overflow-hidden border border-gray-200 rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">No</th>
                                <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Kode Surat</th>
                                <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nama Surat</th>
                                <th scope="col" class="px-6 py-3.5 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Deskripsi</th>
                                <th scope="col" class="px-6 py-3.5 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($data as $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                        {{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-emerald-100 text-emerald-800">
                                            {{ $item->kode }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $item->nama }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 max-w-xs truncate">
                                        {{ $item->deskripsi ?? '-' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <button type="button" onclick="openModal('editModal{{ $item->id }}')" class="inline-flex items-center px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white text-xs font-medium rounded-md transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-1">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                                Edit
                                            </button>
                                            <!-- Tombol Hapus -->
                                            <button type="button" 
                                                    onclick="openDeleteModal({{ $item->id }}, '{{ $item->nama ?? 'data ini' }}')" 
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-xs font-medium rounded-md transition-colors duration-150 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-1">
                                                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                                Hapus
                                            </button>

                                            <!-- Form Hapus (Hidden) -->
                                            <form id="deleteForm-{{ $item->id }}" 
                                                action="{{ route('jenis-surat.delete', $item->id) }}" 
                                                method="POST" 
                                                class="hidden">
                                                @csrf
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="w-16 h-16 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <p class="text-gray-500 font-medium">Tidak ada data ditemukan</p>
                                            <p class="text-gray-400 text-sm mt-1">Silakan tambah jenis surat baru atau ubah pencarian</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-5">
                {{ $data->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data -->
    <div id="modalJenisSurat" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 backdrop-blur-sm">
        <div class="relative top-20 mx-auto p-0 border-0 w-full max-w-lg">
            <div class="relative bg-white rounded-xl shadow-2xl">
                <!-- Modal Header -->
                <div class="flex items-center justify-between px-6 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-t-xl">
                    <h3 class="text-lg font-semibold text-white">Tambah Jenis Surat</h3>
                    <button type="button" onclick="closeModal('modalJenisSurat')" class="text-white hover:text-gray-200 transition-colors duration-150">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
                
                <!-- Modal Body -->
                <div class="p-6">
                    <form action="{{ route('jenis-surat.store') }}" method="POST">
                        @csrf
                        <div class="space-y-4">
                            <div>
                                <label for="kode" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Kode Surat <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="kode" id="kode" required class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200" placeholder="Contoh: SK-001">
                            </div>
                            <div>
                                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Nama Surat <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="nama" id="nama" required class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200" placeholder="Contoh: Surat Keterangan">
                            </div>
                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Deskripsi
                                </label>
                                <textarea name="deskripsi" id="deskripsi" rows="3" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-200 resize-none" placeholder="Tambahkan deskripsi singkat..."></textarea>
                            </div>
                        </div>
                        <div class="mt-6 flex items-center justify-end gap-3">
                            <button type="button" onclick="closeModal('modalJenisSurat')" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-150">
                                Batal
                            </button>
                            <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors duration-150 shadow-sm hover:shadow-md">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Data -->
    @foreach ($data as $item)
        <div id="editModal{{ $item->id }}" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50 backdrop-blur-sm">
            <div class="relative top-20 mx-auto p-0 border-0 w-full max-w-lg">
                <div class="relative bg-white rounded-xl shadow-2xl">
                    <!-- Modal Header -->
                    <div class="flex items-center justify-between px-6 py-4 bg-gradient-to-r from-amber-500 to-orange-500 rounded-t-xl">
                        <h3 class="text-lg font-semibold text-white">Edit Jenis Surat</h3>
                        <button type="button" onclick="closeModal('editModal{{ $item->id }}')" class="text-white hover:text-gray-200 transition-colors duration-150">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="p-6">
                        <form action="{{ route('jenis-surat.update', $item->id) }}" method="POST">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label for="kode" class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Kode Surat <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="kode" value="{{ $item->kode }}" required class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200">
                                </div>
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Nama Surat <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nama" value="{{ $item->nama }}" required class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200">
                                </div>
                                <div>
                                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1.5">
                                        Deskripsi
                                    </label>
                                    <textarea name="deskripsi" rows="3" class="block w-full px-4 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-amber-500 focus:border-transparent transition-all duration-200 resize-none">{{ $item->deskripsi }}</textarea>
                                </div>
                            </div>
                            <div class="mt-6 flex items-center justify-end gap-3">
                                <button type="button" onclick="closeModal('editModal{{ $item->id }}')" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-150">
                                    Batal
                                </button>
                                <button type="submit" class="px-5 py-2.5 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg transition-colors duration-150 shadow-sm hover:shadow-md">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Modal Konfirmasi Hapus (Letakkan di akhir file, sebelum </body>) -->
<div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-lg shadow-xl max-w-md w-full transform transition-all">
        <!-- Header -->
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-center">
                <div class="flex-shrink-0 w-12 h-12 rounded-full bg-red-100 flex items-center justify-center">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">Konfirmasi Hapus</h3>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="p-6">
            <p class="text-gray-600">
                Apakah Anda yakin ingin menghapus <span id="deleteName" class="font-semibold text-gray-900"></span>?
            </p>
            <p class="mt-2 text-sm text-gray-500">
                Data yang sudah dihapus tidak dapat dikembalikan.
            </p>
        </div>

        <!-- Footer -->
        <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
            <button type="button" 
                    onclick="closeDeleteModal()" 
                    class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition font-medium">
                Batal
            </button>
            <button type="button" 
                    onclick="confirmDelete()" 
                    class="px-4 py-2 text-white bg-red-600 hover:bg-red-700 rounded-lg transition font-medium">
                Hapus
            </button>
        </div>
    </div>
</div>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('bg-opacity-50')) {
                event.target.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const modals = document.querySelectorAll('.bg-opacity-50');
                modals.forEach(modal => {
                    modal.classList.add('hidden');
                });
                document.body.style.overflow = 'auto';
            }
        });
        let deleteFormId = null;

        function openDeleteModal(id, name) {
            deleteFormId = 'deleteForm-' + id;
            document.getElementById('deleteName').textContent = name;
            document.getElementById('deleteModal').classList.remove('hidden');
            // Prevent body scroll
            document.body.style.overflow = 'hidden';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            deleteFormId = null;
            // Restore body scroll
            document.body.style.overflow = '';
        }

        function confirmDelete() {
            if (deleteFormId) {
                document.getElementById(deleteFormId).submit();
            }
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal')?.addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && !document.getElementById('deleteModal').classList.contains('hidden')) {
                closeDeleteModal();
            }
        });
    </script>
@endsection