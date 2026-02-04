@extends('layouts.admin')

@section('title', 'Edit Pegawai')

@section('page-title', 'Edit Pegawai')
@section('page-description', 'Ubah informasi pegawai')

@section('content')
    <div class="glass-effect rounded-2xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900">Form Edit Pegawai</h3>
        </div>

        <form action="{{ route('admin.pegawais.update', $pegawai) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Pegawai</label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $pegawai->nama) }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white" 
                               placeholder="Masukkan nama pegawai" required>
                        @error('nama')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="direktorat" class="block text-sm font-medium text-gray-700 mb-2">Direktorat</label>
                        <select id="direktorat" name="direktorat" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white" 
                                required>
                            <option value="">Pilih Direktorat</option>
                            @foreach($direktorats as $dir)
                                <option value="{{ $dir->nama }}" {{ old('direktorat', $pegawai->direktorat) == $dir->nama ? 'selected' : '' }}>{{ $dir->nama }}</option>
                            @endforeach
                        </select>
                        @error('direktorat')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="divisi" class="block text-sm font-medium text-gray-700 mb-2">Divisi</label>
                        <input type="text" id="divisi" name="divisi" value="{{ old('divisi', $pegawai->divisi) }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white" 
                               placeholder="Masukkan nama divisi" required>
                        @error('divisi')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="status_pegawai" class="block text-sm font-medium text-gray-700 mb-2">Status Pegawai</label>
                        <select id="status_pegawai" name="status_pegawai" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white" 
                                required>
                            <option value="">Pilih Status</option>
                            @foreach($statusPegawais as $status)
                                <option value="{{ $status->nama }}" {{ old('status_pegawai', $pegawai->status_pegawai) == $status->nama ? 'selected' : '' }}>{{ $status->nama }}</option>
                            @endforeach
                        </select>
                        @error('status_pegawai')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="lama_bekerja" class="block text-sm font-medium text-gray-700 mb-2">Lama Bekerja</label>
                        <select id="lama_bekerja" name="lama_bekerja" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-white" 
                                required>
                            <option value="">Pilih Lama Bekerja</option>
                            @foreach($lamaBekerjas as $lama)
                                <option value="{{ $lama->nama }}" {{ old('lama_bekerja', $pegawai->lama_bekerja) == $lama->nama ? 'selected' : '' }}>{{ $lama->nama }}</option>
                            @endforeach
                        </select>
                        @error('lama_bekerja')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
                <a href="{{ route('admin.pegawais.index') }}"
                   class="px-6 py-2 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 transition-colors">
                    Batal
                </a>
                <button type="submit" 
                        class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white rounded-xl font-medium transition-all duration-200 flex items-center">
                    <i data-lucide="save" class="w-4 h-4 mr-2"></i>
                    Update Pegawai
                </button>
            </div>
        </form>
    </div>
@endsection