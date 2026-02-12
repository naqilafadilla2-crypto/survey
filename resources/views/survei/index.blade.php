<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - SimBakti</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Lucide Icons -->
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
        }
        html { scroll-behavior: smooth; }
    </style>
</head>

<body class="min-h-screen bg-[#fafbff] text-gray-900 antialiased flex flex-col">
<!-- ================= HEADER ================= -->
<header class="gradient-bg shadow-md">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-4 flex justify-between items-center">

        <!-- LEFT SECTION -->
        <div class="flex items-center gap-4">

            <!-- HAPUS BAGIAN ICON LINGKARAN BIRU DI SINI -->

            <!-- Logo + Text -->
            <div class="flex items-center gap-3">
                <img src="{{ asset('assets/logo.png') }}" 
                     alt="Logo SimBakti" 
                     class="w-10 h-10 object-contain">

                <div>
                    <h1 class="text-xl sm:text-2xl font-bold text-white">
                        SimBakti
                    </h1>
                    <p class="text-blue-100 text-sm">
                        Aplikasi Survei Kepuasan Bakti Komdigi
                    </p>
                </div>
            </div>

        </div>

        <!-- RIGHT SECTION -->
        <a href="{{ route('admin.login') }}"
           class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 text-white px-5 py-2.5 rounded-full font-medium transition">
            <i data-lucide="shield" class="w-5 h-5"></i>
            Admin Login
        </a>

    </div>
</header>



<!-- ================= MAIN CONTENT ================= -->
<main class="flex-grow max-w-6xl mx-auto px-4 sm:px-6 py-12">

    <!-- HERO -->
    <section class="text-center mb-14">
        <h2 class="text-3xl sm:text-4xl font-bold mb-4">
            Selamat Datang di <span class="text-gradient">SimBakti</span>
        </h2>
        <p class="text-gray-600 max-w-2xl mx-auto">
            Platform survei modern untuk mengukur kepuasan karyawan terhadap layanan pengelolaan Barang Milik Negara (BMN).
        </p>
    </section>

    <!-- LIST SURVEI -->
    @if(count($kontenSurveis) > 0)
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach($kontenSurveis as $konten)
        <div class="card-survei bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden flex flex-col">

            <!-- CARD HEADER -->
            <div class="card-header-gradient px-6 py-5 flex justify-between items-center">
                <i data-lucide="file-text" class="w-6 h-6 text-white"></i>
                <span class="text-white text-sm bg-white/20 px-3 py-1 rounded-full">
                    {{ $konten->tahun }}
                </span>
            </div>

            <!-- CARD BODY -->
            <div class="p-6 flex flex-col flex-grow">
                <h3 class="text-lg font-bold mb-2">
                    {{ $konten->judul }}
                </h3>

                <p class="text-gray-600 text-sm flex-grow mb-6">
                    {{ \Illuminate\Support\Str::limit(strip_tags($konten->pendahuluan), 120) }}
                </p>

                <a href="{{ route('survei.create', $konten->id) }}"
                   class="inline-flex justify-center items-center gap-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-5 py-2.5 rounded-full text-sm font-medium transition">
                    Mulai Survei
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
        @endforeach

    </div>
    @else
    <div class="text-center py-20 bg-white rounded-2xl shadow-sm border">
        <i data-lucide="inbox" class="w-12 h-12 text-gray-400 mx-auto mb-4"></i>
        <h3 class="text-xl font-semibold mb-2">Belum Ada Survei</h3>
        <p class="text-gray-600 text-sm">Saat ini belum ada survei yang tersedia.</p>
    </div>
    @endif

</main>


<!-- ================= FOOTER ================= -->
<footer class="bg-gradient-to-r from-indigo-700 to-purple-700 text-white mt-16">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 py-10">

        <div class="grid md:grid-cols-3 gap-8 text-sm">

            <div>
                <h3 class="font-semibold mb-3">Alamat Kantor</h3>
                <p class="text-indigo-100">
                    Centennial Tower Lt. 42-45<br>
                    Jl. Gatot Subroto Kav. 24-25<br>
                    Jakarta 12930
                </p>
            </div>

            <div>
                <h3 class="font-semibold mb-3">Kontak</h3>
                <p class="text-indigo-100">Telepon: (021) 3193 6590</p>
                <p class="text-indigo-100">
                    Email:
                    <a href="mailto:humas@baktikominfo.id" class="underline hover:text-white">
                        humas@baktikominfo.id
                    </a>
                </p>
            </div>

            <div>
                <h3 class="font-semibold mb-3">Jam Operasional</h3>
                <p class="text-indigo-100">Senin - Jumat</p>
                <p class="text-indigo-100">08.00 - 17.00 WIB</p>
                <p class="text-indigo-100">Layanan Online: 24 Jam</p>
            </div>

        </div>

        <div class="border-t border-white/20 mt-8 pt-4 text-center text-xs text-indigo-200">
            © {{ date('Y') }} SurveyApp - Bakti Komdigi. All rights reserved.
        </div>

    </div>
</footer>


<!-- ================= SCRIPT ================= -->
<script>
    lucide.createIcons();
</script>

</body>
</html>
