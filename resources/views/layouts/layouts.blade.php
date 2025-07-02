<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Surat Desa</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/iconly/bold.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    {{-- js aman dihapus --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css') }}"> --}}

</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-center">
                        <div class="logo text-center">
                            <a href="{{ route('dashboard') }}">
                                <img style="max-width: 75%; height: auto; width: 200px;" src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" srcset="">
                            </a>
                            {{-- Surat Desa --}}
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block">
                                {{-- <i class="bi bi-x bi-middle"></i> --}}
                                <i class="bi bi-justify fs-3"></i>
                            </a>
                        </div>
                        <br>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        @if (Auth::check() && Auth::user()->role == 'admin')
                            <li class="sidebar-item {{ request()->routeIs('jenis-surat') ? 'active' : '' }}">
                                <a href="{{ route('jenis-surat') }}" class='sidebar-link'>
                                    <i class="bi bi-envelope-open-fill"></i>
                                    <span>Jenis Surat</span>
                                </a>
                            </li>
                        @endif

                        <li class="sidebar-item {{ request()->routeIs('surat-pengajuan') ? 'active' : '' }} {{ request()->routeIs('surat-pengajuan.create') ? 'active' : '' }}">
                            <a href="{{ route('surat-pengajuan') }}" class='sidebar-link'>
                                <i class="bi bi-newspaper"></i>
                                <span>Surat Pengajuan</span>
                            </a>
                        </li>

                        @if (Auth::check() && Auth::user()->role == 'admin')
                            <li class="sidebar-item {{ request()->routeIs('users') ? 'active' : '' }}">
                                <a href="{{ route('users') }}" class='sidebar-link'>
                                    <i class="bi bi-people-fill"></i>
                                    <span>Users</span>
                                </a>
                            </li>
                        @endif

                        @if (Auth::check() && Auth::user()->role == 'admin')
                            <li class="sidebar-item {{ request()->routeIs('users.resident') ? 'active' : '' }}">
                                <a href="{{ route('users.resident') }}" class='sidebar-link'>
                                    <i class="bi bi-people-fill"></i>
                                    <span>Warga</span>
                                </a>
                            </li>
                        @else
                            <li class="sidebar-item d-none {{ request()->routeIs('users.resident') ? 'active' : '' }}">
                                <a href="{{ route('users.resident') }}" class='sidebar-link'>
                                    <i class="bi bi-people-fill"></i>
                                    <span>Warga</span>
                                </a>
                            </li>
                        @endif

                        <li class="sidebar-item {{ request()->routeIs('users.profile') ? 'active' : '' }}">
                            <a href="{{ route('users.profile') }}" class='sidebar-link'>
                                <i class="bi bi-person-fill"></i>
                                <span>Profile</span>
                            </a>
                        </li>

                        <li class="sidebar-item {{ request()->routeIs('proseslogout') ? 'active' : '' }}">
                            <a href="{{ route('proseslogout') }}" class='sidebar-link'>
                                <i class="bi bi-box-arrow-left"></i>
                                <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- <button class="sidebar-toggler btn x"><i data-feather="x"></i></button> --}}
            </div>
        </div>
        <div id="main">
            @yield('content')
        </div>
    </div>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    
    {{-- kumpulan js aman dihapus --}}
    {{-- <script src="{{ asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/vendors/apexcharts/apexcharts.js') }}"></script> --}} 
    {{-- <script src="{{ asset('assets/js/pages/dashboard.js') }}"></script> --}}
</body>

</html>
