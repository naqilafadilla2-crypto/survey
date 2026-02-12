@extends('layouts.admin')

@section('title', 'Kelola Pertanyaan - ' . $konten_survei->judul)

@section('page-title', 'Kelola Pertanyaan')
@section('page-description', $konten_survei->judul . ' - Tahun ' . $konten_survei->tahun)

@section('header-actions')
    <a href="{{ route('admin.konten-survei.questions.create', $konten_survei) }}"
       class="bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white px-6 py-3 rounded-xl font-medium transition-all duration-200 flex items-center">
        <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
        Tambah Pertanyaan
    </a>
@endsection

@section('content')
    <div class="glass-effect rounded-2xl overflow-hidden border border-gray-100">
        @if($questions->isEmpty())
        <div class="p-12 text-center">
            <i data-lucide="file-x" class="w-16 h-16 text-gray-400 mx-auto mb-4"></i>
            <h3 class="text-lg font-medium text-gray-900 mb-2">Belum ada pertanyaan</h3>
            <p class="text-gray-600 mb-6">Tambahkan pertanyaan pertama untuk konten survei ini.</p>
            <a href="{{ route('admin.konten-survei.questions.create', $konten_survei) }}"
               class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 shadow-lg hover:shadow-xl transition-all duration-200">
                <i data-lucide="plus" class="w-5 h-5 mr-2"></i>
                Tambah Pertanyaan Pertama
            </a>
        </div>
        @else
        <div class="p-6 space-y-6">
            @foreach($questions as $kategori => $kategoriQuestions)
            <div class="border border-gray-200 rounded-lg overflow-hidden">
                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200">
                    <h4 class="text-md font-semibold text-gray-900 flex items-center">
                        <i data-lucide="folder" class="w-5 h-5 mr-2 text-blue-500"></i>
                        {{ $kategori }}
                        <span class="ml-2 text-sm text-gray-500 font-normal">
                            ({{ $kategoriQuestions->count() }} pertanyaan)
                        </span>
                    </h4>
                </div>

                <div class="divide-y divide-gray-200">
                    @foreach($kategoriQuestions as $question)
                    <div class="px-4 py-4 flex items-center justify-between hover:bg-gray-50 transition-colors">
                        <div class="flex-1">
                            <p class="text-sm text-gray-900">{{ $question->pertanyaan }}</p>
                        </div>
                        <div class="flex items-center space-x-2 ml-4">
                            <a href="{{ route('admin.konten-survei.questions.edit', [$konten_survei, $question]) }}"
                               class="text-blue-600 hover:text-blue-900 inline-flex items-center px-3 py-2 rounded-lg hover:bg-blue-50 transition-colors">
                                <i data-lucide="edit" class="w-4 h-4 mr-1"></i>
                                Edit
                            </a>
                            <form action="{{ route('admin.konten-survei.questions.destroy', [$konten_survei, $question]) }}"
                                  method="POST" class="inline"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus pertanyaan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 inline-flex items-center px-3 py-2 rounded-lg hover:bg-red-50 transition-colors">
                                    <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

         <!-- ================= FOOTER ================= -->
    <footer class="bg-gradient-to-r from-indigo-700 to-purple-700 text-white mt-16">
        <div class="max-w-6xl mx-auto px-6 py-12">

            <!-- Grid Content -->
            <div class="grid md:grid-cols-3 gap-10 text-sm">

                <!-- Alamat -->
                <div>
                    <h3 class="font-semibold mb-4 text-white">Alamat Kantor</h3>
                    <p class="text-indigo-100 leading-relaxed">
                        Centennial Tower Lt. 42-45 <br>
                        Jl. Gatot Subroto Kav. 24-25 <br>
                        Jakarta 12930
                    </p>
                </div>

                <!-- Kontak -->
                <div>
                    <h3 class="font-semibold mb-4 text-white">Kontak</h3>
                    <p class="text-indigo-100 mb-2">
                        Telepon: (021) 3193 6590
                    </p>
                    <p class="text-indigo-100">
                        Email:
                        <a href="mailto:humas@baktikominfo.id"
                           class="underline hover:text-white transition-colors">
                            humas@baktikominfo.id
                        </a>
                    </p>
                </div>

                <!-- Jam Operasional -->
                <div>
                    <h3 class="font-semibold mb-4 text-white">Jam Operasional</h3>
                    <p class="text-indigo-100">Senin - Jumat</p>
                    <p class="text-indigo-100">08.00 - 17.00 WIB</p>
                    <p class="text-indigo-100">Layanan Online: 24 Jam</p>
                </div>

            </div>

            <!-- Bottom Copyright -->
            <div class="border-t border-white/20 mt-10 pt-6 text-center text-xs text-indigo-200">
                © {{ date('Y') }} SimBakti - Bakti Komdigi. All rights reserved.
            </div>

        </div>
    </footer>


    <script>
        lucide.createIcons();
    </script>

@endsection
