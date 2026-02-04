@extends('layouts.admin')

@section('title', 'Edit Konten Survei')

@section('page-title', 'Edit Konten Survei')
@section('page-description', 'Ubah informasi konten survei')

@section('content')
    <div class="glass-effect rounded-2xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900">Form Edit Konten Survei</h3>
        </div>

        <form action="{{ route('admin.konten-survei.update', $kontenSurvei->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-6">
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Survei</label>
                    <input type="text" id="judul" name="judul" value="{{ old('judul', $kontenSurvei->judul) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white" 
                           required>
                    @error('judul')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="pendahuluan" class="block text-sm font-medium text-gray-700 mb-2">Pendahuluan</label>
                    <textarea id="pendahuluan" name="pendahuluan" rows="4" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                              required>{{ old('pendahuluan', $kontenSurvei->pendahuluan) }}</textarea>
                    @error('pendahuluan')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="indikator" class="block text-sm font-medium text-gray-700 mb-2">Indikator</label>
                    <textarea id="indikator" name="indikator" rows="3" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                              required>{{ old('indikator', $kontenSurvei->indikator) }}</textarea>
                    @error('indikator')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="deskripsi_survei" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Survei</label>
                    <textarea id="deskripsi_survei" name="deskripsi_survei" rows="4" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                              required>{{ old('deskripsi_survei', $kontenSurvei->deskripsi_survei) }}</textarea>
                    @error('deskripsi_survei')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="tujuan_1" class="block text-sm font-medium text-gray-700 mb-2">Tujuan 1</label>
                        <textarea id="tujuan_1" name="tujuan_1" rows="2" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                  required>{{ old('tujuan_1', $kontenSurvei->tujuan_1) }}</textarea>
                        @error('tujuan_1')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tujuan_2" class="block text-sm font-medium text-gray-700 mb-2">Tujuan 2</label>
                        <textarea id="tujuan_2" name="tujuan_2" rows="2" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                  required>{{ old('tujuan_2', $kontenSurvei->tujuan_2) }}</textarea>
                        @error('tujuan_2')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tujuan_3" class="block text-sm font-medium text-gray-700 mb-2">Tujuan 3</label>
                        <textarea id="tujuan_3" name="tujuan_3" rows="2" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                                  required>{{ old('tujuan_3', $kontenSurvei->tujuan_3) }}</textarea>
                        @error('tujuan_3')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="penutup" class="block text-sm font-medium text-gray-700 mb-2">Penutup</label>
                    <textarea id="penutup" name="penutup" rows="3" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                              required>{{ old('penutup', $kontenSurvei->penutup) }}</textarea>
                    @error('penutup')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                        <input type="number" id="tahun" name="tahun" value="{{ old('tahun', $kontenSurvei->tahun) }}" 
                               min="2000" max="2100" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white" 
                               required>
                        @error('tahun')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center pt-8">
                        <input type="checkbox" id="is_active" name="is_active" value="1" 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                               {{ old('is_active', $kontenSurvei->is_active) ? 'checked' : '' }}>
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">
                            Tampilkan konten survei ini di halaman utama (aktif)
                        </label>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                <a href="{{ route('admin.konten-survei.index') }}"
                   class="px-6 py-2 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white rounded-xl font-medium transition-all duration-200 flex items-center">
                    <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                    Update Konten Survei
                </button>
            </div>
        </form>
    </div>
@endsection
