<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pegawai - Aplikasi Survei</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex flex-col">

        <!-- Navbar -->
        <nav class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="text-xl font-bold text-gray-900">Aplikasi Survei</div>
                    <div class="flex items-center space-x-4">
                        <!-- Login Admin -->
                        <form action="{{ route('admin.login') }}" method="GET">
                            <button type="submit" class="text-white bg-gray-600 hover:bg-gray-700 px-3 py-1 rounded">
                                Login Admin
                            </button>
                        </form>
                        <!-- Isi Survei Baru -->
                        <a href="{{ route('survei.create') }}" class="text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded">
                            Isi Survei Baru
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Konten Utama -->
        <main class="flex-1 flex flex-col justify-center items-center py-20 px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl w-full bg-white shadow-lg rounded-lg p-8 text-center">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Selamat Datang!</h1>
                <p class="text-gray-600 mb-6">
                    Terima kasih telah menggunakan aplikasi survei kepuasan karyawan. 
                    Silakan isi survei baru untuk memberikan masukan Anda.  
                    Hasil survei hanya dapat dilihat oleh admin.
                </p>
                <div class="flex justify-center gap-4 mt-4">
                    <a href="{{ route('survei.create') }}" 
                       class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Isi Survei Sekarang
                    </a>
                    <form action="{{ route('admin.login') }}" method="GET">
                        <button type="submit" 
                                class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
                            Login Admin
                        </button>
                    </form>
                </div>
            </div>

            <!-- Pesan sukses / error -->
            @if(session('success'))
            <div class="mt-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="mt-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                {{ session('error') }}
            </div>
            @endif
        </main>

        <!-- Footer -->
        <footer class="bg-white shadow py-4 mt-auto">
            <div class="max-w-7xl mx-auto text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Aplikasi Survei Kepuasan Karyawan
            </div>
        </footer>
    </div>
</body>
</html>
