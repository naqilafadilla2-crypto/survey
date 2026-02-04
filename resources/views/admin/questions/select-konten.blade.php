@extends('layouts.admin')

@section('title', 'Pertanyaan')

@section('page-title', 'Pertanyaan')
@section('page-description', 'Kelola pertanyaan untuk setiap konten survei')

@section('header-actions')
    <a href="{{ route('admin.konten-survei.create') }}" 
       class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-medium transition-all duration-200 flex items-center">
        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
        Tambah Konten
    </a>
@endsection

@section('content')
    @if($kontenSurveis->count() > 0)
    <div class="glass-effect rounded-2xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900">Daftar Konten Survei</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Konten</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Pertanyaan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($kontenSurveis as $konten)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $konten->judul }}</div>
                            <div class="text-sm text-gray-500 mt-1 line-clamp-2">{{ \Illuminate\Support\Str::limit($konten->pendahuluan, 80) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                                {{ $konten->tahun }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($konten->is_active)
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
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900 flex items-center">
                                <i data-lucide="help-circle" class="w-4 h-4 mr-2 text-gray-400"></i>
                                {{ $konten->questions()->count() }} pertanyaan
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.konten-survei.questions.index', $konten) }}"
                               class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 text-white rounded-lg transition-all duration-200">
                                <i data-lucide="clipboard-list" class="w-4 h-4 mr-2"></i>
                                Kelola
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <!-- Empty State -->
    <div class="glass-effect rounded-2xl border border-gray-100 p-12 text-center">
        <div class="w-24 h-24 bg-gradient-to-r from-green-100 to-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i data-lucide="file-x" class="w-12 h-12 text-gray-400"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum ada konten survei</h3>
        <p class="text-gray-600 mb-8 max-w-md mx-auto">
            Buat konten survei terlebih dahulu sebelum dapat mengelola pertanyaan.
        </p>
        <a href="{{ route('admin.konten-survei.create') }}"
           class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-medium rounded-xl text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 shadow-lg hover:shadow-xl transition-all duration-200">
            <i data-lucide="plus" class="w-6 h-6 mr-3"></i>
            Buat Konten Survei
        </a>
    </div>
    @endif
@endsection
