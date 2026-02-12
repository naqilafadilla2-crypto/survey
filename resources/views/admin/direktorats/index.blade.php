@extends('layouts.admin')

@section('title', 'Kelola Direktorat')

@section('page-title', 'Direktorat')
@section('page-description', 'Kelola daftar direktorat')

@section('header-actions')
    <a href="{{ route('admin.direktorats.create') }}" 
       class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-medium transition-all duration-200 flex items-center">
        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
        Tambah Direktorat
    </a>
@endsection

@section('content')
    <div class="glass-effect rounded-2xl overflow-hidden border border-gray-100">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <h3 class="text-lg font-semibold text-gray-900">Daftar Direktorat</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Direktorat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($direktorats as $direktorat)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $direktorat->nama }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($direktorat->is_active)
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
                                <a href="{{ route('admin.direktorats.edit', $direktorat) }}" 
                                   class="text-yellow-600 hover:text-yellow-900 inline-flex items-center">
                                    <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
                                    Edit
                                </a>
                                <form action="{{ route('admin.direktorats.destroy', $direktorat) }}" method="POST" class="inline" 
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus direktorat ini?')">
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
                            <i data-lucide="building-2" class="w-12 h-12 mx-auto mb-4 text-gray-300"></i>
                            <p>Belum ada data direktorat.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($direktorats->hasPages())
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $direktorats->links() }}
            </div>
        @endif
    </div>
     <!-- FOOTER -->
    <footer class="bg-gradient-to-r from-indigo-700 to-purple-700 text-white mt-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 py-10">
            <div class="grid md:grid-cols-3 gap-8 text-sm">
                <div>
                    <h3 class="font-semibold mb-3">Alamat Kantor</h3>
                    <p class="text-indigo-100">
                        Centennial Tower Lt. 42-45<br>
                        Jl. Gatot Subroto Kav. 24-25<br>
                        Jakarta 12930
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold mb-3">Kontak</h3>
                    <p class="text-indigo-100">Telepon: (021) 3193 6590</p>
                    <p class="text-indigo-100">
                        Email:
                        <a href="mailto:humas@baktikominfo.id" class="underline hover:text-white">
                            humas@baktikominfo.id
                        </a>
                    </p>
                </div>

                <div>
                    <h3 class="font-semibold mb-3">Jam Operasional</h3>
                    <p class="text-indigo-100">Senin - Jumat</p>
                    <p class="text-indigo-100">08.00 - 17.00 WIB</p>
                    <p class="text-indigo-100">Layanan Online: 24 Jam</p>
                </div>
            </div>

            <div class="border-t border-white/20 mt-8 pt-4 text-center text-xs text-indigo-200">
                © {{ date('Y') }} Simbakti - Bakti Komdigi. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>

@endsection
