@extends('layouts.admin')

@section('title', 'Laporan & Analisis')

@section('page-title', 'Laporan & Analisis')
@section('page-description', 'Statistik dan analisis data survei')

@push('styles')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endpush

@section('header-actions')
    <div class="flex items-center gap-3">
        <a href="{{ route('admin.laporan.export-excel', ['konten_id' => $kontenId, 'mode' => $modeFilter]) }}" 
           class="bg-gradient-to-r from-emerald-500 to-green-600 hover:from-emerald-600 hover:to-green-700 text-white px-6 py-3 rounded-xl font-medium transition-all duration-200 flex items-center">
            <i data-lucide="file-spreadsheet" class="w-4 h-4 mr-2"></i>
            Download Excel
        </a>
        <a href="{{ route('admin.laporan.export', ['konten_id' => $kontenId, 'mode' => $modeFilter]) }}" 
           class="bg-gradient-to-r from-red-500 to-rose-600 hover:from-red-600 hover:to-rose-700 text-white px-6 py-3 rounded-xl font-medium transition-all duration-200 flex items-center">
            <i data-lucide="file-text" class="w-4 h-4 mr-2"></i>
            Export PDF
        </a>
    </div>
@endsection

@section('content')
    <!-- Filter Periode -->
    <div class="glass-effect rounded-2xl p-6 mb-8 border border-gray-100">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                <i data-lucide="calendar" class="w-5 h-5 mr-2 text-blue-600"></i>
                Filter Laporan
            </h3>
        </div>

        <form method="GET" action="{{ route('admin.laporan.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Konten Survei</label>
                <select name="konten_id" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                    <option value="">Semua Konten</option>
                    @foreach($kontenList as $konten)
                        <option value="{{ $konten->id }}" {{ $kontenId == $konten->id ? 'selected' : '' }}>
                            {{ $konten->judul }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Mode Survei</label>
                <select name="mode" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white">
                    <option value="">Semua Mode</option>
                    <option value="public" {{ $modeFilter == 'public' ? 'selected' : '' }}>Public</option>
                    <option value="internal" {{ $modeFilter == 'internal' ? 'selected' : '' }}>Internal</option>
                </select>
            </div>

            <div class="flex items-end">
                <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-medium transition-all duration-200 flex items-center justify-center">
                    <i data-lucide="filter" class="w-4 h-4 mr-2"></i>
                    Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <!-- Filter Status -->
    @if($kontenId || $modeFilter)
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <i data-lucide="filter" class="w-5 h-5 text-blue-600"></i>
                <span class="text-blue-900 font-medium">Filter Aktif:</span>
                @if($kontenId)
                    <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                        Konten: {{ $kontenList->where('id', $kontenId)->first()->judul ?? 'Unknown' }}
                    </span>
                @endif
                @if($modeFilter)
                    <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm">
                        Mode: {{ ucfirst($modeFilter) }}
                    </span>
                @endif
            </div>
            <a href="{{ route('admin.laporan.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                Reset Filter
            </a>
        </div>
    </div>
    @endif

    <!-- Summary Cards -->
    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="glass-effect rounded-2xl p-6 card-hover border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Survei</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalSurvei }}</p>
                </div>
                <div class="bg-gradient-to-r from-blue-500 to-purple-600 p-3 rounded-full">
                    <i data-lucide="clipboard-list" class="w-6 h-6 text-white"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center text-sm">
                    <i data-lucide="trending-up" class="w-4 h-4 text-green-500 mr-1"></i>
                    <span class="text-green-500 font-medium">+15%</span>
                    <span class="text-gray-500 ml-1">dari periode sebelumnya</span>
                </div>
            </div>
        </div>

        <div class="glass-effect rounded-2xl p-6 card-hover border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Konten Aktif</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $kontenAktif }}</p>
                </div>
                <div class="bg-gradient-to-r from-purple-500 to-pink-600 p-3 rounded-full">
                    <i data-lucide="file-text" class="w-6 h-6 text-white"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center text-sm">
                    <i data-lucide="activity" class="w-4 h-4 text-purple-500 mr-1"></i>
                    <span class="text-purple-500 font-medium">{{ $kontenAktif }}</span>
                    <span class="text-gray-500 ml-1">konten aktif</span>
                </div>
            </div>
        </div>

        <div class="glass-effect rounded-2xl p-6 card-hover border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Pegawai</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $totalPegawai }}</p>
                </div>
                <div class="bg-gradient-to-r from-orange-500 to-red-600 p-3 rounded-full">
                    <i data-lucide="users" class="w-6 h-6 text-white"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="flex items-center text-sm">
                    <i data-lucide="user-check" class="w-4 h-4 text-orange-500 mr-1"></i>
                    <span class="text-orange-500 font-medium">100%</span>
                    <span class="text-gray-500 ml-1">terdaftar</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid {{ $modeFilter == 'public' ? 'lg:grid-cols-1' : 'lg:grid-cols-2' }} gap-8 mb-8">
        <!-- Directorate Statistics Table -->
        @if($modeFilter != 'public')
        <div class="glass-effect rounded-2xl border border-gray-100 overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i data-lucide="building" class="w-5 h-5 mr-2 text-indigo-600"></i>
                    Statistik Per Direktorat
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Direktorat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Pegawai</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Survei</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($direktoratStats as $stat)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $stat['nama'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stat['total_pegawai'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $stat['total_survei'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($stat['total_survei'] > 0)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        <i data-lucide="clock" class="w-3 h-3 mr-1"></i>
                                        Belum Ada Data
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                <i data-lucide="building" class="w-12 h-12 mx-auto mb-4 text-gray-300"></i>
                                <p>Tidak ada data direktorat</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @endif

        <!-- Content Statistics Table -->
        <div class="glass-effect rounded-2xl border border-gray-100 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                    <i data-lucide="file-text" class="w-5 h-5 mr-2 text-green-600"></i>
                    Statistik Konten Survei
                </h3>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Konten</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Respons</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Persentase</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($kontenStats as $konten)
                        <tr class="hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $konten->judul }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($konten->is_active)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i data-lucide="check-circle" class="w-3 h-3 mr-1"></i>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        <i data-lucide="x-circle" class="w-3 h-3 mr-1"></i>
                                        Non-Aktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $konten->surveis_count }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($totalSurvei > 0)
                                    {{ number_format(($konten->surveis_count / $totalSurvei) * 100, 1) }}%
                                @else
                                    0%
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                <i data-lucide="file-text" class="w-12 h-12 mx-auto mb-4 text-gray-300"></i>
                                <p>Tidak ada data konten survei</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Monthly Trend Chart
        document.addEventListener('DOMContentLoaded', function() {
            const monthlyCtx = document.getElementById('monthlyTrendChart');
            if (monthlyCtx) {
                const monthlyData = @json($monthlyTrend);

                new Chart(monthlyCtx.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: monthlyData.map(item => item.month),
                        datasets: [{
                            label: 'Jumlah Survei',
                            data: monthlyData.map(item => item.count),
                            borderColor: 'rgb(59, 130, 246)',
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            tension: 0.4,
                            fill: true
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    display: false
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }

            // Content Performance Chart
            const contentCtx = document.getElementById('contentChart');
            if (contentCtx) {
                const contentData = @json($kontenStats);

                new Chart(contentCtx.getContext('2d'), {
                    type: 'bar',
                    data: {
                        labels: contentData.map(item => item.judul.length > 20 ? item.judul.substring(0, 20) + '...' : item.judul),
                        datasets: [{
                            label: 'Jumlah Respons',
                            data: contentData.map(item => item.surveis_count),
                            backgroundColor: 'rgba(34, 197, 94, 0.8)',
                            borderColor: 'rgb(34, 197, 94)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                grid: {
                                    display: false
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
                            }
                        }
                    }
                });
            }
        });
    </script>
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
                © {{ date('Y') }} SimBakti - Bakti Komdigi. All rights reserved.
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>

@endpush
