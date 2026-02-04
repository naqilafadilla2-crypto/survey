<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SurveyApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body class="gradient-bg min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8">
        <!-- Logo and Title -->
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-white bg-opacity-20 rounded-full mb-8 p-4">
                <svg viewBox="0 0 120 120" class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
                    <!-- Left shape: dark blue path with red start and dark blue end -->
                    <rect x="10" y="10" width="18" height="18" rx="4" fill="#991b1b"/>
                    <path d="M 19 19 Q 19 30 25 35 Q 35 45 45 50 Q 55 55 65 60 Q 75 65 85 70" 
                          stroke="#1e3a8a" stroke-width="10" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                    <rect x="80" y="65" width="18" height="18" rx="4" fill="#1e3a8a"/>
                    
                    <!-- Right shape: light blue path with light blue start and yellow end -->
                    <rect x="92" y="10" width="18" height="18" rx="4" fill="#3b82f6"/>
                    <path d="M 101 19 Q 101 30 95 35 Q 85 45 75 50 Q 65 55 55 60 Q 45 65 35 70" 
                          stroke="#3b82f6" stroke-width="10" fill="none" stroke-linecap="round" stroke-linejoin="round"/>
                    <rect x="27" y="92" width="18" height="18" rx="4" fill="#eab308"/>
                </svg>
            </div>
            <h2 class="text-4xl font-bold text-white mb-2">
                SurveyApp
            </h2>
            <p class="text-xl text-blue-100">
                Admin Dashboard
            </p>
        </div>

        <!-- Login Form -->
        <div class="glass-effect rounded-2xl shadow-2xl p-8">
            <div class="text-center mb-8">
                <h3 class="text-2xl font-semibold text-gray-900 mb-2">Login Admin</h3>
                <p class="text-gray-600">Masuk untuk mengakses dashboard administrator</p>
            </div>

            <form class="space-y-6" action="{{ route('admin.login') }}" method="POST">
                @csrf

                @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                    <div class="flex items-center">
                        <i data-lucide="alert-circle" class="w-5 h-5 mr-2 flex-shrink-0"></i>
                        <div>
                            <ul class="text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <div class="space-y-4">
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <i data-lucide="mail" class="w-4 h-4 mr-2 text-gray-500"></i>
                            Email
                        </label>
                        <input id="email" name="email" type="email" autocomplete="email" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white bg-opacity-50"
                            placeholder="admin@bakti.go.id" value="{{ old('email') }}">
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2 flex items-center">
                            <i data-lucide="lock" class="w-4 h-4 mr-2 text-gray-500"></i>
                            Password
                        </label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all bg-white bg-opacity-50"
                            placeholder="Masukkan password">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember" name="remember" type="checkbox"
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="remember" class="ml-2 block text-sm text-gray-700">
                            Ingat saya
                        </label>
                    </div>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white py-3 px-4 rounded-xl hover:from-blue-700 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all font-medium flex items-center justify-center space-x-2 shadow-lg">
                    <i data-lucide="log-in" class="w-5 h-5"></i>
                    <span>Masuk ke Dashboard</span>
                </button>
            </form>

            <!-- Back to Home -->
            <div class="mt-6 text-center">
                <a href="{{ route('survei.index') }}" class="text-blue-600 hover:text-blue-800 text-sm flex items-center justify-center space-x-1">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                    <span>Kembali ke Halaman Utama</span>
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="text-center">
            <p class="text-blue-100 text-sm">
                © 2026 SurveyApp - Aplikasi Survei Modern
            </p>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
