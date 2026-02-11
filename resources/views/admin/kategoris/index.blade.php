@extends('layouts.admin')

@section('title', 'Kelola Kategori Pertanyaan')

@section('page-title', 'Kelola Kategori Pertanyaan')
@section('page-description', 'Tambah, edit, atau hapus kategori yang digunakan dalam pertanyaan survei')

@section('content')
    <div class="glass-effect rounded-2xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">Daftar Kategori</h3>
            <a href="{{ route('admin.kategoris.create') }}"
               class="px-4 py-2 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white rounded-xl font-medium transition-all duration-200 flex items-center">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                Tambah Kategori
            </a>
        </div>

        @if ($message = Session::get('success'))
            <div class="mx-6 mt-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-start gap-3">
                <i data-lucide="check-circle" class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5"></i>
                <div>
                    <p class="text-sm font-medium text-green-800">{{ $message }}</p>
                </div>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="mx-6 mt-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
                <i data-lucide="alert-circle" class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5"></i>
                <div>
                    <p class="text-sm font-medium text-red-800">{{ $message }}</p>
                </div>
            </div>
        @endif

        <div class="overflow-x-auto">
            @if ($kategoris->count() > 0)
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">No</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama Kategori</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Urutan</th>
                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($kategoris as $index => $kategori)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ ($kategoris->currentPage() - 1) * $kategoris->perPage() + $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $kategori->nama }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $kategori->deskripsi ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-600">{{ $kategori->urutan }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.kategoris.edit', $kategori) }}"
                                           class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition-colors">
                                            <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
                                            Edit
                                        </a>
                                        <form action="{{ route('admin.kategoris.destroy', $kategori) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="inline-flex items-center px-3 py-1 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition-colors">
                                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $kategoris->links('pagination::tailwind') }}
                </div>
            @else
                <div class="p-8 text-center">
                    <i data-lucide="inbox" class="w-16 h-16 text-gray-300 mx-auto mb-4"></i>
                    <p class="text-gray-500 text-lg">Belum ada kategori</p>
                    <p class="text-gray-400 text-sm mt-1">Mulai dengan membuat kategori baru</p>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>
@endsection
