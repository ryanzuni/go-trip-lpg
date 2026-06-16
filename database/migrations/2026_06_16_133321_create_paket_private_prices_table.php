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
        Schema::create('paket_private_prices', function (Blueprint $table) {

            $table->id();

            $table->foreignId('paket_wisata_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->integer('min_peserta');
            $table->integer('max_peserta');

            $table->integer('harga_weekday');
            $table->integer('harga_weekend');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_private_prices');
    }
};
