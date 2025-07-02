@extends('layouts.layouts')
@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading">
        <h3>Jenis Surat</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col mb-3">
                <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal"
                    data-bs-target="#modalJenisSurat">
                    Tambah Data
                </button>
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
                    Jenis Surat
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
                                        <th>Kode Surat</th>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration + ($data->currentPage() - 1) * $data->perPage() }}</td>
                                            <td>{{ $item->kode }}</td>
                                            <td>{{ $item->nama }}</td>
                                            <td>{{ $item->deskripsi }}</td>
                                            <td>
                                                <!-- Tombol Edit -->
                                                <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#editModal{{ $item->id }}">
                                                    Edit
                                                </button>

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('jenis-surat.delete', $item->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                                    @csrf

                                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
    </div>

    {{-- Modal Tambah Data Start --}}
    <div class="modal fade text-left" id="modalJenisSurat" tabindex="-1" aria-labelledby="labelModalJenisSurat"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="labelModalJenisSurat">Tambah Jenis Surat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">


                    <form id="formJenisSurat" action="{{ route('jenis-surat.store') }}" method="POST">

                        @csrf
                        <div class="form-group">
                            <label for="kode">Kode Surat</label>
                            <input type="text" name="kode" id="kode" class="form-control" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="nama">Nama Surat</label>
                            <input type="text" name="nama" id="nama" class="form-control" required>
                        </div>
                        <div class="form-group mt-2">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="form-control"></textarea>
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
    {{-- Modal Tambah Data End --}}

    {{-- modal edit data Start --}}
    @foreach ($data as $item)
        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('jenis-surat.update', $item->id) }}" method="POST">
                    @csrf

                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Jenis Surat</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label for="kode">Kode Surat</label>
                                <input type="text" name="kode" class="form-control" value="{{ $item->kode }}"
                                    required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="nama">Nama Surat</label>
                                <input type="text" name="nama" class="form-control" value="{{ $item->nama }}"
                                    required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="deskripsi">Deskripsi</label>
                                <textarea name="deskripsi" class="form-control">{{ $item->deskripsi }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
    {{-- modal edit data end --}}
@endsection
<script></script>
