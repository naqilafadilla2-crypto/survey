<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Konten Survei - Dashboard Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="mb-6">
                <a href="{{ route('admin.konten-survei.index') }}" class="text-blue-600 hover:text-blue-800">← Kembali ke Daftar Konten</a>
            </div>

            <div class="bg-white shadow-lg rounded-lg p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Tambah Konten Survei</h1>

                @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form action="{{ route('admin.konten-survei.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Judul Survei</label>
                        <input type="text" name="judul" value="{{ old('judul', 'FORMULIR SURVEI KEPUASAN PEGAWAI TERHADAP LAYANAN INTERNAL BAKTI TAHUN 2025') }}" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pendahuluan</label>
                        <textarea name="pendahuluan" rows="4" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('pendahuluan', 'Dengan hormat,

Seiring dengan komitmen BLU BAKTI untuk terus meningkatkan kualitas pelayanan internal BAKTI, kami melaksanakan Survey kepuasan pegawai dalam rangka mendukung kelancaran pelaksanaan tugas dan fungsi organisasi. Layanan internal yang dinilai meliputi antara lain layanan BMN, kearsipan, perencanaan anggaran, dan layanan kepegawaian.') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Indikator</label>
                        <textarea name="indikator" rows="3" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('indikator', 'Indikator ini digunakan untuk mengukur efektivitas tata kelola internal, kualitas layanan pendukung, serta budaya kerja organisasi dalam mendukung pencapaian kinerja strategis BAKTI dan Perjanjian Kinerja Direktur Sumber Daya dan Administrasi Tahun 2025.') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Survei</label>
                        <textarea name="deskripsi_survei" rows="4" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('deskripsi_survei', 'Survei ini untuk mengukur tingkat kepuasan pegawai terhadap kualitas layanan internal BAKTI dalam mendukung pelaksanaan tugas dan pencapaian kinerja Direktorat Sumber Daya dan Administrasi, sebagai bagian dari evaluasi kinerja manajemen dan pemenuhan Perjanjian Kinerja Direktur Sumber Daya dan Administrasi Tahun 2025.') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tujuan 1</label>
                        <textarea name="tujuan_1" rows="2" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('tujuan_1', 'Menilai kualitas layanan internal BAKTI dari perspektif pegawai.') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tujuan 2</label>
                        <textarea name="tujuan_2" rows="2" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('tujuan_2', 'Mendorong peningkatan kinerja unit pendukung secara berkelanjutan.') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tujuan 3</label>
                        <textarea name="tujuan_3" rows="2" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('tujuan_3', 'Mendukung pencapaian sasaran strategis dan Perjanjian Kinerja Direktur Sumber Daya dan Administrasi Tahun 2025 pada aspek tata kelola dan SDM.') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Penutup</label>
                        <textarea name="penutup" rows="3" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('penutup', 'Kami menjamin bahwa semua informasi yang Anda berikan akan bersifat rahasia dan hanya akan digunakan untuk analisis internal demi perbaikan bersama. Kami berharap Anda dapat memberikan penilaian yang objektif, jujur dan konstruktif.

Terima kasih atas kerjasama dan kontribusi yang Anda berikan untuk kemajuan BLU BAKTI.') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun</label>
                        <input type="number" name="tahun" value="{{ old('tahun', date('Y')) }}" min="2000" max="2100" required 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} id="is_active" 
                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="is_active" class="ml-2 block text-sm text-gray-900">
                            Tampilkan konten survei ini di halaman utama (aktif)
                        </label>
                    </div>

                    <div class="flex justify-end gap-4">
                        <a href="{{ route('admin.konten-survei.index') }}" class="px-6 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Batal</a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Simpan Konten Survei
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
