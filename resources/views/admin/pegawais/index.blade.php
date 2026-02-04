@extends('layouts.admin')

@section('title', 'Kelola Pegawai')

@section('page-title', 'Pegawai')
@section('page-description', 'Kelola data pegawai')

@section('header-actions')
    <a href="{{ route('admin.pegawais.create') }}" 
       class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-medium transition-all duration-200 flex items-center">
        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
        Tambah Pegawai
    </a>
@endsection

@section('content')
    <div class="glass-effect rounded-2xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900">Daftar Pegawai</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Direktorat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Divisi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lama Bekerja</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($pegawais as $pegawai)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $pegawai->nama ?? 'Tanpa Nama' }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $pegawai->direktorat }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $pegawai->divisi }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $pegawai->status_pegawai }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">{{ $pegawai->lama_bekerja }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.pegawais.show', $pegawai) }}" 
                                   class="text-blue-600 hover:text-blue-900 inline-flex items-center">
                                    <i data-lucide="eye" class="w-4 h-4 mr-1"></i>
                                    Lihat
                                </a>
                                <a href="{{ route('admin.pegawais.edit', $pegawai) }}" 
                                   class="text-yellow-600 hover:text-yellow-900 inline-flex items-center">
                                    <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
                                    Edit
                                </a>
                                <form action="{{ route('admin.pegawais.destroy', $pegawai) }}" method="POST" class="inline" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pegawai ini?')">
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
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            <i data-lucide="users" class="w-12 h-12 mx-auto mb-4 text-gray-300"></i>
                            <p>Belum ada data pegawai.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pegawais->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $pegawais->links() }}
            </div>
        @endif
    </div>
@endsection
