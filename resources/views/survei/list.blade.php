<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Survei - SurveyApp</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: all 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        }
    </style>
</head>

<body class="bg-gradient-to-br from-blue-50 via-white to-purple-50 min-h-screen">

<!-- ================= HEADER ================= -->
<header class="gradient-bg shadow-lg">
    <div class="max-w-7xl mx-auto px-4 py-6 flex justify-between items-center">

        <!-- LOGO + TITLE -->
<div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow">
                <img
                    src="{{ asset('assets/logo.png') }}"
                    alt="Logo SurveyApp"
                    class="w-9 h-9 object-contain"
                >
            </div>        

            <div>
                <h1 class="text-2xl font-bold text-white">SurveyApp</h1>
                <p class="text-blue-100 text-sm">
                    Aplikasi Survei Kepuasan
                </p>
            </div>
        </div>

        <!-- ADMIN LOGIN -->
        <a href="{{ route('admin.login') }}"
           class="bg-white/20 hover:bg-white/30 text-white px-6 py-3 rounded-full font-medium flex items-center gap-2">
            <i data-lucide="shield" class="w-5 h-5"></i>
            Admin Login
        </a>
    </div>
</header>

<!-- ================= CONTENT ================= -->
<main class="max-w-7xl mx-auto px-4 py-16">

    <!-- HERO -->
    <div class="text-center mb-16">
        <h1 class="text-5xl font-bold text-gray-900 mb-4">
            Selamat Datang di
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                SurveyApp
            </span>
        </h1>
        <p class="text-gray-600 max-w-3xl mx-auto text-lg">
            Platform survei modern untuk mengukur kepuasan karyawan terhadap layanan pengelolaan Barang Milik Negara (BMN)
        </p>
    </div>

    <!-- ================= PILIH SURVEI ================= -->
    <section>
        <h2 class="text-3xl font-bold text-center text-gray-900 mb-3">
            Pilih Survei
        </h2>
        <p class="text-center text-gray-600 mb-12">
            Pilih survei yang ingin Anda isi dari daftar di bawah ini
        </p>

        @if(count($kontenSurveis) > 0)
        <div class="flex justify-center">
            <div class="grid gap-8 grid-cols-[repeat(auto-fit,minmax(320px,1fr))] max-w-5xl w-full">

                @foreach($kontenSurveis as $konten)
                <!-- CARD -->
                <div class="bg-white rounded-2xl shadow-lg card-hover overflow-hidden border border-gray-100 flex flex-col h-full">

                    <!-- CARD HEADER -->
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-6">
                        <div class="flex justify-between items-center">
                            <div class="bg-white/20 p-3 rounded-full">
                                <i data-lucide="file-text" class="w-6 h-6 text-white"></i>
                            </div>
                            <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm font-medium">
                                {{ $konten->tahun }}
                            </span>
                        </div>
                    </div>

                    <!-- CARD BODY -->
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-xl font-bold text-gray-900 mb-3">
                            {{ $konten->judul }}
                        </h3>

                        <p class="text-gray-600 text-sm mb-6">
                            {{ Str::limit($konten->pendahuluan, 140) }}
                        </p>

                        <div class="flex items-center justify-between mt-auto">
                            <div class="flex items-center gap-2 text-sm text-gray-500">
                                <i data-lucide="clock" class="w-4 h-4"></i>
                                Estimasi 5–10 menit
                            </div>

                            <a href="{{ route('survei.create', $konten->id) }}"
                               class="bg-gradient-to-r from-blue-600 to-purple-600
                                      hover:from-blue-700 hover:to-purple-700
                                      text-white px-6 py-3 rounded-full font-medium
                                      flex items-center gap-2">
                                Mulai Survei
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>

        @else
        <!-- EMPTY STATE -->
        <div class="text-center py-20">
            <i data-lucide="inbox" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
            <h3 class="text-2xl font-semibold text-gray-900 mb-2">
                Belum Ada Survei
            </h3>
            <p class="text-gray-600">
                Saat ini belum ada survei yang tersedia
            </p>
        </div>
        @endif

    </section>
</main>

<!-- ICON INIT -->
<script>
    lucide.creat
</script>

</body>
</html>
