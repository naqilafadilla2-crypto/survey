<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->enum('direktorat', ['sumber_daya_dan_administrasi', 'keuangan', 'satuan_pemeriksaan_intern', 'lti_badan_usaha', 'lti_masyarakat_dan_pemerintah', 'infrastruktur', 'wilker_surabaya', 'wilker_makassar']);
            $table->string('divisi');
            $table->enum('status_pegawai', [
                'PNS',
                'PPPK',
                'Non-ASN',
                'Outsourcing'
            ]);
            $table->enum('lama_bekerja', ['kurang_1_tahun', '1_sampai_2_tahun', 'lebih_3 tahun']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawais');
    }
};
