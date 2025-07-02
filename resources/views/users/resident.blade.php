@extends('layouts.layouts')

@section('content')
    @if (!Auth::check() || Auth::user()->role !== 'admin')
            <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="d-flex justify-content-center align-items-center mt-2" style="height: 100vh;">
            <div class="card" style="width: 30rem; height: auto;">
                <img src="{{ asset('/assets/images/samples/error-403.png') }}" class="card-img-top mt-4" alt="Access Denied" style="height: 300px; object-fit: cover;">
                <div class="card-body text-center">
                    <h5 class="card-title text-danger" style="font-size: 2rem;">Akses Ditolak!</h5>
                    <p class="card-text" style="font-size: 1.2rem; color: #721c24;">Anda tidak memiliki hak akses untuk melihat halaman ini. Hanya admin yang bisa mengaksesnya.</p>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-danger" style="font-size: 1.1rem;">Kembali ke Beranda</a>
                </div>
            </div>
        </div>

    @else
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <h3>Data Admin</h3>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col mb-3">
                    <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
                        data-bs-target="#modalTambahWarga">
                        Tambah Data
                    </button>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    @if (Session::get('warning'))
                        <div class="alert alert-warning">
                            {{ Session::get('warning') }}
                        </div>
                    @endif
                </div>

                <div class="card">
                    <div class="card-header">
                        Data Warga
                    </div>

                    <div class="card-body">
                        <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                            <div class="dataTable-top">

                                <form method="GET" action="{{ route('users.resident') }}">
                                    <div class="dataTable-search">
                                        <input class="dataTable-input" type="text" name="search" placeholder="Search..."
                                            value="{{ request('search') }}">
                                    </div>
                                </form>

                            </div>
                            <div class="dataTable-container">
                                <table class="table table-striped dataTable-table" id="table1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>NIK</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
                                                <td>{{ $item->nama_lengkap }}</td>
                                                <td>{{ $item->nik }}</td>
                                                <td>
                                                    <!-- Tombol Edit -->
                                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $item->id }}">
                                                        Edit
                                                    </button>

                                                    <form action="{{ route('users.destroy', $item->id) }}" method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus user ini?');" style="display: inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">
                                                            Hapus
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Data tidak ditemukan</td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>
                            <div class="dataTable-bottom d-flex justify-content-between align-items-center">

                                <div class="dataTable-pagination">
                                    {{-- {{ $data->appends(['search' => request('search')])->links('pagination::bootstrap-5') }} --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endif
@endsection
