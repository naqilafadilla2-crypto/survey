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
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });

        // Insert kategori default
        DB::table('kategoris')->insert([
            [
                'nama' => 'Pengelolaan Barang Milik Negara (BMN)',
                'deskripsi' => 'Pertanyaan terkait pengelolaan barang milik negara',
                'urutan' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Perencanaan dan Penganggaran',
                'deskripsi' => 'Pertanyaan terkait perencanaan dan penganggaran',
                'urutan' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Sistem Kearsipan',
                'deskripsi' => 'Pertanyaan terkait sistem kearsipan',
                'urutan' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Layanan Kepegawaian',
                'deskripsi' => 'Pertanyaan terkait layanan kepegawaian',
                'urutan' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Sistem Informasi',
                'deskripsi' => 'Pertanyaan terkait sistem informasi',
                'urutan' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kategoris');
    }
};
