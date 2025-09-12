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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
    $table->string('nama_pelanggan');
    $table->string('email')->nullable();
    $table->string('telepon')->nullable();
    
    // Buat kolom paket_id dulu
    $table->unsignedBigInteger('paket_id');
    
    // Setelah itu baru buat foreign key
    $table->foreign('paket_id')
          ->references('id')
          ->on('paket_wisatas')
          ->onDelete('cascade');

    $table->integer('jumlah_orang')->default(1);
    $table->date('tanggal_berangkat');
    $table->decimal('total_harga', 15, 2);
    $table->enum('status', ['pending','lunas','batal'])->default('pending');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
