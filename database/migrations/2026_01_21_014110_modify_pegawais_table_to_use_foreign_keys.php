<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Ubah status_pegawai dari ENUM ke string/varchar yang fleksibel
        Schema::table('pegawais', function (Blueprint $table) {
            // Hapus kolom ENUM lama
            $table->dropColumn(['status_pegawai', 'lama_bekerja']);
        });

        // Tambahkan kolom baru sebagai string
        Schema::table('pegawais', function (Blueprint $table) {
            $table->string('status_pegawai')->after('divisi');
            $table->string('lama_bekerja')->after('status_pegawai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            // Hapus kolom string
            $table->dropColumn(['status_pegawai', 'lama_bekerja']);
        });

        // Kembalikan ke ENUM
        Schema::table('pegawais', function (Blueprint $table) {
            $table->enum('status_pegawai', [
                'PNS',
                'PPPK',
                'Non-ASN',
                'Outsourcing'
            ])->after('divisi');
            $table->enum('lama_bekerja', ['kurang_1_tahun', '1_sampai_2_tahun', 'lebih_3 tahun'])->after('status_pegawai');
        });
    }
};
