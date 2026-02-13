@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('page-title', 'Dashboard')
@section('page-description', 'Selamat datang di panel admin')

@section('content')

    <!-- MENU CARD -->
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <a href="{{ route('admin.konten-survei.index') }}" class="glass-effect rounded-2xl p-6 card-hover">
            <div class="flex items-center gap-4">
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-3 rounded-full">
                    <i data-lucide="file-text" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <p class="font-semibold">Konten Survei</p>
                    <p class="text-sm text-gray-600">Kelola konten</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.konten-survei.questions.select') }}" class="glass-effect rounded-2xl p-6 card-hover">
            <div class="flex items-center gap-4">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-3 rounded-full">
                    <i data-lucide="clipboard-list" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <p class="font-semibold">Pertanyaan</p>
                    <p class="text-sm text-gray-600">Kelola soal</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.pegawais.index') }}" class="glass-effect rounded-2xl p-6 card-hover">
            <div class="flex items-center gap-4">
                <div class="bg-gradient-to-r from-purple-500 to-pink-600 p-3 rounded-full">
                    <i data-lucide="users" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <p class="font-semibold">Pegawai</p>
                    <p class="text-sm text-gray-600">Data pegawai</p>
                </div>
            </div>
        </a>

        <a href="{{ route('admin.laporan.index') }}" class="glass-effect rounded-2xl p-6 card-hover">
            <div class="flex items-center gap-4">
                <div class="bg-gradient-to-r from-orange-500 to-red-600 p-3 rounded-full">
                    <i data-lucide="bar-chart-3" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <p class="font-semibold">Laporan</p>
                    <p class="text-sm text-gray-600">Analisis</p>
                </div>
            </div>
        </a>
    </div>

    <!-- QUICK MANAGE DATA PEGAWAI -->
    <div class="glass-effect rounded-2xl p-6 mb-8 border border-gray-100">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center gap-2">
                <i data-lucide="settings" class="w-5 h-5 text-indigo-600"></i>
                <h3 class="text-lg font-semibold text-gray-900">Pengaturan Data Pegawai</h3>
            </div>
            <span class="text-xs text-gray-500">Kelola opsi yang tampil di form survei</span>
        </div>

        <div class="grid md:grid-cols-3 gap-4">
            <a href="{{ route('admin.direktorats.index') }}" class="glass-effect rounded-xl p-4 border border-gray-100 hover:border-indigo-200 transition-all">
                <div class="flex items-center gap-3">
                    <div class="bg-indigo-100 p-2 rounded-lg">
                        <i data-lucide="building-2" class="w-5 h-5 text-indigo-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Direktorat</p>
                        <p class="text-xs text-gray-500">Kelola daftar direktorat</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.status-pegawais.index') }}" class="glass-effect rounded-xl p-4 border border-gray-100 hover:border-indigo-200 transition-all">
                <div class="flex items-center gap-3">
                    <div class="bg-green-100 p-2 rounded-lg">
                        <i data-lucide="badge-check" class="w-5 h-5 text-green-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Status Pegawai</p>
                        <p class="text-xs text-gray-500">Kelola opsi status</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.lama-bekerjas.index') }}" class="glass-effect rounded-xl p-4 border border-gray-100 hover:border-indigo-200 transition-all">
                <div class="flex items-center gap-3">
                    <div class="bg-amber-100 p-2 rounded-lg">
                        <i data-lucide="clock" class="w-5 h-5 text-amber-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Lama Bekerja</p>
                        <p class="text-xs text-gray-500">Kelola opsi masa kerja</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.kategoris.index') }}" class="glass-effect rounded-xl p-4 border border-gray-100 hover:border-indigo-200 transition-all">
                <div class="flex items-center gap-3">
                    <div class="bg-rose-100 p-2 rounded-lg">
                        <i data-lucide="tag" class="w-5 h-5 text-rose-600"></i>
                    </div>
                    <div>
                        <p class="font-semibold text-gray-900">Kategori Pertanyaan</p>
                        <p class="text-xs text-gray-500">Kelola kategori soal</p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- STATISTIK -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="glass-effect rounded-2xl p-6 card-hover">
            <p class="text-sm text-gray-600">Total Survei</p>
            <p class="text-3xl font-bold">{{ $totalSurvei }}</p>
        </div>

        <div class="glass-effect rounded-2xl p-6 card-hover">
            <p class="text-sm text-gray-600">Konten Aktif</p>
            <p class="text-3xl font-bold">{{ $kontenAktif }}</p>
        </div>

        <div class="glass-effect rounded-2xl p-6 card-hover">
            <p class="text-sm text-gray-600">Total Pegawai</p>
            <p class="text-3xl font-bold">{{ $totalPegawai }}</p>
        </div>
    </div>

    <!-- TABLE SURVEI -->
    <div class="glass-effect rounded-2xl overflow-hidden">
        <div class="px-6 py-4 border-b font-semibold flex items-center gap-2">
            <i data-lucide="table" class="w-5 h-5"></i>
            Data Survei
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm divide-y">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left">No</th>
                        <th class="px-6 py-3 text-left">Mode</th>
                        <th class="px-6 py-3 text-left">Pegawai</th>
                        <th class="px-6 py-3 text-left">Direktorat</th>
                        <th class="px-6 py-3 text-left">Konten</th>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($surveis as $i => $survei)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-3">{{ $surveis->firstItem() + $i }}</td>
                            <td class="px-6 py-3">
                                @if($survei->mode === 'public')
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 border border-blue-200">
                                        <i data-lucide="globe" class="w-3 h-3 mr-1"></i>
                                        Public
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800 border border-green-200">
                                        <i data-lucide="shield" class="w-3 h-3 mr-1"></i>
                                        Internal
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-3">{{ $survei->pegawai->nama ?? '-' }}</td>
                            <td class="px-6 py-3">{{ ucwords(str_replace('_', ' ', $survei->pegawai->direktorat ?? '-')) }}</td>
                            <td class="px-6 py-3">{{ $survei->kontenSurvei->judul ?? '-' }}</td>
                            <td class="px-6 py-3">{{ $survei->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-3">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.survei.show', $survei->id) }}" class="text-blue-600 hover:underline">
                                        Detail
                                    </a>
                                    <form action="{{ route('admin.survei.destroy', $survei->id) }}" method="POST" onsubmit="return confirm('Hapus survei ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-10 text-gray-500">
                                Data tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($surveis->hasPages())
            <div class="px-6 py-4 border-t bg-gray-50">
                {{ $surveis->links() }}
            </div>
        @endif
    </div>

@endsection
