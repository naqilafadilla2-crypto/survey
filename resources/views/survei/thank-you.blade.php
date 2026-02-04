<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terima Kasih - SurveyApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        @keyframes scale-in {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
        .animate-scale-in {
            animation: scale-in 0.8s ease-out;
        }
        .pulse-animation {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-purple-50 min-h-screen">
    <div class="min-h-screen flex items-center justify-center px-4 py-8">
        <div class="max-w-2xl w-full animate-fade-in">
            <!-- Success Card -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
                <!-- Header Gradient -->
                <div class="gradient-bg px-8 py-12 text-center">
                    <div class="animate-scale-in">
                        <div class="bg-white/20 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6 pulse-animation">
                            <i data-lucide="check-circle" class="w-16 h-16 text-white"></i>
                        </div>
                        <h1 class="text-4xl font-bold text-white mb-3">Terima Kasih!</h1>
                        <p class="text-blue-100 text-lg">Terima kasih telah mengisi survei</p>
                    </div>
                </div>

                <!-- Content -->
                <div class="px-8 py-10 text-center">
                    <div class="mb-8">
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 rounded-2xl p-6 border border-green-200">
                            <div class="flex items-center justify-center mb-4">
                                <div class="bg-green-500 rounded-full p-4">
                                    <i data-lucide="heart" class="w-10 h-10 text-white"></i>
                                </div>
                            </div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-3">
                                Survei Berhasil Dikirim
                            </h2>
                            <p class="text-gray-700 text-lg mb-2">
                                Partisipasi Anda sangat berarti bagi kami
                            </p>
                            <p class="text-gray-600">
                                Masukan Anda akan membantu kami meningkatkan kualitas layanan
                            </p>
                        </div>
                    </div>

                    <!-- Countdown -->
                    <div class="mb-8">
                        <div class="inline-flex items-center gap-3 bg-blue-50 rounded-full px-6 py-3 border border-blue-200">
                            <i data-lucide="clock" class="w-5 h-5 text-blue-600"></i>
                            <span class="text-blue-800 font-medium">
                                Kembali ke halaman utama dalam <span id="countdown" class="font-bold text-blue-900">5</span> detik
                            </span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('survei.index') }}" 
                           class="px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white rounded-xl font-semibold transition-all duration-200 flex items-center justify-center gap-2 shadow-lg">
                            <i data-lucide="home" class="w-5 h-5"></i>
                            Kembali ke Beranda
                        </a>
                        <a href="{{ route('survei.index') }}" 
                           class="px-8 py-4 border-2 border-gray-300 hover:border-gray-400 text-gray-700 rounded-xl font-semibold transition-all duration-200 flex items-center justify-center gap-2">
                            <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                            Lihat Survei Lainnya
                        </a>
                    </div>
                </div>
            </div>

            <!-- Footer Info -->
            <div class="mt-8 text-center">
                <p class="text-gray-500 text-sm">
                    <i data-lucide="shield-check" class="w-4 h-4 inline mr-1"></i>
                    Data Anda aman dan akan digunakan untuk perbaikan layanan
                </p>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        // Countdown timer
        let countdown = 5;
        const countdownElement = document.getElementById('countdown');
        const countdownInterval = setInterval(function() {
            countdown--;
            if (countdownElement) {
                countdownElement.textContent = countdown;
            }
            
            if (countdown <= 0) {
                clearInterval(countdownInterval);
                window.location.href = '{{ route("survei.index") }}';
            }
        }, 1000);
    </script>
</body>
</html>
