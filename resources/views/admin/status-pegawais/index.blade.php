@extends('layouts.admin')

@section('title', 'Status Pegawai')

@section('page-title', 'Status Pegawai')
@section('page-description', 'Kelola opsi status pegawai')

@section('header-actions')
    <a href="{{ route('admin.status-pegawais.create') }}" 
       class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-medium transition-all duration-200 flex items-center">
        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
        Tambah Status
    </a>
@endsection

@section('content')
    <div class="glass-effect rounded-2xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900">Daftar Status Pegawai</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($statusPegawais as $status)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $status->nama }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($status->is_active)
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i>
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <i data-lucide="x-circle" class="w-3 h-3 mr-1"></i>
                                    Tidak Aktif
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.status-pegawais.show', $status) }}" 
                                   class="text-blue-600 hover:text-blue-900 inline-flex items-center">
                                    <i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                                    Lihat
                                </a>
                                <a href="{{ route('admin.status-pegawais.edit', $status) }}" 
                                   class="text-yellow-600 hover:text-yellow-900 inline-flex items-center">
                                    <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
                                    Edit
                                </a>
                                <form action="{{ route('admin.status-pegawais.destroy', $status) }}" method="POST" class="inline" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus status ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 inline-flex items-center">
                                        <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center text-gray-500">
                            <i data-lucide="badge-check" class="w-12 h-12 mx-auto mb-4 text-gray-300"></i>
                            <p>Belum ada data status pegawai</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
