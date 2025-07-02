@extends('layouts.layouts')
@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>
    <div class="page-heading">
        <h3>Data Profile</h3>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="col-sm-12 col-lg-6">

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="card mt-5">
                    <div class="card-header">
                        <h4 class="card-title">Data Profile</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control"
                                    value="{{ old('username', $user->username) }}" required>
                                @error('username')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label>Password Baru (opsional)</label>
                                <input type="password" name="password" class="form-control">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label>Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control">
                            </div>

                            <div class="form-group mb-3">
                                <label>Role</label>
                                <input type="text" class="form-control" value="{{ $user->role }}" readonly>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection
