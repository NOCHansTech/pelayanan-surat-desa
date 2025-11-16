<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - E-Surat Desa</title>
    
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/x-icon">
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .sidebar-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .sidebar-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .sidebar-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }
        .sidebar-scrollbar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50">
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-gradient-to-b from-emerald-600 to-emerald-700 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0 -translate-x-full">
            <div class="flex flex-col h-full">
                
                <!-- Logo -->
                <div class="flex items-center justify-between px-6 py-5 border-b border-emerald-500 bg-emerald-600/20 backdrop-blur-sm">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 bg-white p-3 rounded-lg shadow">
                        <img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo" class="h-16 w-auto">
                    </a>
                    <button onclick="toggleSidebar()" class="lg:hidden text-white hover:bg-emerald-500 p-2 rounded-lg transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto sidebar-scrollbar">
                    <p class="px-3 text-xs font-semibold text-emerald-200 uppercase tracking-wider mb-3">Menu Utama</p>
                    
                    <a href="{{ route('dashboard') }}" class="flex items-center px-3 py-2.5 text-white rounded-lg transition group {{ request()->routeIs('dashboard') ? 'bg-emerald-500 shadow-lg' : 'hover:bg-emerald-500/50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    @if (Auth::check() && Auth::user()->role == 'admin')
                        <a href="{{ route('jenis-surat') }}" class="flex items-center px-3 py-2.5 text-white rounded-lg transition group {{ request()->routeIs('jenis-surat') ? 'bg-emerald-500 shadow-lg' : 'hover:bg-emerald-500/50' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span class="font-medium">Jenis Surat</span>
                        </a>
                    @endif

                    <a href="{{ route('surat-pengajuan') }}" class="flex items-center px-3 py-2.5 text-white rounded-lg transition group {{ request()->routeIs('surat-pengajuan') || request()->routeIs('surat-pengajuan.create') ? 'bg-emerald-500 shadow-lg' : 'hover:bg-emerald-500/50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span class="font-medium">Surat Pengajuan</span>
                    </a>

                    <a href="{{ route('resident.index') }}" class="flex items-center px-3 py-2.5 text-white rounded-lg transition group {{ request()->routeIs('resident.index') || request()->routeIs('resident.*') ? 'bg-emerald-500 shadow-lg' : 'hover:bg-emerald-500/50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <span class="font-medium">Data Warga</span>
                    </a>

                    @if (Auth::check() && Auth::user()->role == 'admin')
                        <a href="{{ route('users') }}" class="flex items-center px-3 py-2.5 text-white rounded-lg transition group {{ request()->routeIs('users') ? 'bg-emerald-500 shadow-lg' : 'hover:bg-emerald-500/50' }}">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                            <span class="font-medium">Users</span>
                        </a>
                    @endif

                    <div class="border-t border-emerald-500 my-4"></div>
                    
                    <p class="px-3 text-xs font-semibold text-emerald-200 uppercase tracking-wider mb-3">Akun</p>

                    <a href="{{ route('users.profile') }}" class="flex items-center px-3 py-2.5 text-white rounded-lg transition group {{ request()->routeIs('users.profile') ? 'bg-emerald-500 shadow-lg' : 'hover:bg-emerald-500/50' }}">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="font-medium">Profile</span>
                    </a>

                    <a href="{{ route('proseslogout') }}" class="flex items-center px-3 py-2.5 text-white rounded-lg transition group hover:bg-red-500/50">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="font-medium">Logout</span>
                    </a>
                </nav>

                <!-- User Info -->
                <div class="p-4 border-t border-emerald-500">
                    <div class="flex items-center space-x-3 px-3 py-2 bg-emerald-500/30 rounded-lg">
                        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-emerald-600 font-bold">
                            {{ substr(Auth::user()->name ?? 'U', 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name ?? 'User' }}</p>
                            <p class="text-xs text-emerald-200 truncate">{{ ucfirst(Auth::user()->role ?? 'warga') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Overlay for mobile -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden" onclick="toggleSidebar()"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            
            <!-- Top Header -->
            <header class="bg-white border-b border-gray-200 sticky top-0 z-30">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <button onclick="toggleSidebar()" class="lg:hidden text-gray-600 hover:text-gray-900 hover:bg-gray-100 p-2 rounded-lg transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            </svg>
                        </button>
                        
                        <div class="flex-1 lg:ml-0 ml-4">
                            <h1 class="text-xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                        </div>

                        <div class="flex items-center space-x-3">
                            <button class="relative p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                                </svg>
                                <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full"></span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                <div class="px-4 sm:px-6 lg:px-8 py-8">
                    @yield('content')
                </div>
            </main>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 py-4">
                <div class="px-4 sm:px-6 lg:px-8">
                    <div class="flex flex-col sm:flex-row items-center justify-between text-sm text-gray-600">
                        <p>&copy; {{ date('Y') }} E-Surat Desa. All rights reserved.</p>
                        <div class="flex items-center space-x-4 mt-2 sm:mt-0">
                            <a href="#" class="hover:text-emerald-600 transition">Bantuan</a>
                            <a href="#" class="hover:text-emerald-600 transition">Kebijakan Privasi</a>
                            <a href="#" class="hover:text-emerald-600 transition">Syarat & Ketentuan</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const target = event.target;
            
            if (window.innerWidth < 1024) {
                if (!sidebar.contains(target) && !target.closest('button[onclick="toggleSidebar()"]')) {
                    if (!sidebar.classList.contains('-translate-x-full')) {
                        sidebar.classList.add('-translate-x-full');
                        overlay.classList.add('hidden');
                    }
                }
            }
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>