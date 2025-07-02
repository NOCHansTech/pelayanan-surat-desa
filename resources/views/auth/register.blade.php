<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daftar - SURAT DESA</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

  <!-- Select2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

  <style>
    body {
      font-family: 'Nunito', sans-serif;
      background-color: #f8f9fa;
    }
    #auth {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 2rem;
    }
    .card {
      width: 100%;
      max-width: 960px;
      border: none;
      border-radius: 1rem;
      box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
    }
    .auth-logo img {
      height: 100px;
    }
    .form-control-icon {
      position: absolute;
      top: 50%;
      left: 15px;
      transform: translateY(-50%);
      pointer-events: none;
      color: #6c757d;
      font-size: 1.25rem;
    }
    .form-group {
      position: relative;
    }
    .form-control-xl {
      padding-left: 2.5rem;
      font-size: 1rem;
    }

    /* Select2 Styling to prevent icon overlapping */
    .select2-container--default .select2-selection--single {
      height: calc(1.5em + 1rem + 2px);
      padding: 0.375rem 0.75rem 0.375rem 2.5rem;
      font-size: 1rem;
      line-height: 1.5;
      border: 1px solid #ced4da;
      border-radius: 0.375rem;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
      line-height: 2.2rem;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 100%;
      right: 10px;
    }
  </style>
</head>
<body>

  <div id="auth">
    <div class="card p-4">
      <div class="card-body">
        <div class="auth-logo mb-4 text-center">
          <a class="img-fluid" href="#"><img src="assets/images/logo/logo.png" alt="Logo" /></a>
        </div>

        <h1 class="text-center mb-2">Sign Up</h1>
        <p class="text-center text-muted mb-4">Input your data to register to our website.</p>

        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

<form action="{{ route('prosesregister') }}" method="POST">
    @csrf

    <h4>Data Akun</h4>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="form-group has-icon-left">
                <input type="text" name="username" class="form-control form-control-xl" placeholder="Username" value="{{ old('username') }}" />
                <div class="form-control-icon"><i class="bi bi-person"></i></div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group has-icon-left">
                <input type="password" name="password" class="form-control form-control-xl" placeholder="Password" />
                <div class="form-control-icon"><i class="bi bi-shield-lock"></i></div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group has-icon-left">
                <input type="password" name="password_confirmation" class="form-control form-control-xl" placeholder="Konfirmasi Password" />
                <div class="form-control-icon"><i class="bi bi-shield-lock-fill"></i></div>
            </div>
        </div>
    </div>

    <h4>Data Diri</h4>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="form-group has-icon-left">
                <input type="text" name="nik" class="form-control form-control-xl" placeholder="NIK" value="{{ old('nik') }}" />
                <div class="form-control-icon"><i class="bi bi-credit-card-2-front"></i></div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group has-icon-left">
                <input type="text" name="nama_lengkap" class="form-control form-control-xl" placeholder="Nama Lengkap" value="{{ old('nama_lengkap') }}" />
                <div class="form-control-icon"><i class="bi bi-person-badge"></i></div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group has-icon-left">
                <input type="text" name="tempat_lahir" class="form-control form-control-xl" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}" />
                <div class="form-control-icon"><i class="bi bi-geo-alt"></i></div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group has-icon-left">
                <input type="date" name="tanggal_lahir" class="form-control form-control-xl" value="{{ old('tanggal_lahir') }}" />
                <div class="form-control-icon"><i class="bi bi-calendar"></i></div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group has-icon-left">
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                    <option value="">Pilih Jenis Kelamin</option>
                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                <div class="form-control-icon"><i class="bi bi-gender-ambiguous"></i></div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <div class="input-group input-group-xl mb-3">
                <span class="input-group-text">
                    <i class="bi bi-house me-1"></i>
                </span>
                <input
                    type="text"
                    id="kampung"
                    name="kampung"
                    class="form-control"
                    placeholder="Nama Kampung"
                    aria-label="Nama Kampung"
                    oninput="enforcePrefix(this, 'Kp. ')"
                    value="{{ old('kampung') ? old('kampung') : 'Kp. ' }}"
                />
                <span class="input-group-text">RT</span>
                <input
                    type="text"
                    id="rt"
                    name="rt"
                    class="form-control"
                    placeholder="001"
                    maxlength="3"
                    style="max-width: 80px"
                    aria-label="RT"
                    value="{{ old('rt') }}"
                />
                <span class="input-group-text">RW</span>
                <input
                    type="text"
                    id="rw"
                    name="rw"
                    class="form-control"
                    placeholder="001"
                    maxlength="3"
                    style="max-width: 80px"
                    aria-label="RW"
                    value="{{ old('rw') }}"
                />
                <input
                    type="text"
                    id="desa_kec_prov"
                    name="desa_kec_prov"
                    class="form-control"
                    value="Desa. Karangmekar, Kec. Cimanggu, Kab. Sukabumi, Prov. Jawa Barat"
                    style="min-width: 300px"
                    aria-label="desa_kec_prov"
                />
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group has-icon-left">
                <select name="agama" id="agama" class="form-control">
                    <option value="">Pilih Agama</option>
                    <option value="Islam" {{ old('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ old('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Katolik" {{ old('Isa') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Hindu" {{ old('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Budha" {{ old('agama') == 'Budha' ? 'selected' : '' }}>Budha</option>
                    <option value="Konghucu" {{ old('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
                <div class="form-control-icon"><i class="bi bi-bookmark-star"></i></div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group has-icon-left">
                <input type="text" name="status_perkawinan" class="form-control form-control-xl" placeholder="Status Perkawinan" value="{{ old('status_perkawinan') }}" />
                <div class="form-control-icon"><i class="bi bi-heart"></i></div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group has-icon-left">
                <input type="text" name="pekerjaan" class="form-control form-control-xl" placeholder="Pekerjaan" value="{{ old('pekerjaan') }}" />
                <div class="form-control-icon"><i class="bi bi-briefcase"></i></div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group has-icon-left">
                <input type="text" name="kewarganegaraan" class="form-control form-control-xl" placeholder="Kewarganegaraan" value="{{ old('kewarganegaraan', 'Indonesia') }}" />
                <div class="form-control-icon"><i class="bi bi-flag"></i></div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group has-icon-left">
                <input type="text" name="nama_ayah" class="form-control form-control-xl" placeholder="Nama Ayah" value="{{ old('nama_ayah') }}" />
                <div class="form-control-icon"><i class="bi bi-person-lines-fill"></i></div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="form-group has-icon-left">
                <input type="text" name="nama_ibu" class="form-control form-control-xl" placeholder="Nama Ibu" value="{{ old('nama_ibu') }}" />
                <div class="form-control-icon"><i class="bi bi-person-lines-fill"></i></div>
            </div>
        </div>
    </div>

    <button class="btn btn-primary w-100 btn-lg shadow-lg mt-3">Sign Up</button>
</form>

        <div class="text-center mt-4">
          <p class="text-muted">
            Sudah Punya Akun? <a href="{{ route('login') }}" class="fw-bold">Log in</a>
          </p>
        </div>
      </div>
    </div>
  </div>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Select2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#agama').select2({
        placeholder: "Pilih Agama",
        allowClear: true,
        width: '100%'
      });
      $('#jenis_kelamin').select2({
        placeholder: "Jenis Kelamin",
        allowClear: true,
        width: '100%'
      });
    });
  </script>
    <script>
        function capitalizeAfterSpace(text) {
            return text
                .split(' ')
                .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                .join(' ');
        }

        function enforcePrefix(input, prefix) {
            // Pastikan input dimulai dengan prefix
            if (!input.value.startsWith(prefix)) {
                input.value = prefix + input.value.slice(prefix.length);
            }
            // Ambil bagian setelah prefix dan kapitalisasi setiap kata
            if (input.value.length > prefix.length) {
                const afterPrefix = input.value.slice(prefix.length);
                input.value = prefix + capitalizeAfterSpace(afterPrefix);
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            const kampungInput = document.getElementById('kampung');
            const prefix = 'Kp. ';
            // Set prefix saat halaman dimuat
            if (!kampungInput.value.startsWith(prefix)) {
                kampungInput.value = prefix;
            }
            // Kapitalisasi setiap kata setelah prefix saat halaman dimuat
            if (kampungInput.value.length > prefix.length) {
                const afterPrefix = kampungInput.value.slice(prefix.length);
                kampungInput.value = prefix + capitalizeAfterSpace(afterPrefix);
            }
            // Tambahkan event listener untuk memantau perubahan input
            kampungInput.addEventListener('input', () => {
                enforcePrefix(kampungInput, prefix);
            });
        });
    </script>
</body>
</html>
