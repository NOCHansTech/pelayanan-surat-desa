@extends('layouts.layouts')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <style>
        .clickable-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }
        .clickable-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1)
        }
    </style>

    <div class="page-heading">
        <h3>Dashboard</h3>
        <h4>Selamat Datang {{ $nama_users }}</h4>
    </div>
    <div class="page-content">
        <section class="row">
            <div class="row">
                <div class="col-6 col-lg-3 col-md-6">
                    <a href="{{ route('surat-pengajuan', ['status' => 'diajukan']) }}#search">
                        <div class="card clickable-card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon purple">
                                            <i class="iconly-boldSend"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Surat Diajukan</h6>
                                        <h6 class="font-extrabold mb-0">{{ $pengajuan_diajukan }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <a href="{{ route('surat-pengajuan', ['status' => 'diproses']) }}#search">
                        <div class="card clickable-card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon blue">
                                            <i class="iconly-boldSend"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Surat DiProses</h6>
                                        <h6 class="font-extrabold mb-0">{{ $pengajuan_diproses }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <a href="{{ route('surat-pengajuan', ['status' => 'ditolak']) }}#search">
                        <div class="card clickable-card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon green">
                                            <i class="iconly-boldSend"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Surat DiTolak</h6>
                                        <h6 class="font-extrabold mb-0">{{ $pengajuan_ditolak }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-lg-3 col-md-6">
                    <a href="{{ route('surat-pengajuan', ['status' => 'selesai']) }}#search">
                        <div class="card clickable-card">
                            <div class="card-body px-3 py-4-5">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="stats-icon red">
                                            <i class="iconly-boldBookmark"></i>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h6 class="text-muted font-semibold">Surat Selesai</h6>
                                        <h6 class="font-extrabold mb-0">{{ $pengajuan_selesai }}</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection
