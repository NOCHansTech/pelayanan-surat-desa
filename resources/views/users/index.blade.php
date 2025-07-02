@extends('layouts.layouts')
@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    @if (!Auth::check() || Auth::user()->role !== 'admin')
        <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
            <div class="card" style="width: 30rem; height: auto;">
                <img src="{{ asset('/assets/images/samples/error-403.png') }}" class="card-img-top" alt="Access Denied" style="height: 300px; object-fit: cover;">
                <div class="card-body text-center">
                    <h5 class="card-title text-danger" style="font-size: 2rem;">Akses Ditolak!</h5>
                    <p class="card-text" style="font-size: 1.2rem; color: #721c24;">Anda tidak memiliki hak akses untuk melihat halaman ini. Hanya admin yang bisa mengaksesnya.</p>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-danger" style="font-size: 1.1rem;">Kembali ke Beranda</a>
                </div>
            </div>
        </div>

    @else
    <div class="page-heading">
        <h3>Data Admin</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col mb-3">
                <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
                    data-bs-target="#modalJenisSurat">
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
                    Data Users
                </div>
                <div class="card-body">
                    <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                        <div class="dataTable-top">

                            <form method="GET" action="{{ route('jenis-surat') }}">
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
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>{{ $item->role }}</td>

                                            <td>
                                                <!-- Tombol Edit -->
                                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editUserModal{{ $item->id_users }}">
                                                    Edit
                                                </button>

                                                <form action="{{ route('users.destroy', $item->id_users) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus user ini?');"
                                                    style="display: inline-block;">
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
                                            <td colspan="5" class="text-center">Data tidak ditemukan</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                        <div class="dataTable-bottom d-flex justify-content-between align-items-center">

                            <div class="dataTable-pagination">
                                {{ $data->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div> {{-- Modal Tambah Data Start --}}
    <div class="modal fade text-left" id="modalJenisSurat" tabindex="-1" aria-labelledby="labelModalJenisSurat"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelModalJenisSurat">Tambah Users</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <form id="formUsers" action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control" required>
                        </div>

                        <div class="form-group mt-2">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <div class="form-group mt-2">
                            <label for="password_confirmation">Ulangi Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" required>
                        </div>

                        <div class="form-group mt-2">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="" disabled selected>Pilih Role</option>
                                <option value="admin">Admin</option>
                                <option value="warga">Warga</option>
                            </select>
                        </div>

                        <div class="modal-footer mt-4">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Modal Tambah Data End --}}
    @foreach ($data as $user)
        <!-- Modal -->
        <div class="modal fade" id="editUserModal{{ $user->id_users }}" tabindex="-1" aria-labelledby="editUserModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('users.update', $user->id_users) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Username -->
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control"
                                    value="{{ $user->username }}" required>
                            </div>

                            <!-- Optional: Ganti Password -->
                            <div class="form-group mt-2">
                                <label>Password (kosongkan jika tidak diganti)</label>
                                <input type="password" name="password" class="form-control">
                            </div>

                            <!-- Role -->
                            <div class="form-group mt-2">
                                <label>Role</label>
                                <select name="role" class="form-select" required>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="warga" {{ $user->role == 'warga' ? 'selected' : '' }}>Warga</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

@endsection
<script></script>
