<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard Admin') - SurveyApp</title>
    
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    
    @stack('styles')
    
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        }
        .sidebar-link {
            transition: all 0.2s ease;
        }
        .sidebar-link:hover {
            background: rgba(102, 126, 234, 0.1);
        }
        .sidebar-link.active {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white !important;
        }
        .sidebar-link.active i {
            color: white !important;
        }
        .sidebar-link.active span {
            color: white !important;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-purple-50 min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-lg flex flex-col">
            <!-- Logo/Header -->
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 flex items-center justify-center">
                       <img src="{{ asset('assets/logo.png') }}" alt="Logo SurveyApp" class="w-10 h-10 object-contain">
                    </div>
                    <div>
                        <h1 class="text-lg font-bold text-gray-900">SurveyApp</h1>
                        <p class="text-xs text-gray-500">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 overflow-y-auto p-4">
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" 
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                        <span class="font-medium">Dashboard</span>
                    </a>

                    <a href="{{ route('admin.konten-survei.index') }}" 
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 {{ request()->routeIs('admin.konten-survei.*') && !request()->routeIs('admin.konten-survei.questions.*') ? 'active' : '' }}">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                        <span class="font-medium">Konten Survei</span>
                    </a>

                    <a href="{{ route('admin.konten-survei.questions.select') }}" 
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 {{ request()->routeIs('admin.konten-survei.questions.*') ? 'active' : '' }}">
                        <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                        <span class="font-medium">Pertanyaan</span>
                    </a>

                    <a href="{{ route('admin.pegawais.index') }}" 
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 {{ request()->routeIs('admin.pegawais.*') ? 'active' : '' }}">
                        <i data-lucide="users" class="w-5 h-5"></i>
                        <span class="font-medium">Pegawai</span>
                    </a>

                    <a href="{{ route('admin.laporan.index') }}" 
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                        <i data-lucide="bar-chart-3" class="w-5 h-5"></i>
                        <span class="font-medium">Laporan</span>
                    </a>

                    <!-- Divider -->
                    <div class="my-4 border-t border-gray-200"></div>

                    <p class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wider">Pengaturan</p>

                    <a href="{{ route('admin.direktorats.index') }}" 
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 {{ request()->routeIs('admin.direktorats.*') ? 'active' : '' }}">
                        <i data-lucide="building-2" class="w-5 h-5"></i>
                        <span class="font-medium">Direktorat</span>
                    </a>

                    <a href="{{ route('admin.status-pegawais.index') }}" 
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 {{ request()->routeIs('admin.status-pegawais.*') ? 'active' : '' }}">
                        <i data-lucide="badge-check" class="w-5 h-5"></i>
                        <span class="font-medium">Status Pegawai</span>
                    </a>

                    <a href="{{ route('admin.lama-bekerjas.index') }}" 
                       class="sidebar-link flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 {{ request()->routeIs('admin.lama-bekerjas.*') ? 'active' : '' }}">
                        <i data-lucide="clock" class="w-5 h-5"></i>
                        <span class="font-medium">Lama Bekerja</span>
                    </a>
                </div>
            </nav>

            <!-- Footer -->
            <div class="p-4 border-t border-gray-200">
                <a href="{{ route('survei.index') }}" 
                   class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors mb-2">
                    <i data-lucide="home" class="w-5 h-5"></i>
                    <span class="font-medium text-sm">Beranda</span>
                </a>
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" 
                            class="w-full flex items-center gap-3 px-4 py-2 rounded-lg text-red-600 hover:bg-red-50 transition-colors">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                        <span class="font-medium text-sm">Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Header -->
            <header class="gradient-bg shadow-md">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-white">@yield('page-title', 'Dashboard')</h2>
                            <p class="text-sm text-blue-100">@yield('page-description', 'Selamat datang di panel admin')</p>
                        </div>
                        <div class="flex items-center gap-3">
                            @yield('header-actions')
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-y-auto p-6">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-6 py-4 rounded-xl mb-6 flex items-center gap-2">
                        <i data-lucide="check-circle" class="w-5 h-5"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-4 rounded-xl mb-6">
                        <div class="flex items-center gap-2 mb-2">
                            <i data-lucide="alert-circle" class="w-5 h-5"></i>
                            <span class="font-semibold">Terjadi kesalahan:</span>
                        </div>
                        <ul class="list-disc list-inside ml-7">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();
        
        // Re-initialize icons after dynamic content loads
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>

    @stack('scripts')
</body>
</html>
