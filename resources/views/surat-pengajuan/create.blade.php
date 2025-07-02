@extends('layouts.layouts')
@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading">
        <h3>Buat Surat Pengajuan</h3>
    </div>
    <div class="page-content">
        <div class="container">
            <div class="card mt-5">
                <div class="card-header">
                    <h4 class="card-title">Surat Pengajuan</h4>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form class="form form-vertical" action="{{ route('surat-pengajuan.store') }}" method="POST">
                        @csrf
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="form-group has-icon-left">
                                        <label for="id_jenis_surat">Pilih Jenis Surat</label>
                                        <div class="position-relative">
                                            <select class="form-control" name="id_jenis_surat" id="id_jenis_surat" required>
                                                <option disabled selected>-- Pilih Jenis Surat --</option>
                                                @foreach ($jenisSurat as $surat)
                                                    <option value="{{ $surat->id }}">{{ $surat->nama }}
                                                        ({{ $surat->kode }})
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="form-control-icon">
                                                <i class="bi bi-card-text"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (!Auth::check() || Auth::user()->role == 'admin')
                                <div class="col-md-6 mb-4">
                                    {{-- <div class="form-group has-icon-left">
                                        <label for="nomor_surat">Nomor Surat</label>
                                        <div class="position-relative">
                                            <input 
                                                type="text" 
                                                name="nomor_surat" 
                                                id="nomor_surat" 
                                                class="form-control"
                                                value="{{ $nomorSurat ?? '' }}"
                                            >
                                            <div class="form-control-icon">
                                                <i class="bi bi-hash"></i>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                                @else
                                <div class="col-md-6 mb-4">
                                </div>
                                @endif
                                {{-- Kolom Kiri --}}
                                <div class="col-md-6">
                                    <div class="form-group has-icon-left">
                                        <label for="nik">NIK</label>
                                        <div class="position-relative">
                                            <input type="text" name="nik" id="nik" class="form-control"
                                                placeholder="NIK" value="{{ $resident->nik ?? '' }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-credit-card"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-icon-left">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <div class="position-relative">
                                            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
                                                placeholder="Nama Lengkap" value="{{ $resident->nama_lengkap ?? '' }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-icon-left">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <div class="position-relative">
                                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                                placeholder="Tempat Lahir" value="{{ $resident->tempat_lahir ?? '' }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-geo-alt"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-icon-left">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <div class="position-relative">
                                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                                class="form-control" value="{{ $resident->tanggal_lahir ?? '' }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-calendar"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-icon-left">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <div class="position-relative">
                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                                <option disabled {{ !$resident ? 'selected' : '' }}>Pilih Jenis Kelamin
                                                </option>
                                                <option value="L"
                                                    {{ $resident && $resident->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                                    Laki-laki</option>
                                                <option value="P"
                                                    {{ $resident && $resident->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                            <div class="form-control-icon">
                                                <i class="bi bi-gender-ambiguous"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-icon-left">
                                        <label for="alamat">Alamat</label>
                                        <div class="position-relative">
                                            <input type="text" name="alamat" id="alamat" class="form-control"
                                                placeholder="Alamat" value="{{ $resident->alamat ?? '' }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-house"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group has-icon-left">
                                        <label for="tanggal_lahir">Tanggal Pengajuan</label>
                                        <div class="position-relative">
                                            <input type="date" name="tanggal_pengajuan" id="tanggal_pengajuan"
                                                class="form-control" value="" readonly>
                                            <div class="form-control-icon">
                                                <i class="bi bi-calendar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Kolom Kanan --}}
                                <div class="col-md-6">
                                    <div class="form-group has-icon-left">
                                        <label for="agama">Agama</label>
                                        <div class="position-relative">
                                            <input type="text" name="agama" id="agama" class="form-control"
                                                placeholder="Agama" value="{{ $resident->agama ?? '' }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-book"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-icon-left">
                                        <label for="status_perkawinan">Status Perkawinan</label>
                                        <div class="position-relative">
                                            <input type="text" name="status_perkawinan" id="status_perkawinan"
                                                class="form-control" placeholder="Status Perkawinan"
                                                value="{{ $resident->status_perkawinan ?? '' }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-heart"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-icon-left">
                                        <label for="pekerjaan">Pekerjaan</label>
                                        <div class="position-relative">
                                            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control"
                                                placeholder="Pekerjaan" value="{{ $resident->pekerjaan ?? '' }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-briefcase"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-icon-left">
                                        <label for="kewarganegaraan">Kewarganegaraan</label>
                                        <div class="position-relative">
                                            <input type="text" name="kewarganegaraan" id="kewarganegaraan"
                                                class="form-control" placeholder="Kewarganegaraan"
                                                value="{{ $resident->kewarganegaraan ?? '' }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-flag"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-icon-left">
                                        <label for="nama_ayah">Nama Ayah</label>
                                        <div class="position-relative">
                                            <input type="text" name="nama_ayah" id="nama_ayah" class="form-control"
                                                placeholder="Nama Ayah" value="{{ $resident->nama_ayah ?? '' }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-person-badge"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-icon-left">
                                        <label for="nama_ibu">Nama Ibu</label>
                                        <div class="position-relative">
                                            <input type="text" name="nama_ibu" id="nama_ibu" class="form-control"
                                                placeholder="Nama Ibu" value="{{ $resident->nama_ibu ?? '' }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-person-badge-fill"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Catatan</label>
                                        <div id="catatan-wrapper">
                                            <div class="input-group mb-2 catatan-group">
                                                <input type="text" name="catatan_multi[]" class="form-control"
                                                    placeholder="Tulis catatan..." value="{{ old('catatan_multi.0') }}">
                                                <button type="button" class="btn btn-danger btn-remove-catatan">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-sm btn-secondary mt-2" id="add-catatan">
                                            <i class="bi bi-plus"></i> Tambah Catatan
                                        </button>

                                        {{-- Error tampil --}}
                                        @error('catatan_multi')
                                            <small class="text-danger d-block">{{ $message }}</small>
                                        @enderror
                                        @error('catatan_multi.*')
                                            <small class="text-danger d-block">{{ $message }}</small>
                                        @enderror
                                    </div>




                                </div>



                                {{-- Tombol --}}
                                <div class="col-12 d-flex justify-content-end mt-4">
                                    <button type="submit" class="btn btn-primary me-1 mb-1">Ajukan Surat</button>
                                    <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jenisSurat = document.getElementById('id_jenis_surat');
        const nomorSurat = document.getElementById('nomor_surat');

        jenisSurat.addEventListener('change', function() {
            const id = this.value;
            if (id) {
                fetch(`/get-nomor-surat/${id}`)
                    .then(res => res.json())
                    .then(data => {
                        nomorSurat.value = data.nomor;
                    })
                    .catch(err => console.error('Gagal mengambil nomor surat:', err));
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const wrapper = document.getElementById('catatan-wrapper');
        const addBtn = document.getElementById('add-catatan');

        addBtn.addEventListener('click', function() {
            const newField = document.createElement('div');
            newField.classList.add('input-group', 'mb-2', 'catatan-group');
            newField.innerHTML = `
                <input type="text" name="catatan_multi[]" class="form-control" placeholder="Tulis catatan...">
                <button type="button" class="btn btn-danger btn-remove-catatan"><i class="bi bi-x"></i></button>
            `;
            wrapper.appendChild(newField);
        });

        wrapper.addEventListener('click', function(e) {
            if (e.target.closest('.btn-remove-catatan')) {
                const group = e.target.closest('.catatan-group');
                group.remove();
            }
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('tanggal_pengajuan').value = today;
    });
</script>
