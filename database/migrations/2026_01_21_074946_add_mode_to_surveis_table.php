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
            $table->enum('mode', ['public', 'internal'])->after('pegawai_id')->default('internal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surveis', function (Blueprint $table) {
            $table->dropColumn('mode');
        });
    }
};
