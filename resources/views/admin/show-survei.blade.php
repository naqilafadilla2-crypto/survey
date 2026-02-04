<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Survei - Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">← Kembali ke Dashboard</a>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Detail Survei</h1>

                <!-- Informasi Survei -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 p-6 mb-6 rounded-r-lg">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-semibold text-gray-900">Informasi Survei</h2>
                        @if($survei->mode === 'public')
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-blue-100 text-blue-800 border border-blue-200">
                                <i data-lucide="globe" class="w-4 h-4 mr-2"></i>
                                Mode Public
                            </span>
                        @else
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800 border border-green-200">
                                <i data-lucide="shield" class="w-4 h-4 mr-2"></i>
                                Mode Internal
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Informasi Pegawai -->
                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Informasi Pegawai</h2>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <span class="text-sm font-medium text-gray-600">Nama Pegawai:</span>
                            <p class="text-gray-900 font-semibold text-lg">{{ $survei->pegawai->nama ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-600">Direktorat:</span>
                            <p class="text-gray-900">{{ str_replace('_', ' ', $survei->pegawai->direktorat) }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-600">Divisi:</span>
                            <p class="text-gray-900">{{ $survei->pegawai->divisi }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-600">Status Pegawai:</span>
                            <p class="text-gray-900">{{ $survei->pegawai->status_pegawai }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-600">Lama Bekerja:</span>
                            <p class="text-gray-900">{{ str_replace('_', ' ', $survei->pegawai->lama_bekerja) }}</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-600">Tanggal Survei:</span>
                            <p class="text-gray-900">{{ $survei->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Rata-rata Skor -->
                <div class="bg-blue-50 border-l-4 border-blue-500 p-6 mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Rata-rata Skor</h2>
                    <p class="text-3xl font-bold text-blue-600">{{ $rataRata }} / 5.00</p>
                    @php
                        $totalPertanyaanNumerik = $questions->flatten()->filter(fn($q) => ($q->type ?? 'scale') !== 'text')->count();
                    @endphp
                    <p class="text-sm text-gray-600 mt-2">Dari {{ $totalPertanyaanNumerik }} pertanyaan skala</p>
                </div>

                <!-- Detail Jawaban -->
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Detail Jawaban</h2>
                    @php $questionIndex = 0; @endphp
                    @foreach($questions as $kategori => $kategoriQuestions)
                    <div class="mb-6">
                        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 p-4 rounded-r-lg mb-4">
                            <h3 class="text-lg font-semibold text-blue-900">{{ $kategori }}</h3>
                        </div>

                        <div class="space-y-4 ml-4">
                            @foreach($kategoriQuestions as $question)
                            @php
                                $questionIndex++;
                                $type = $question->type ?? 'scale';
                                $key = 'q' . $questionIndex;
                                $answers = $survei->answers ?? [];
                            @endphp
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="mb-3">
                                    <span class="text-sm font-medium text-gray-700">{{ $question->pertanyaan }}</span>
                                    
                                    @if($question->foto)
                                        <div class="mt-3">
                                            <img src="{{ asset('storage/' . $question->foto) }}" 
                                                 alt="Foto pertanyaan" 
                                                 class="max-w-md rounded-lg border border-gray-200 shadow-sm">
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="flex justify-between items-center mb-2">

                                    @if($type === 'text')
                                        <span class="text-xs px-2 py-1 rounded-full bg-purple-100 text-purple-700 font-semibold">Isian Teks</span>
                                    @else
                                        <span class="text-lg font-bold text-blue-600">
                                            {{ $survei->{$key} }} / 5
                                        </span>
                                    @endif
                                </div>

                                @if($type === 'text')
                                    <div class="mt-2 bg-gray-50 rounded-lg p-3">
                                        <p class="text-sm text-gray-700">
                                            {{ $answers[$key] ?? '-' }}
                                        </p>
                                    </div>
                                @else
                                    <div class="mt-2">
                                        <div class="w-full bg-gray-200 rounded-full h-2">
                                            <div class="bg-blue-600 h-2 rounded-full"
                                                 style="width: {{ max(0, min(100, ($survei->{$key} / 5) * 100)) }}%">
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Saran -->
                @if(!empty($survei->saran))
                <div class="border-t border-gray-200 pt-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-4">Saran dan Masukan</h2>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-700">{{ $survei->saran }}</p>
                    </div>
                </div>
                @endif

                <!-- Tombol Aksi -->
                <div class="mt-6 flex justify-end gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
