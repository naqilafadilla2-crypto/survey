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
        Schema::table('pegawais', function (Blueprint $table) {
            // Hapus kolom ENUM direktorat
            $table->dropColumn('direktorat');
        });

        // Tambahkan kolom direktorat sebagai string
        Schema::table('pegawais', function (Blueprint $table) {
            $table->string('direktorat')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            // Hapus kolom string
            $table->dropColumn('direktorat');
        });

        // Kembalikan ke ENUM
        Schema::table('pegawais', function (Blueprint $table) {
            $table->enum('direktorat', [
                'sumber_daya_dan_administrasi',
                'keuangan',
                'satuan_pemeriksaan_intern',
                'lti_badan_usaha',
                'lti_masyarakat_dan_pemerintah',
                'infrastruktur',
                'wilker_surabaya',
                'wilker_makassar'
            ])->after('id');
        });
    }
};
