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
        Schema::table('paket_wisatas', function (Blueprint $table) {
            $table->enum('tipe_harga', [
                'per_orang',
                'per_grup'
            ])->default('per_orang')
                ->after('jenis_layanan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paket_wisatas', function (Blueprint $table) {
            //
        });
    }
};
