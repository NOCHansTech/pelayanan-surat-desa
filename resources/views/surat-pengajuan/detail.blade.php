@extends('layouts.layouts')
@section('content')
    <div class="page-heading">
        <h3>Detail Surat Pengajuan</h3>
    </div>
    <div class="page-content">
        <div class="container">
            <div class="card mt-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Jenis Surat:</strong> {{ $surat->jenisSurat->nama }} ({{ $surat->jenisSurat->kode }})
                            </p>
                            <p><strong>Nomor Surat:</strong> {{ $surat->nomor_surat }}</p>
                            <p><strong>Tanggal Pengajuan:</strong> {{ $surat->tanggal_pengajuan }}</p>
                            <p><strong>Tanggal Disetujui:</strong> {{ $surat->tanggal_disetujui ?? '-' }}</p>
                            <p><strong>Status:</strong> <span
                                    class="badge bg-{{ $surat->status == 'selesai' ? 'success' : ($surat->status == 'diproses' ? 'warning' : ($surat->status == 'ditolak' ? 'danger' : 'secondary')) }}">
                                    {{ ucfirst($surat->status) }}
                                </span></p>
                            <p><strong>Catatan:</strong><br>
                                @foreach (explode("\n", $surat->catatan) as $item)
                                    - {{ $item }} <br>
                                @endforeach
                            </p>

                        </div>
                        <div class="col-md-6">
                            <p><strong>NIK:</strong> {{ $surat->resident->nik }}</p>
                            <p><strong>Nama:</strong> {{ $surat->resident->nama_lengkap }}</p>
                            <p><strong>Tempat, Tgl Lahir:</strong> {{ $surat->resident->tempat_lahir }},
                                {{ $surat->resident->tanggal_lahir }}</p>
                            <p><strong>Jenis Kelamin:</strong>
                                {{ $surat->resident->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                            <p><strong>Alamat:</strong> {{ $surat->resident->alamat }}</p>
                            <p><strong>Agama:</strong> {{ $surat->resident->agama }}</p>
                            <p><strong>Status Kawin:</strong> {{ $surat->resident->status_perkawinan }}</p>
                            <p><strong>Pekerjaan:</strong> {{ $surat->resident->pekerjaan }}</p>
                            <p><strong>Warga Negara:</strong> {{ $surat->resident->kewarganegaraan }}</p>
                            <p><strong>Nama Ayah:</strong> {{ $surat->resident->nama_ayah }}</p>
                            <p><strong>Nama Ibu:</strong> {{ $surat->resident->nama_ibu }}</p>
                            @if ($surat->status == 'selesai')
                                @switch($surat->jenisSurat->kode)
                                    @case('SKTM')
                                        <a href="{{ route('surat-pengajuan.cetaksktm', $surat->id) }}" class="btn btn-danger"
                                            target="_blank">
                                            <i class="bi bi-printer"></i> Cetak Surat
                                        </a>
                                    @break

                                    @case('SKU')
                                        <a href="{{ route('surat-pengajuan.cetaksku', $surat->id) }}" class="btn btn-danger"
                                            target="_blank">
                                            <i class="bi bi-printer"></i> Cetak Surat
                                        </a>
                                    @break

                                    @case('SKD')
                                        <a href="{{ route('surat-pengajuan.cetakdomisili', $surat->id) }}" class="btn btn-danger"
                                            target="_blank">
                                            <i class="bi bi-printer"></i> Cetak Surat
                                        </a>
                                    @break

                                    @case('SKDL')
                                        <a href="{{ route('surat-pengajuan.cetakdomisililembaga', $surat->id) }}"
                                            class="btn btn-danger" target="_blank">
                                            <i class="bi bi-printer"></i> Cetak Surat
                                        </a>
                                    @break

                                    @default
                                        <a href="{{ route('surat-pengajuan.cetakumum', $surat->id) }}" class="btn btn-danger"
                                            target="_blank">
                                            <i class="bi bi-printer"></i> Cetak Surat
                                        </a>
                                @endswitch
                            @endif



                        </div>
                    </div>
                    <a href="{{ route('surat-pengajuan') }}" class="btn btn-secondary mt-3">Kembali</a>
                </div>
            </div>
        </div>
    </div>
@endsection
