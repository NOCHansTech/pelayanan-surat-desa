<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login - SURAT DESA</title>

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet" />

  <!-- Bootstrap CSS -->
  <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/pages/auth.css') }}" rel="stylesheet" />

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
      max-width: 480px;
      border-radius: 1rem;
      border: none;
      box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
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

    .auth-logo img {
      height: 100px;
    }
  </style>
</head>
<body>

  <div id="auth">
    <div class="card p-4">
      <div class="card-body">
        <div class="auth-logo text-center mb-4">
          <a href="{{ route('login') }}">
            <img class="img-fluid" src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" />
          </a>
        </div>

        <h1 class="text-center mb-3">Log In</h1>
        <p class="text-center text-muted mb-4">Website Pelayanan Surat Desa</p>

        {{-- Flash Messages --}}
        @if (session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if (Session::get('warning'))
          <div class="alert alert-warning">
            <p>{{ Session::get('warning') }}</p>
          </div>
        @endif

        <form action="{{ route('proseslogin') }}" method="POST">
          @csrf
          <div class="form-group position-relative has-icon-left mb-4">
            <input type="text" class="form-control form-control-xl" name="username" placeholder="Username" required>
            <div class="form-control-icon">
              <i class="bi bi-person"></i>
            </div>
          </div>

          <div class="form-group position-relative has-icon-left mb-4">
            <input type="password" class="form-control form-control-xl" name="password" placeholder="Password" required>
            <div class="form-control-icon">
              <i class="bi bi-shield-lock"></i>
            </div>
          </div>

          <button class="btn btn-primary w-100 btn-lg shadow-lg mt-3">Log In</button>
        </form>

        <div class="text-center mt-4">
          <p class="text-muted">Belum Punya Akun? <a href="{{ route('register') }}" class="fw-bold">Buat Akun</a></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
