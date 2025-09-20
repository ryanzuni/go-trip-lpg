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
        Schema::table('destinasis', function (Blueprint $table) {
            //
            $table->dropColumn('harga_tiket');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destinasis', function (Blueprint $table) {
            //
            $table->decimal('harga_tiket', 10, 2)->nullable();
        });
    }
};
