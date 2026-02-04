<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a sample konten_survei if not exists
        $kontenSurvei = \App\Models\konten_survei::firstOrCreate([
            'judul' => 'Survei Kepuasan Layanan BMN',
        ], [
            'pendahuluan' => 'Selamat datang di survei kepuasan layanan pengelolaan Barang Milik Negara (BMN).',
            'indikator' => 'Kepuasan pengguna terhadap layanan BMN.',
            'deskripsi_survei' => 'Survei ini bertujuan untuk mengukur tingkat kepuasan pengguna terhadap layanan pengelolaan BMN.',
            'tujuan_1' => 'Mengukur kepuasan terhadap keandalan layanan.',
            'tujuan_2' => 'Mengukur kepuasan terhadap ketersediaan barang.',
            'tujuan_3' => 'Mengukur kepuasan terhadap proses pengajuan.',
            'penutup' => 'Terima kasih atas partisipasi Anda.',
            'tahun' => 2026,
            'is_active' => true,
        ]);

        $questions = [
            [
                'kategori' => 'Pengelolaan Barang Milik Negara (BMN)',
                'pertanyaan' => 'Seberapa puas Anda dengan keandalan layanan yang diberikan dalam pengelolaan BMN?'
            ],
            [
                'kategori' => 'Pengelolaan Barang Milik Negara (BMN)',
                'pertanyaan' => 'Seberapa puas Anda dengan ketersediaan barang BMN yang dibutuhkan di instansi Anda?'
            ],
            [
                'kategori' => 'Pengelolaan Barang Milik Negara (BMN)',
                'pertanyaan' => 'Seberapa puas Anda dengan langkah-langkah keamanan dan perawatan BMN yang diterapkan?'
            ],
            [
                'kategori' => 'Pengelolaan Barang Milik Negara (BMN)',
                'pertanyaan' => 'Seberapa puas Anda dengan proses pengajuan BMN yang diterapkan?'
            ],
            [
                'kategori' => 'Perencanaan dan Penganggaran',
                'pertanyaan' => 'Sejauh mana tingkat kepuasan Anda terhadap dukungan manajemen terhadap proses perencanaan dan penganggaran?'
            ],
            [
                'kategori' => 'Perencanaan dan Penganggaran',
                'pertanyaan' => 'Bagaimana Anda menilai kefleksibelan proses anggaran dalam menghadapi perubahan kebutuhan organisasi?'
            ],
            [
                'kategori' => 'Perencanaan dan Penganggaran',
                'pertanyaan' => 'Sejauh mana Anda merasa perencanaan anggaran dilakukan secara sistematis dan terstruktur?'
            ],
            [
                'kategori' => 'Perencanaan dan Penganggaran',
                'pertanyaan' => 'Sejauh mana Anda merasa bahwa anggaran yang disusun relevan dengan kebutuhan dan tujuan organisasi?'
            ],
            [
                'kategori' => 'Perencanaan dan Penganggaran',
                'pertanyaan' => 'Sejauh mana Anda merasa rencana anggaran yang disusun memenuhi standar yang diharapkan?'
            ],
            [
                'kategori' => 'Sistem Kearsipan',
                'pertanyaan' => 'Seberapa puas Anda dengan kualitas informasi yang disimpan dalam sistem kearsipan Kantor?'
            ],
            [
                'kategori' => 'Sistem Kearsipan',
                'pertanyaan' => 'Seberapa puas Anda dengan ketersediaan tempat atau storage dalam pengarsipan dokumen fisik?'
            ],
            [
                'kategori' => 'Sistem Kearsipan',
                'pertanyaan' => 'Bagaimana penilaian Anda terhadap sistem kearsipan digital yang diterapkan seperti penyimpanan berbasis cloud?'
            ],
            [
                'kategori' => 'Sistem Kearsipan',
                'pertanyaan' => 'Sejauh mana Anda merasa bahwa teknologi digunakan secara efektif dalam pengelolaan kearsipan?'
            ],
            [
                'kategori' => 'Sistem Kearsipan',
                'pertanyaan' => 'Bagaimana Anda menilai perawatan dan pemeliharaan arsip fisik yang tersedia?'
            ],
            [
                'kategori' => 'Layanan Kepegawaian',
                'pertanyaan' => 'Seberapa puas Anda dengan proses pengajuan cuti dan perekaman kehadiran secara geotagging?'
            ],
            [
                'kategori' => 'Layanan Kepegawaian',
                'pertanyaan' => 'Sejauh mana Anda percaya bahwa layanan kepegawaian mengelola data dan informasi pegawai dengan baik dan aman?'
            ],
            [
                'kategori' => 'Layanan Kepegawaian',
                'pertanyaan' => 'Seberapa puas Anda dengan proses pengajuan dokumen atau permohonan melalui layanan kepegawaian?'
            ],
            [
                'kategori' => 'Layanan Kepegawaian',
                'pertanyaan' => 'Bagaimana penilaian Anda terhadap integritas petugas bagian Kepegawaian dalam memberikan layanan tanpa meminta imbalan?'
            ],
        ];

        foreach ($questions as $questionData) {
            \App\Models\Question::create([
                'kategori' => $questionData['kategori'],
                'pertanyaan' => $questionData['pertanyaan'],
                'konten_survei_id' => $kontenSurvei->id,
            ]);
        }
    }
}
