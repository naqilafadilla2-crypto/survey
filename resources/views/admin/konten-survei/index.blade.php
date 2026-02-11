@extends('layouts.admin')

@section('title', 'Kelola Konten Survei')

@section('page-title', 'Konten Survei')
@section('page-description', 'Kelola konten survei dan pertanyaan yang tersedia')

@section('header-actions')
    <a href="{{ route('admin.konten-survei.create') }}"
       class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 shadow-lg hover:shadow-xl transition-all duration-200">
        <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
        Tambah Konten
    </a>
@endsection

@section('content')
    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 rounded-2xl p-4">
            <div class="flex gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5"></i>
                <div>
                    <p class="text-green-900 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if($kontenSurveis->count() > 0)
    <!-- Konten Cards Grid -->
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @foreach($kontenSurveis as $konten)
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 card-hover overflow-hidden">
            <!-- Card Header -->
            <div class="p-6 border-b border-gray-100">
                <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                        <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">{{ $konten->judul }}</h3>
                        <div class="flex items-center space-x-2 mb-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                <i data-lucide="calendar" class="w-4 h-4 mr-1"></i>
                                {{ $konten->tahun }}
                            </span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $konten->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                <i data-lucide="circle" class="w-3 h-3 mr-1 {{ $konten->is_active ? 'fill-green-500 text-green-500' : 'fill-red-500 text-red-500' }}"></i>
                                {{ $konten->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </div>
                    </div>
                    <div class="ml-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl flex items-center justify-center">
                            <i data-lucide="file-text" class="w-6 h-6 text-white"></i>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                    {{ \Illuminate\Support\Str::limit($konten->pendahuluan, 120) }}
                </p>

                <!-- Stats -->
                <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                    <span class="flex items-center">
                        <i data-lucide="help-circle" class="w-4 h-4 mr-1"></i>
                        {{ $konten->questions()->count() }} pertanyaan
                    </span>
                    <span class="flex items-center">
                        <i data-lucide="clock" class="w-4 h-4 mr-1"></i>
                        {{ $konten->updated_at->diffForHumans() }}
                    </span>
                </div>
            </div>

            <!-- Card Actions -->
            <div class="p-6 bg-gray-50">
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.konten-survei.questions.index', $konten) }}"
                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-green-700 bg-green-100 rounded-lg hover:bg-green-200 transition-colors">
                        <i data-lucide="clipboard-list" class="w-4 h-4 mr-2"></i>
                        Kelola Soal
                    </a>

                    <a href="{{ route('admin.konten-survei.edit', $konten->id) }}"
                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-700 bg-blue-100 rounded-lg hover:bg-blue-200 transition-colors">
                        <i data-lucide="edit" class="w-4 h-4 mr-2"></i>
                        Edit
                    </a>

                    <form action="{{ route('admin.konten-survei.toggle-status', $konten->id) }}" method="POST" class="inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-lg transition-colors {{ $konten->is_active ? 'text-orange-700 bg-orange-100 hover:bg-orange-200' : 'text-green-700 bg-green-100 hover:bg-green-200' }}">
                            <i data-lucide="{{ $konten->is_active ? 'eye-off' : 'eye' }}" class="w-4 h-4 mr-2"></i>
                            {{ $konten->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                        </button>
                    </form>
                </div>

                <div class="mt-3 pt-3 border-t border-gray-200">
                    <form action="{{ route('admin.konten-survei.destroy', $konten->id) }}" method="POST" class="inline"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus konten survei ini? Semua data terkait akan hilang.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-700 bg-red-100 rounded-lg hover:bg-red-200 transition-colors">
                            <i data-lucide="trash-2" class="w-4 h-4 mr-2"></i>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <!-- Empty State -->
    <div class="glass-effect rounded-2xl border border-gray-100 p-12 text-center">
        <div class="w-24 h-24 bg-gradient-to-r from-blue-100 to-purple-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <i data-lucide="file-x" class="w-12 h-12 text-gray-400"></i>
        </div>
        <h3 class="text-2xl font-bold text-gray-900 mb-4">Belum ada konten survei</h3>
        <p class="text-gray-600 mb-8 max-w-md mx-auto">
            Mulai buat konten survei pertama Anda untuk mengumpulkan feedback dari pengguna.
        </p>
        <a href="{{ route('admin.konten-survei.create') }}"
           class="inline-flex items-center px-8 py-4 border border-transparent text-lg font-medium rounded-xl text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 shadow-lg hover:shadow-xl transition-all duration-200">
            <i data-lucide="plus" class="w-6 h-6 mr-3"></i>
            Buat Konten Survei Pertama
        </a>
    </div>
    @endif
@endsection
