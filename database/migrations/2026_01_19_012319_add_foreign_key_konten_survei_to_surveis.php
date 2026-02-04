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
        Schema::table('surveis', function (Blueprint $table) {
            $table->foreignId('konten_survei_id')->constrained('konten_surveis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surveis', function (Blueprint $table) {
            $table->dropForeign(['konten_survei_id']);
            $table->dropColumn('konten_survei_id');
        });
    }
};
