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
            $table->string('direktorat')->nullable()->change();
            $table->string('divisi')->nullable()->change();
            $table->string('nama')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pegawais', function (Blueprint $table) {
            $table->string('direktorat')->nullable(false)->change();
            $table->string('divisi')->nullable(false)->change();
            $table->string('nama')->nullable(false)->change();
        });
    }
};
