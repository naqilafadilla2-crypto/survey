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
        Schema::table('questions', function (Blueprint $table) {
            // Kolom 'kategori' sudah ditambahkan oleh migrasi sebelumnya (2026_01_20_065243_add_kategori_to_questions_table)
            // Di sini kita hanya menambahkan kolom baru untuk tipe dan opsi pertanyaan.

            if (!Schema::hasColumn('questions', 'type')) {
                $table->string('type')->default('scale')->after('kategori'); // scale | choice | text
            }

            if (!Schema::hasColumn('questions', 'options')) {
                $table->json('options')->nullable()->after('type'); // untuk menyimpan opsi custom (misal: ["Ya","Tidak"])
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            if (Schema::hasColumn('questions', 'type')) {
                $table->dropColumn('type');
            }

            if (Schema::hasColumn('questions', 'options')) {
                $table->dropColumn('options');
            }
        });
    }
};

