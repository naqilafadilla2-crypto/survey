<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Survei - SurveyApp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .question-card {
            transition: all 0.3s ease;
        }
        .question-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }
        .rating-input:checked + label {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .progress-bar {
            transition: width 0.3s ease;
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-purple-50 min-h-screen">
    <!-- Header -->
    <header class="gradient-bg shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('home') }}" class="text-white hover:text-blue-100 transition-colors flex items-center space-x-2">
                    <i data-lucide="arrow-left" class="w-5 h-5"></i>
                    <span>Kembali ke Beranda</span>
                </a>
                <div class="flex items-center space-x-3">
                    <div class="bg-white bg-opacity-20 p-2 rounded-full">
                        <i data-lucide="clipboard-list" class="w-6 h-6 text-white"></i>
                    </div>
                    <span class="text-white font-medium">SurveyApp</span>
                </div>
            </div>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Survey Header -->
        <div class="bg-white rounded-2xl shadow-lg p-8 mb-8 border border-gray-100">
            <div class="text-center mb-6">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full mb-4">
                    <i data-lucide="file-text" class="w-8 h-8 text-white"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">
                    {{ is_object($kontenSurvei) ? $kontenSurvei->judul : $kontenSurvei['judul'] }}
                </h1>
                <p class="text-gray-600">Tahun {{ is_object($kontenSurvei) ? $kontenSurvei->tahun : $kontenSurvei['tahun'] }}</p>
            </div>

            <div class="space-y-6 text-gray-700">
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 border-l-4 border-blue-500 p-6 rounded-r-lg">
                    <div class="flex items-start space-x-3">
                        <i data-lucide="info" class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0"></i>
                        <div>
                            <h3 class="font-semibold text-blue-900 mb-2">Informasi Survei</h3>
                            <div class="whitespace-pre-line text-blue-800 text-sm">
                                {{ is_object($kontenSurvei) ? $kontenSurvei->pendahuluan : $kontenSurvei['pendahuluan'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gradient-to-r from-green-50 to-emerald-50 border-l-4 border-green-500 p-6 rounded-r-lg">
                    <div class="flex items-start space-x-3">
                        <i data-lucide="target" class="w-5 h-5 text-green-600 mt-0.5 flex-shrink-0"></i>
                        <div>
                            <h3 class="font-semibold text-green-900 mb-2">Indikator Pengukuran</h3>
                            <div class="whitespace-pre-line text-green-800 text-sm">
                                {{ is_object($kontenSurvei) ? $kontenSurvei->indikator : $kontenSurvei['indikator'] }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="font-semibold text-gray-900 mb-3 flex items-center">
                        <i data-lucide="list" class="w-5 h-5 mr-2"></i>
                        Tujuan Pengukuran
                    </h3>
                    <ol class="list-decimal list-inside space-y-2 text-gray-700 text-sm">
                        <li>{{ is_object($kontenSurvei) ? $kontenSurvei->tujuan_1 : $kontenSurvei['tujuan_1'] }}</li>
                        <li>{{ is_object($kontenSurvei) ? $kontenSurvei->tujuan_2 : $kontenSurvei['tujuan_2'] }}</li>
                        <li>{{ is_object($kontenSurvei) ? $kontenSurvei->tujuan_3 : $kontenSurvei['tujuan_3'] }}</li>
                    </ol>
                </div>

                <div class="bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-200 p-6 rounded-lg">
                    <div class="flex items-start space-x-3">
                        <i data-lucide="heart" class="w-5 h-5 text-purple-600 mt-0.5 flex-shrink-0"></i>
                        <div class="whitespace-pre-line text-purple-800 text-sm">
                            {{ is_object($kontenSurvei) ? $kontenSurvei->penutup : $kontenSurvei['penutup'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Survey Form -->
        <form action="{{ route('survei.store') }}" method="POST" class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
            @csrf
            <input type="hidden" name="konten_survei_id" value="{{ $kontenSurvei->id }}">
            
            <!-- Pilih Mode Section -->
            <div class="mb-8">
                <div class="flex items-center mb-6">
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-3 rounded-full mr-4">
                        <i data-lucide="settings" class="w-6 h-6 text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900">Pilih Mode</h3>
                        <p class="text-gray-600 text-sm">Pilih mode survei yang sesuai</p>
                    </div>
                </div>

                <div class="flex space-x-4 mb-6">
                    <label class="flex-1">
                        <input type="radio" name="mode" value="public" class="sr-only peer" checked>
                        <div class="p-4 border-2 border-gray-300 rounded-xl cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-50 transition-all">
                            <div class="text-center">
                                <i data-lucide="globe" class="w-8 h-8 text-blue-500 mx-auto mb-2"></i>
                                <div class="font-semibold text-gray-900">Public</div>
                                <div class="text-sm text-gray-600">Selain Pegawai Bakti</div>
                            </div>
                        </div>
                    </label>
                    <label class="flex-1">
                        <input type="radio" name="mode" value="internal" class="sr-only peer">
                        <div class="p-4 border-2 border-gray-300 rounded-xl cursor-pointer peer-checked:border-green-500 peer-checked:bg-green-50 transition-all">
                            <div class="text-center">
                                <i data-lucide="shield" class="w-8 h-8 text-green-500 mx-auto mb-2"></i>
                                <div class="font-semibold text-gray-900">Internal</div>
                                <div class="text-sm text-gray-600">Khusus Pegawai Bakti</div>
                            </div>
                        </div>
                    </label>
                </div>

                <!-- Mode Indicator -->
                <div id="mode-indicator" class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                    <div class="flex items-center space-x-3">
                        <i data-lucide="info" class="w-5 h-5 text-blue-600"></i>
                        <div>
                            <div class="font-semibold text-blue-900">Mode Terpilih: <span id="selected-mode" class="font-bold">Public</span></div>
                            <div id="mode-description" class="text-sm text-blue-700 mt-1">Anda memilih mode Public - hanya mengisi Status Pegawai dan Lama Bekerja</div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Progress Indicator -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-2">
                    <h2 class="text-2xl font-bold text-gray-900">Form Survei</h2>
                    <span class="text-sm text-gray-500">Langkah 1 dari 3</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-2 rounded-full progress-bar" style="width: 33%"></div>
                </div>
            </div>

            <!-- Data Pegawai Section -->
            <div class="mb-8">
                <div class="flex items-center mb-6">
                    <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-3 rounded-full mr-4">
                        <i data-lucide="user" class="w-6 h-6 text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900">Data Pegawai</h3>
                        <p class="text-gray-600 text-sm">Informasi dasar tentang Anda</p>
                    </div>
                </div>

                <!-- Public Mode Fields -->
                <div id="public-fields" class="grid md:grid-cols-2 gap-6" style="display: block;">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700 flex items-center">
                            <i data-lucide="briefcase" class="w-4 h-4 mr-2 text-gray-500"></i>
                            Status Pegawai
                        </label>
                        <select name="status_pegawai" id="public-status-pegawai" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            <option value="">Pilih Status</option>
                            @foreach($statusPegawais as $status)
                                <option value="{{ $status->nama }}" {{ old('status_pegawai') == $status->nama ? 'selected' : '' }}>
                                    {{ $status->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('status_pegawai')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700 flex items-center">
                            <i data-lucide="calendar" class="w-4 h-4 mr-2 text-gray-500"></i>
                            Lama Bekerja
                        </label>
                        <select name="lama_bekerja" id="public-lama-bekerja" required class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            <option value="">Pilih Lama Bekerja</option>
                            @foreach($lamaBekerjas as $lama)
                                <option value="{{ $lama->nama }}" {{ old('lama_bekerja') == $lama->nama ? 'selected' : '' }}>
                                    {{ $lama->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Internal Mode Fields -->
                <div id="internal-fields" class="grid md:grid-cols-2 gap-6" style="display: none;">
                    <div class="space-y-2 md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 flex items-center">
                            <i data-lucide="id-card" class="w-4 h-4 mr-2 text-gray-500"></i>
                            Nama Pegawai <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" id="internal-nama" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="Masukkan nama pegawai">
                        @error('nama')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700 flex items-center">
                            <i data-lucide="building" class="w-4 h-4 mr-2 text-gray-500"></i>
                            Direktorat <span class="text-red-500">*</span>
                        </label>
                        <select name="direktorat" id="internal-direktorat" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            <option value="">Pilih Direktorat</option>
                            @foreach($direktorats as $dir)
                                <option value="{{ $dir->nama }}" {{ old('direktorat') == $dir->nama ? 'selected' : '' }}>
                                    {{ $dir->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('direktorat')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700 flex items-center">
                            <i data-lucide="users" class="w-4 h-4 mr-2 text-gray-500"></i>
                            Divisi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="divisi" id="internal-divisi" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" placeholder="Masukkan nama divisi">
                        @error('divisi')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700 flex items-center">
                            <i data-lucide="briefcase" class="w-4 h-4 mr-2 text-gray-500"></i>
                            Status Pegawai <span class="text-red-500">*</span>
                        </label>
                        <select name="status_pegawai" id="internal-status-pegawai" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            <option value="">Pilih Status</option>
                            @foreach($statusPegawais as $status)
                                <option value="{{ $status->nama }}" {{ old('status_pegawai') == $status->nama ? 'selected' : '' }}>
                                    {{ $status->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('status_pegawai')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700 flex items-center">
                            <i data-lucide="calendar" class="w-4 h-4 mr-2 text-gray-500"></i>
                            Lama Bekerja <span class="text-red-500">*</span>
                        </label>
                        <select name="lama_bekerja" id="internal-lama-bekerja" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                            <option value="">Pilih Lama Bekerja</option>
                            @foreach($lamaBekerjas as $lama)
                                <option value="{{ $lama->nama }}" {{ old('lama_bekerja') == $lama->nama ? 'selected' : '' }}>
                                    {{ $lama->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('lama_bekerja')
                            <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                </div>
            </div>

            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
      

            <!-- Pertanyaan Survei Section -->
            @if(count($questions) > 0)
            <div class="mb-8">
                <div class="flex items-center mb-6">
                    <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-3 rounded-full mr-4">
                        <i data-lucide="clipboard-list" class="w-6 h-6 text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900">Pertanyaan Survei</h3>
                        <p class="text-gray-600 text-sm">Berikan penilaian dari 1 (Sangat Tidak Puas) hingga 5 (Sangat Puas)</p>
                    </div>
                </div>

                @php $questionIndex = 0; @endphp
                @foreach($questions as $kategori => $kategoriQuestions)
                <div class="mb-8">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 p-4 rounded-r-lg mb-4">
                        <h4 class="text-lg font-semibold text-blue-900 flex items-center">
                            <i data-lucide="folder" class="w-5 h-5 mr-2"></i>
                            {{ $kategori }}
                        </h4>
                        <p class="text-blue-700 text-sm mt-1">Jawab semua pertanyaan dalam kategori ini</p>
                    </div>

                    <div class="space-y-6">
                        @foreach($kategoriQuestions as $question)
                        @php $questionIndex++; @endphp
                        <div class="question-card bg-gradient-to-r from-gray-50 to-white border border-gray-200 rounded-xl p-6">
                            <div class="flex items-start space-x-4">
                                <div class="bg-gradient-to-r from-blue-500 to-purple-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold flex-shrink-0">
                                    {{ $questionIndex }}
                                </div>
                                <div class="flex-1">
                                    <h4 class="text-gray-900 font-medium mb-4 leading-relaxed">
                                        {{ $question->pertanyaan }}
                                    </h4>

                                    @if($question->type === 'scale')
                                    <!-- Skala 1-5 -->
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-500 font-medium">Sangat Tidak Puas</span>

                                        <div class="flex items-center space-x-2">
                                            @for($i = 1; $i <= 5; $i++)
                                            <label class="group cursor-pointer">
                                                <input type="radio" name="q{{ $questionIndex }}" value="{{ $i }}" required class="rating-input sr-only peer">
                                                <div class="w-12 h-12 rounded-full border-2 border-gray-300 flex items-center justify-center group-hover:border-blue-400 peer-checked:border-blue-500 peer-checked:bg-gradient-to-r peer-checked:from-blue-500 peer-checked:to-purple-600 peer-checked:text-white transition-all duration-200">
                                                    <span class="text-sm font-semibold">{{ $i }}</span>
                                                </div>
                                            </label>
                                            @endfor
                                        </div>

                                        <span class="text-sm text-gray-500 font-medium">Sangat Puas</span>
                                    </div>

                                    @elseif($question->type === 'choice')
                                    <!-- Radio Button (Single Select) -->
                                    <div class="space-y-2">
                                        @foreach($question->options as $option)
                                        <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-blue-50 transition-colors">
                                            <input type="radio" name="q{{ $questionIndex }}" value="{{ $option }}" required class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                            <span class="ml-3 text-gray-700">{{ $option }}</span>
                                        </label>
                                        @endforeach
                                    </div>

                                    @elseif($question->type === 'multiple')
                                    <!-- Checkbox (Multiple Select) -->
                                    <div class="space-y-2">
                                        @foreach($question->options as $option)
                                        <label class="flex items-center p-3 border border-gray-300 rounded-lg cursor-pointer hover:bg-purple-50 transition-colors">
                                            <input type="checkbox" name="q{{ $questionIndex }}[]" value="{{ $option }}" class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                                            <span class="ml-3 text-gray-700">{{ $option }}</span>
                                        </label>
                                        @endforeach
                                    </div>

                                    @elseif($question->type === 'text')
                                    <!-- Text Input -->
                                    <textarea name="q{{ $questionIndex }}_text" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none" placeholder="Masukkan jawaban Anda di sini..."></textarea>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12 bg-gray-50 rounded-xl">
                <div class="bg-gray-200 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                    <i data-lucide="alert-circle" class="w-8 h-8 text-gray-400"></i>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Pertanyaan</h3>
                <p class="text-gray-600">Belum ada pertanyaan yang tersedia untuk survei ini. Silakan hubungi administrator.</p>
            </div>
            @endif

            <!-- Saran Section -->
            <div class="mb-8">
                <div class="flex items-center mb-6">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-600 p-3 rounded-full mr-4">
                        <i data-lucide="message-square" class="w-6 h-6 text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900">Saran dan Masukan</h3>
                        <p class="text-gray-600 text-sm">Masukan Anda sangat berarti untuk perbaikan layanan</p>
                    </div>
                </div>

                <textarea name="saran" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-all resize-none" placeholder="Masukkan saran dan masukan Anda di sini... (Opsional)"></textarea>
            </div>

            <!-- Submit Section -->
            <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6 border-t border-gray-200">
                <div class="text-sm text-gray-500">
                    Pastikan semua data telah diisi dengan benar
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('home') }}" class="px-6 py-3 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-50 transition-all flex items-center space-x-2">
                        <i data-lucide="x" class="w-4 h-4"></i>
                        <span>Batal</span>
                    </a>
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all flex items-center space-x-2 font-medium shadow-lg">
                        <i data-lucide="send" class="w-4 h-4"></i>
                        <span>Kirim Survei</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        lucide.createIcons();

        // Mode switching functionality
        const modeInputs = document.querySelectorAll('input[name="mode"]');
        const publicFields = document.querySelectorAll('.public-field');
        const internalFields = document.querySelectorAll('.internal-field');
        const publicFieldsDiv = document.getElementById('public-fields');
        const internalFieldsDiv = document.getElementById('internal-fields');
        const sectionTitle = document.getElementById('section-title');
        const sectionDescription = document.getElementById('section-description');

        function updateMode() {
            const selectedMode = document.querySelector('input[name="mode"]:checked').value;
            const modeIndicator = document.getElementById('mode-indicator');
            const selectedModeText = document.getElementById('selected-mode');
            const modeDescription = document.getElementById('mode-description');
            
            if (selectedMode === 'public') {
                // Update indicator for public mode
                modeIndicator.className = 'mt-4 p-4 bg-blue-50 border border-blue-200 rounded-xl';
                selectedModeText.textContent = 'Public';
                modeDescription.textContent = 'Anda memilih mode Public - hanya mengisi Status Pegawai dan Lama Bekerja';
                
                // Show public fields, hide internal fields
                publicFieldsDiv.style.display = 'grid';
                internalFieldsDiv.style.display = 'none';
                
                // Make only public fields required
                document.getElementById('public-status-pegawai').setAttribute('required', 'required');
                document.getElementById('public-lama-bekerja').setAttribute('required', 'required');
                
                // Remove required from internal fields
                document.getElementById('internal-nama').removeAttribute('required');
                document.getElementById('internal-direktorat').removeAttribute('required');
                document.getElementById('internal-divisi').removeAttribute('required');
                document.getElementById('internal-status-pegawai').removeAttribute('required');
                document.getElementById('internal-lama-bekerja').removeAttribute('required');
            } else {
                // Update indicator for internal mode
                modeIndicator.className = 'mt-4 p-4 bg-green-50 border border-green-200 rounded-xl';
                selectedModeText.textContent = 'Internal';
                modeDescription.textContent = 'Anda memilih mode Internal - mengisi semua data pegawai';
                
                // Show internal fields, hide public fields
                publicFieldsDiv.style.display = 'none';
                internalFieldsDiv.style.display = 'grid';
                
                // Remove required from public fields
                document.getElementById('public-status-pegawai').removeAttribute('required');
                document.getElementById('public-lama-bekerja').removeAttribute('required');
                
                // Make all internal fields required
                document.getElementById('internal-nama').setAttribute('required', 'required');
                document.getElementById('internal-direktorat').setAttribute('required', 'required');
                document.getElementById('internal-divisi').setAttribute('required', 'required');
                document.getElementById('internal-status-pegawai').setAttribute('required', 'required');
                document.getElementById('internal-lama-bekerja').setAttribute('required', 'required');
            }
        }

        // Add event listeners to mode buttons
        modeInputs.forEach(input => {
            input.addEventListener('change', updateMode);
        });

        // Initialize on page load
        updateMode();

        // Disable hidden fields before form submission
        document.querySelector('form').addEventListener('submit', function(e) {
            const selectedMode = document.querySelector('input[name="mode"]:checked').value;
            
            if (selectedMode === 'public') {
                // Disable internal fields
                document.getElementById('internal-nama').disabled = true;
                document.getElementById('internal-direktorat').disabled = true;
                document.getElementById('internal-divisi').disabled = true;
                document.getElementById('internal-status-pegawai').disabled = true;
                document.getElementById('internal-lama-bekerja').disabled = true;
            } else {
                // Disable public fields
                document.getElementById('public-status-pegawai').disabled = true;
                document.getElementById('public-lama-bekerja').disabled = true;
            }
        });

        // Add some interactive effects
        document.querySelectorAll('.rating-input').forEach(input => {
            input.addEventListener('change', function() {
                // Remove selected state from siblings
                const siblings = this.closest('.question-card').querySelectorAll('.rating-input');
                siblings.forEach(sib => {
                    const label = sib.nextElementSibling;
                    if (sib !== this) {
                        label.classList.remove('ring-2', 'ring-blue-500');
                    }
                });

                // Add selected state to current
                const label = this.nextElementSibling;
                label.classList.add('ring-2', 'ring-blue-500');
            });
        });
    </script>
</body>
</html>
