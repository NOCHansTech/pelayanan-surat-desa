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
                                {{-- Kolom Kiri --}}
                                <div class="col-md-6 mb-4">
                                    <input type="button" value="{{Auth::user()->id_users}}">
                                    <div class="form-group has-icon-left">
                                        <label for="id_jenis_surat">Pilih Jenis Surat</label>
                                        <div class="position-relative">
                                            <select class="form-control" name="id_jenis_surat" id="id_jenis_surat" required>
                                                <option disabled selected>-- Pilih Jenis Surat --</option>
                                                @foreach ($jenisSurat as $surat)
                                                    <option value="{{ $surat->id }}">{{ $surat->nama }} ({{ $surat->kode }})</option>
                                                @endforeach
                                            </select>
                                            <div class="form-control-icon">
                                                <i class="bi bi-card-text"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Kolom Kanan --}}
                                <div class="col-md-6 mb-4">
                                    <div class="form-group has-icon-left">
                                        <label for="resident">Pilih Resident</label>
                                        <div class="position-relative">
                                            <select class="form-control" name="resident_id" id="resident">
                                                        <option value="">-- Pilih Warga Jika Sudah Terdaftar --</option>
                                                        @foreach ($residents as $resident)
                                                        <option value="{{ $resident->id }}">{{ $resident->nama_lengkap }} ({{ $resident->nik }})</option>
                                                        @endforeach
                                            </select>
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                {{-- Kolom Kiri --}}
                                <div class="col-md-6 mb-4">
                                    <div class="form-group has-icon-left">
                                        <label for="nik">NIK</label>
                                        <div class="position-relative">
                                            <input type="text" name="nik" id="nik" class="form-control"
                                                placeholder="NIK" value="{{ old('nik') ?? '' }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-credit-card"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-icon-left">
                                        <label for="nama_lengkap">Nama Lengkap</label>
                                        <div class="position-relative">
                                            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
                                                placeholder="Nama Lengkap" value="{{ old('nama_lengkap') ?? '' }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-icon-left">
                                        <label for="tempat_lahir">Tempat Lahir</label>
                                        <div class="position-relative">
                                            <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control"
                                                placeholder="Tempat Lahir" value="{{ old('tempat_lahir') ?? '' }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-geo-alt"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-icon-left">
                                        <label for="tanggal_lahir">Tanggal Lahir</label>
                                        <div class="position-relative">
                                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                                class="form-control" value="{{ old('tanggal_lahir') ?? '' }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-calendar"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-icon-left">
                                        <label for="jenis_kelamin">Jenis Kelamin</label>
                                        <div class="position-relative">
                                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin" required>
                                                <option disabled {{ old('jenis_kelamin') == null ? 'selected' : '' }}>Pilih Jenis Kelamin</option>
                                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
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
                                                placeholder="Alamat" value="{{ old('alamat') ?? '' }}">
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
                                                placeholder="Agama" value="{{ old('agama') ?? '' }}">
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
                                                value="{{ old('status_perkawinan') ?? '' }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-heart"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-icon-left">
                                        <label for="pekerjaan">Pekerjaan</label>
                                        <div class="position-relative">
                                            <input type="text" name="pekerjaan" id="pekerjaan" class="form-control"
                                                placeholder="Pekerjaan" value="{{ old('pekerjaan') ?? '' }}">
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
                                                value="{{ old('kewarganegaraan') ?? '' }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-flag"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-icon-left">
                                        <label for="nama_ayah">Nama Ayah</label>
                                        <div class="position-relative">
                                            <input type="text" name="nama_ayah" id="nama_ayah" class="form-control"
                                                placeholder="Nama Ayah" value="{{ old('nama_ayah') ?? '' }}">
                                            <div class="form-control-icon">
                                                <i class="bi bi-person-badge"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group has-icon-left">
                                        <label for="nama_ibu">Nama Ibu</label>
                                        <div class="position-relative">
                                            <input type="text" name="nama_ibu" id="nama_ibu" class="form-control"
                                                placeholder="Nama Ibu" value="{{ old('nama_ibu') ?? '' }}">
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
                                    </div>
                                </div>
                            </div>

                            {{-- Tombol --}}
                            <div class="col-12 d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Ajukan Surat</button>
                                <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
    const residentSelect = document.getElementById('resident');

    residentSelect.addEventListener('change', function() {
        const residentId = this.value;

        if (!residentId) {
            // Reset semua field jika pilihan dikosongkan
            document.querySelectorAll(
                '#nik, #nama_lengkap, #tempat_lahir, #tanggal_lahir, #jenis_kelamin, #alamat, #agama, #status_perkawinan, #pekerjaan, #kewarganegaraan, #nama_ayah, #nama_ibu'
            ).forEach(input => input.value = '');
            return;
        }

        fetch(`/get-resident-data/${residentId}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('nik').value = data.nik || '';
                document.getElementById('nama_lengkap').value = data.nama_lengkap || '';
                document.getElementById('tempat_lahir').value = data.tempat_lahir || '';
                document.getElementById('tanggal_lahir').value = data.tanggal_lahir || '';
                document.getElementById('jenis_kelamin').value = data.jenis_kelamin || '';
                document.getElementById('alamat').value = data.alamat || '';
                document.getElementById('agama').value = data.agama || '';
                document.getElementById('status_perkawinan').value = data.status_perkawinan || '';
                document.getElementById('pekerjaan').value = data.pekerjaan || '';
                document.getElementById('kewarganegaraan').value = data.kewarganegaraan || '';
                document.getElementById('nama_ayah').value = data.nama_ayah || '';
                document.getElementById('nama_ibu').value = data.nama_ibu || '';
            })
            .catch(error => console.error('Error fetching resident data:', error));
    });

    // Set tanggal hari ini untuk tanggal pengajuan
    document.getElementById('tanggal_pengajuan').value = new Date().toISOString().split('T')[0];
});
</script>


<script>
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
