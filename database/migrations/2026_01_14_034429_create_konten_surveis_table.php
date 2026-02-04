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
        Schema::create('konten_surveis', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->text('pendahuluan');
            $table->text('indikator');
            $table->text('deskripsi_survei');
            $table->text('tujuan_1');
            $table->text('tujuan_2');
            $table->text('tujuan_3');
            $table->text('penutup');
            $table->year('tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konten_surveis');
    }
};
