@extends('layouts.admin')

@section('title', 'Edit Pertanyaan - ' . $konten_survei->judul)

@section('page-title', 'Edit Pertanyaan')
@section('page-description', $konten_survei->judul . ' - Tahun ' . $konten_survei->tahun)

@section('content')
    <div class="glass-effect rounded-2xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900">Form Edit Pertanyaan</h3>
        </div>

        <form action="{{ route('admin.konten-survei.questions.update', [$konten_survei, $question]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-6">
                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori Pertanyaan</label>
                    <select id="kategori" name="kategori" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white" 
                            required>
                        <option value="">Pilih Kategori</option>
                        <option value="Pengelolaan Barang Milik Negara (BMN)" {{ old('kategori', $question->kategori) == 'Pengelolaan Barang Milik Negara (BMN)' ? 'selected' : '' }}>Pengelolaan Barang Milik Negara (BMN)</option>
                        <option value="Perencanaan dan Penganggaran" {{ old('kategori', $question->kategori) == 'Perencanaan dan Penganggaran' ? 'selected' : '' }}>Perencanaan dan Penganggaran</option>
                        <option value="Sistem Kearsipan" {{ old('kategori', $question->kategori) == 'Sistem Kearsipan' ? 'selected' : '' }}>Sistem Kearsipan</option>
                        <option value="Layanan Kepegawaian" {{ old('kategori', $question->kategori) == 'Layanan Kepegawaian' ? 'selected' : '' }}>Layanan Kepegawaian</option>
                    </select>
                    @error('kategori')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Tipe Pertanyaan</label>
                    <select id="type" name="type"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white"
                            required>
                        <option value="scale" {{ old('type', $question->type ?? 'scale') === 'scale' ? 'selected' : '' }}>Skala 1 - 5</option>
                        <option value="choice" {{ old('type', $question->type ?? 'scale') === 'choice' ? 'selected' : '' }}>Pilihan (Ya/Tidak, dll)</option>
                        <option value="text" {{ old('type', $question->type ?? 'scale') === 'text' ? 'selected' : '' }}>Isian Teks (diketik pegawai)</option>
                    </select>
                    <p class="mt-2 text-xs text-gray-500">
                        - Pilih <span class="font-semibold">Skala 1 - 5</span> untuk penilaian angka.<br>
                        - Pilih <span class="font-semibold">Pilihan</span> untuk membuat opsi seperti Ya/Tidak.<br>
                        - Pilih <span class="font-semibold">Isian Teks</span> jika pegawai diminta mengetik jawabannya sendiri.
                    </p>
                </div>

                <div>
                    <label for="pertanyaan" class="block text-sm font-medium text-gray-700 mb-2">Pertanyaan</label>
                    <textarea id="pertanyaan" name="pertanyaan" rows="4" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                              placeholder="Masukkan pertanyaan survei..." 
                              required>{{ old('pertanyaan', $question->pertanyaan) }}</textarea>
                    @error('pertanyaan')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                @php
                    $existingOptions = old('options', $question->options ?? []);
                    $maxOptions = 5;
                @endphp
                <div id="choice-options" class="space-y-3 {{ old('type', $question->type ?? 'scale') === 'choice' ? '' : 'hidden' }}">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Opsi Jawaban (maksimal 5, minimal 2 untuk tipe pilihan)
                    </label>
                    @for($i = 0; $i < $maxOptions; $i++)
                        <input type="text" name="options[]" 
                               value="{{ $existingOptions[$i] ?? '' }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="{{ $i === 0 ? 'Contoh: Ya' : ($i === 1 ? 'Contoh: Tidak' : 'Opsi tambahan (opsional)') }}">
                    @endfor
                    @error('options')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="foto" class="block text-sm font-medium text-gray-700 mb-2">
                        Foto Pertanyaan <span class="text-gray-500 font-normal">(Opsional)</span>
                    </label>
                    
                    @if($question->foto)
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Saat Ini:</label>
                            <div class="relative inline-block">
                                <img src="{{ asset('storage/' . $question->foto) }}" alt="Foto pertanyaan" 
                                     class="max-w-xs rounded-xl border border-gray-300 shadow-sm">
                            </div>
                            <div class="mt-2 flex items-center">
                                <input type="checkbox" id="hapus_foto" name="hapus_foto" value="1" 
                                       class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                                <label for="hapus_foto" class="ml-2 block text-sm text-red-600">
                                    Hapus foto ini
                                </label>
                            </div>
                        </div>
                    @endif

                    <input type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white">
                    <p class="mt-2 text-xs text-gray-500">
                        Format yang didukung: JPEG, PNG, JPG, GIF, WEBP. Maksimal ukuran: 2MB
                        @if($question->foto)
                            <br>Upload foto baru untuk mengganti foto yang ada.
                        @endif
                    </p>
                    @error('foto')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    
                    <div id="foto-preview" class="mt-4 hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preview Foto Baru:</label>
                        <div class="relative inline-block">
                            <img id="preview-image" src="" alt="Preview" class="max-w-xs rounded-xl border border-gray-300 shadow-sm">
                        </div>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                <a href="{{ route('admin.konten-survei.questions.index', $konten_survei) }}"
                   class="px-6 py-2 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white rounded-xl font-medium transition-all duration-200 flex items-center">
                    <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                    Update Pertanyaan
                </button>
            </div>
        </form>
    </div>
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const typeSelect = document.getElementById('type');
        const choiceOptions = document.getElementById('choice-options');

        function toggleOptions() {
            if (typeSelect.value === 'choice') {
                choiceOptions.classList.remove('hidden');
            } else {
                choiceOptions.classList.add('hidden');
            }
        }

        typeSelect.addEventListener('change', toggleOptions);
        toggleOptions();

        // Preview foto
        const fotoInput = document.getElementById('foto');
        const fotoPreview = document.getElementById('foto-preview');
        const previewImage = document.getElementById('preview-image');

        if (fotoInput) {
            fotoInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        fotoPreview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                } else {
                    fotoPreview.classList.add('hidden');
                }
            });
        }
    });
</script>
@endpush

@endsection
