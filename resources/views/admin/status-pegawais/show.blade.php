@extends('layouts.admin')

@section('title', 'Detail Status Pegawai')

@section('page-title', 'Detail Status Pegawai')
@section('page-description', 'Informasi lengkap status pegawai')

@section('content')
    <div class="glass-effect rounded-2xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900">Informasi Status Pegawai</h3>
        </div>

        <div class="p-6">
            <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <dt class="text-sm font-medium text-gray-500 mb-2">Nama Status Pegawai</dt>
                    <dd class="text-base font-semibold text-gray-900">{{ $statusPegawai->nama }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 mb-2">Status</dt>
                    <dd>
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $statusPegawai->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $statusPegawai->is_active ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 mb-2">Dibuat Pada</dt>
                    <dd class="text-base text-gray-900">{{ $statusPegawai->created_at->format('d M Y, H:i') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500 mb-2">Diupdate Pada</dt>
                    <dd class="text-base text-gray-900">{{ $statusPegawai->updated_at->format('d M Y, H:i') }}</dd>
                </div>
            </dl>
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end gap-3">
            <a href="{{ route('admin.status-pegawais.index') }}"
               class="px-6 py-2 border border-gray-300 rounded-xl text-gray-700 hover:bg-gray-100 transition-colors">
                Kembali
            </a>
            <a href="{{ route('admin.status-pegawais.edit', $statusPegawai) }}"
               class="px-6 py-2 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white rounded-xl font-medium transition-all duration-200 flex items-center">
                <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                Edit Status Pegawai
            </a>
        </div>
    </div>
@endsection