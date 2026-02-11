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
        Schema::table('konten_surveis', function (Blueprint $table) {
            $table->text('pendahuluan')->nullable()->change();
            $table->text('indikator')->nullable()->change();
            $table->text('deskripsi_survei')->nullable()->change();
            $table->text('tujuan_2')->nullable()->change();
            $table->text('tujuan_3')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('konten_surveis', function (Blueprint $table) {
            $table->text('pendahuluan')->nullable(false)->change();
            $table->text('indikator')->nullable(false)->change();
            $table->text('deskripsi_survei')->nullable(false)->change();
            $table->text('tujuan_2')->nullable(false)->change();
            $table->text('tujuan_3')->nullable(false)->change();
        });
    }
};
