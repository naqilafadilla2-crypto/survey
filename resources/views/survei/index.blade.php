<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - SurveyApp</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-survei {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .card-survei:hover {
            transform: translateY(-8px);
            box-shadow: 0 24px 48px rgba(102, 126, 234, 0.18);
        }
        .card-survei .card-header-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        @keyframes fade-in {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in {
            animation: fade-in 0.5s ease-out;
        }
        .text-gradient {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #6366f1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        /* Scrollbar halus */
        html { scroll-behavior: smooth; }
        body::-webkit-scrollbar { width: 8px; }
        body::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 4px; }
        body::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        body::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
    </style>
</head>

<body class="min-h-screen bg-[#fafbff] text-gray-900 antialiased">

<!-- HEADER -->
<header class="gradient-bg shadow-md">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-4 flex justify-between items-center gap-4">
        <div class="flex items-center gap-4 min-w-0">
            <div class="flex-shrink-0 w-12 h-12 rounded-full bg-white/20 flex items-center justify-center">
                <i data-lucide="clipboard-list" class="w-6 h-6 text-white"></i>
            </div>
            <div class="min-w-0">
                <h1 class="text-xl sm:text-2xl font-bold text-white truncate">SurveyApp</h1>
                <p class="text-blue-100 text-sm">Aplikasi Survei Kepuasan</p>
            </div>
        </div>
        <a href="{{ route('admin.login') }}"
           class="flex-shrink-0 inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 text-white px-5 py-2.5 rounded-full font-medium transition-colors">
            <i data-lucide="shield" class="w-5 h-5"></i>
            <span>Admin Login</span>
        </a>
    </div>
</header>

<!-- CONTENT -->
<main class="max-w-6xl mx-auto px-4 sm:px-6 py-10 sm:py-14">

    <!-- NOTIFIKASI SUKSES -->
    @if(session('success'))
    <div class="mb-8 animate-fade-in">
        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 rounded-xl p-5 shadow-md flex items-start gap-4">
            <div class="bg-green-500 rounded-full p-2 flex-shrink-0">
                <i data-lucide="check-circle" class="w-5 h-5 text-white"></i>
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="font-semibold text-green-900">Terima Kasih!</h3>
                <p class="text-green-800 text-sm mt-0.5">{{ session('success') }}</p>
            </div>
            <button type="button" onclick="this.closest('.animate-fade-in').remove()" class="text-green-600 hover:text-green-800 flex-shrink-0 p-1">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>
    </div>
    @endif

    <!-- HERO -->
    <section class="text-center mb-12 sm:mb-16">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-gray-900 mb-3 sm:mb-4 leading-tight">
            Selamat Datang di <span class="text-gradient">SurveyApp</span>
        </h1>
        <p class="text-gray-600 max-w-2xl mx-auto text-base sm:text-lg leading-relaxed">
            Platform survei modern untuk mengukur kepuasan karyawan terhadap layanan pengelolaan Barang Milik Negara (BMN).
        </p>
    </section>

    <!-- PILIH SURVEI -->
    <section>
        <div class="text-center mb-8 sm:mb-10">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                Pilih Survei
            </h2>
            <p class="text-gray-600 text-sm sm:text-base">
                Pilih survei yang ingin Anda isi dari daftar di bawah ini.
            </p>
        </div>

        @if(count($kontenSurveis) > 0)

        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach($kontenSurveis as $konten)
            <article class="card-survei bg-white rounded-2xl overflow-hidden border border-gray-100 shadow-md flex flex-col h-full">
                <!-- CARD HEADER (gradient) -->
                <div class="card-header-gradient px-6 py-5 flex justify-between items-center">
                    <div class="w-11 h-11 rounded-full bg-white/20 flex items-center justify-center">
                        <i data-lucide="file-text" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="text-white font-semibold text-sm bg-white/20 px-3 py-1 rounded-full">
                        {{ $konten->tahun }}
                    </span>
                </div>

                <!-- CARD BODY -->
                <div class="p-6 flex flex-col flex-1">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 leading-snug">
                        {{ $konten->judul }}
                    </h3>
                    <p class="text-gray-600 text-sm leading-relaxed mb-5 flex-1">
                        {{ Str::limit(strip_tags($konten->pendahuluan), 120) }}
                    </p>

                    <div class="flex items-center justify-between gap-4 pt-2 border-t border-gray-100">
                        <span class="flex items-center gap-1.5 text-xs text-gray-500">
                            <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                            ± 5–10 menit
                        </span>
                        <a href="{{ route('survei.create', $konten->id) }}"
                           class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white text-sm font-medium px-5 py-2.5 rounded-full transition-all shadow-sm hover:shadow-md">
                            Mulai Survei
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        @else
        <div class="text-center py-16 sm:py-20 bg-white rounded-2xl border border-gray-100 shadow-sm">
            <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                <i data-lucide="inbox" class="w-8 h-8 text-gray-400"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Survei</h3>
            <p class="text-gray-600 text-sm max-w-sm mx-auto">Saat ini belum ada survei yang tersedia. Silakan cek kembali nanti.</p>
        </div>
        @endif

    </section>

</main>

<script>
    lucide.createIcons();

    @if(session('success'))
    setTimeout(function() {
        var el = document.querySelector('.animate-fade-in');
        if (el) {
            el.style.transition = 'opacity 0.4s ease';
            el.style.opacity = '0';
            setTimeout(function() { el.remove(); }, 400);
        }
    }, 5000);
    @endif
</script>

</body>
</html>