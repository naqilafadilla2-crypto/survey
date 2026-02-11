@extends('layouts.admin')

@section('title', 'Edit Pertanyaan - ' . $konten_survei->judul)

@section('page-title', 'Edit Pertanyaan')
@section('page-description', $konten_survei->judul . ' - Tahun ' . $konten_survei->tahun)

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container--default .select2-selection--single {
        border: 1px solid #d1d5db;
        border-radius: 0.75rem;
        height: auto;
        padding: 0.5rem 0.25rem;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding: 0.5rem 1rem;
        color: #111827;
    }
    
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }
    
    .select2-dropdown {
        border-radius: 0.75rem;
        border-color: #d1d5db;
    }
    
    .select2-results__option {
        padding: 10px;
    }
    
    .select2-results__option--highlighted {
        background-color: #3b82f6 !important;
    }
</style>
@endpush

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
                            class="select2-kategori w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white" 
                            required>
                        <option value="">Pilih Kategori</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->nama }}" {{ old('kategori', $question->kategori) == $kategori->nama ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                    <div class="mt-2 flex items-center gap-2">
                        <a href="{{ route('admin.kategoris.create') }}" target="_blank" class="text-xs text-blue-600 hover:text-blue-700 font-medium flex items-center gap-1">
                            <i data-lucide="plus" class="w-3 h-3"></i>
                            Tambah kategori baru
                        </a>
                    </div>
                    @error('kategori')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-3">Tipe Pertanyaan</label>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <input type="radio" id="type-scale" name="type" value="scale" 
                                   {{ old('type', $question->type ?? 'scale') === 'scale' ? 'checked' : '' }} 
                                   class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                            <label for="type-scale" class="ml-3 block cursor-pointer">
                                <p class="font-medium text-gray-900">Skala 1 - 5</p>
                                <p class="text-xs text-gray-500">Untuk penilaian dengan skala angka 1 sampai 5</p>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" id="type-choice" name="type" value="choice" 
                                   {{ old('type', $question->type ?? 'scale') === 'choice' ? 'checked' : '' }} 
                                   class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                            <label for="type-choice" class="ml-3 block cursor-pointer">
                                <p class="font-medium text-gray-900">Pilihan (Single Select)</p>
                                <p class="text-xs text-gray-500">Untuk memilih satu opsi saja (radio button)</p>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" id="type-multiple" name="type" value="multiple" 
                                   {{ old('type', $question->type ?? 'scale') === 'multiple' ? 'checked' : '' }} 
                                   class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                            <label for="type-multiple" class="ml-3 block cursor-pointer">
                                <p class="font-medium text-gray-900">Pilihan Multiple (Checkbox)</p>
                                <p class="text-xs text-gray-500">Untuk memilih lebih dari satu opsi (checkbox)</p>
                            </label>
                        </div>
                        <div class="flex items-center">
                            <input type="radio" id="type-text" name="type" value="text" 
                                   {{ old('type', $question->type ?? 'scale') === 'text' ? 'checked' : '' }} 
                                   class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" required>
                            <label for="type-text" class="ml-3 block cursor-pointer">
                                <p class="font-medium text-gray-900">Isian Teks</p>
                                <p class="text-xs text-gray-500">Untuk jawaban yang diketik oleh pegawai sendiri</p>
                            </label>
                        </div>
                    </div>
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
                    $maxOptions = 10;
                @endphp
                <div id="choice-options" class="space-y-3 {{ old('type', $question->type ?? 'scale') === 'choice' || old('type', $question->type ?? 'scale') === 'multiple' ? '' : 'hidden' }}">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Opsi Jawaban (maksimal 10, minimal 2 untuk tipe pilihan)
                    </label>
                    @for($i = 0; $i < $maxOptions; $i++)
                        <input type="text" name="options[]" 
                               value="{{ $existingOptions[$i] ?? '' }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                               placeholder="{{ $i === 0 ? 'Contoh: Ya' : ($i === 1 ? 'Contoh: Tidak' : 'Contoh: Mungkin' . ($i <= 8 ? ' (opsional)' : '')) }}">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize Select2 untuk kategori dengan fitur search
        $('.select2-kategori').select2({
            placeholder: 'Pilih atau ketik kategori...',
            allowClear: true,
            width: '100%',
            language: 'id'
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const typeRadios = document.querySelectorAll('input[name=\"type\"]');
        const choiceOptions = document.getElementById('choice-options');

        function toggleOptions() {
            const selectedType = document.querySelector('input[name=\"type\"]:checked')?.value;
            if (selectedType === 'choice') {
                choiceOptions.classList.remove('hidden');
            } else {
                choiceOptions.classList.add('hidden');
            }
        }

        typeRadios.forEach(radio => {
            radio.addEventListener('change', toggleOptions);
        });
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
