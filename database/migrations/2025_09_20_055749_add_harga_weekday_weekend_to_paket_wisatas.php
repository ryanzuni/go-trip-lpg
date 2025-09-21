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
            $table->integer('harga_weekday')->after('deskripsi')->default(0);
            $table->integer('harga_weekend')->after('harga_weekday')->default(0);

            // Optional: hapus kolom lama "harga" kalau sudah tidak dipakai
            $table->dropColumn('harga');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paket_wisatas', function (Blueprint $table) {
            $table->integer('harga')->after('deskripsi')->default(0);
            $table->dropColumn(['harga_weekday', 'harga_weekend']);
        });
    }
};
