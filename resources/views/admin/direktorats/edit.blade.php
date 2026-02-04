@extends('layouts.admin')

@section('title', 'Edit Direktorat')

@section('page-title', 'Edit Direktorat')
@section('page-description', 'Ubah informasi direktorat')

@section('content')
    <div class="glass-effect rounded-2xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900">Form Edit Direktorat</h3>
        </div>

        <form action="{{ route('admin.direktorats.update', $direktorat) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-6">
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Direktorat</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $direktorat->nama) }}" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white" 
                           placeholder="Masukkan nama direktorat" required>
                    @error('nama')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex items-center">
                        <input id="is_active" name="is_active" type="checkbox" 
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" 
                               {{ old('is_active', $direktorat->is_active) ? 'checked' : '' }}>
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">Aktif</label>
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                <a href="{{ route('admin.direktorats.index') }}"
                   class="px-6 py-2 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white rounded-xl font-medium transition-all duration-200 flex items-center">
                    <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                    Update Direktorat
                </button>
            </div>
        </form>
    </div>
@endsection