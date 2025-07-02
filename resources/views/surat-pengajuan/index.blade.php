@extends('layouts.layouts')
@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading">
        <h3>Surat Pengajuan</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col mb-3">
                @if (Auth::check() && Auth::user()->role == 'warga' || Auth::user()->role == 'admin')
                    <a href="{{ route('surat-pengajuan.create') }}" class="btn btn-outline-primary">
                        Ajukan Surat
                    </a>
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
                    Surat Pengajuan
                </div>
                <div class="card-body">
                    <div class="dataTable-wrapper dataTable-loading no-footer sortable searchable fixed-columns">
                        <div class="dataTable-top">
                            <form method="GET" action="{{ route('surat-pengajuan') }}" class="row g-3 mb-3">
                                <div class="col-md-3">
                                    <input class="form-control" type="text" name="search"
                                        placeholder="Cari Jenis/No Surat..." value="{{ request('search') }}">
                                </div>
                                <div class="col-md-2">
                                    <select name="status" class="form-select">
                                        <option value="">Semua Status</option>
                                        @foreach (['diajukan', 'diproses', 'ditolak', 'selesai'] as $status)
                                            <option value="{{ $status }}"
                                                {{ request('status') == $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-md-3 d-flex justify-content-start">
                                    <button class="btn btn-primary me-2" type="submit">Filter</button>
                                    <a href="{{ route('surat-pengajuan') }}" class="btn btn-secondary">Reset</a>
                                </div>
                            </form>


                        </div>
                        <div class="dataTable-container">
                            <table class="table table-striped dataTable-table" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Jenis Surat</th>
                                        <th>No Surat</th>
                                        <th>Nama</th>
                                        <th>Tgl Pengajuan</th>
                                        <th>Tgl Disetujui</th>
                                        <th>Status</th>
                                        <th>Catatan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $i => $item)
                                        <tr>
                                            <td>{{ $data->firstItem() + $i }}</td>
                                            <td>{{ $item->jenisSurat->nama ?? '-' }}</td>
                                            <td>{{ $item->nomor_surat }}</td>
                                            <td>{{ $item->resident->nama_lengkap}}</td>
                                            <td>{{ $item->tanggal_pengajuan }}</td>
                                            <td>{{ $item->tanggal_disetujui ?? '-' }}</td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $item->status == 'selesai' ? 'success' : ($item->status == 'diproses' ? 'warning' : ($item->status == 'ditolak' ? 'danger' : 'secondary')) }}">
                                                    {{ ucfirst($item->status) }}
                                                </span>
                                            </td>
                                            <td>{{ $item->catatan ?? '-' }}</td>
                                            <td>
                                                <div class="d-flex gap-1">
                                                    <div class="flex-fill">
                                                        <a href="{{ route('surat-pengajuan.detail', $item->id) }}"
                                                            class="btn btn-sm btn-primary w-100 d-flex justify-content-center align-items-center">
                                                            <i class="bi bi-eye fs-6"></i>
                                                        </a>
                                                    </div>
                                                    @if (Auth::check() && Auth::user()->role == 'admin')
                                                        @php
                                                            $canEdit = $item->status !== 'selesai' && $item->status !== 'ditolak';
                                                            $canDelete = $item->status == 'ditolak' || $item->status !== 'selesai';
                                                        @endphp

                                                        @if ($canEdit)
                                                            <div class="flex-fill">
                                                                <button type="button"
                                                                        class="btn btn-sm btn-warning w-100 d-flex justify-content-center align-items-center"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#editModal{{ $item->id }}">
                                                                    <i class="bi bi-gear fs-6"></i>
                                                                </button>
                                                            </div>
                                                        @endif

                                                        @if ($canDelete)
                                                            <div class="flex-fill">
                                                                <form action="{{ route('surat-pengajuan.destroy', $item->id) }}" method="POST"
                                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus surat ini?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                            class="btn btn-sm btn-danger w-100 d-flex justify-content-center align-items-center">
                                                                        <i class="bi bi-trash fs-6"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada data ditemukan</td>
                                        </tr>
                                    @endforelse
                                </tbody>


                            </table>
                        </div>
                        <div class="dataTable-bottom d-flex justify-content-between align-items-center">

                                @if ($data->isEmpty())
                                @else
                                    <div class="dataTable-pagination">
                                        {{ $data->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
                                    </div>
                                @endif
                        </div>


                    </div>
                </div>
            </div>
        </section>
    </div>
    {{-- modal edit pengajuan --}}
@foreach ($data as $item)
    <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <form action="{{ route('surat-pengajuan.update_status', $item->id) }}" method="POST">
                @csrf

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Status Surat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="nomor_surat">Nomor Surat</label>
                            <input type="text" class="form-control" id="nomor_surat_{{ $item->id }}" 
                                value="{{ (isset($nomorSurat) ? $nomorSurat : $item->nomor_surat) }}">
                        </div>

                        <div class="form-group mb-2">
                            <label for="status">Status Persetujuan</label>
                            <select class="form-select" name="status" id="status">
                                <option value="">-- Pilih Status --</option>
                                <option value="diajukan" {{ $item->status == 'diajukan' ? 'selected' : '' }}>Diajukan</option>
                                <option value="diproses" {{ $item->status == 'diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                <option value="selesai" {{ $item->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endforeach

    {{-- modal edit pengajuan --}}
@endsection
<script>
    setTimeout(function() {
        location.reload();
    }, 60000); // Reload setiap 10 detik
</script>


