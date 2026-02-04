<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MasterDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Direktorat
        $direktorats = [
            'Sumber Daya dan Administrasi',
            'Keuangan',
            'Satuan Pemeriksaan Intern',
            'LTI Badan Usaha',
            'LTI Masyarakat dan Pemerintah',
            'Infrastruktur',
            'Wilker Surabaya',
            'Wilker Makassar',
            'Direktorat Teknologi Informasi',
            'Direktorat Hukum',
            'Direktorat Pengadaan',
            'Direktorat Perencanaan',
        ];

        foreach ($direktorats as $direktorat) {
            \App\Models\Direktorat::create([
                'nama' => $direktorat,
                'is_active' => true,
            ]);
        }

        // Seed Status Pegawai
        $statusPegawais = [
            'PNS',
            'PPPK',
            'Non-ASN',
            'Outsourcing',
            'Kontrak',
            'Honor',
            'Magang',
            'Tenaga Ahli',
        ];

        foreach ($statusPegawais as $status) {
            \App\Models\StatusPegawai::create([
                'nama' => $status,
                'is_active' => true,
            ]);
        }

        // Seed Lama Bekerja
        $lamaBekerjas = [
            'Kurang dari 1 tahun',
            '1 sampai 2 tahun',
            '3 sampai 5 tahun',
            '6 sampai 10 tahun',
            '11 sampai 15 tahun',
            '16 sampai 20 tahun',
            'Lebih dari 20 tahun',
        ];

        foreach ($lamaBekerjas as $lama) {
            \App\Models\LamaBekerja::create([
                'nama' => $lama,
                'is_active' => true,
            ]);
        }
    }
}
