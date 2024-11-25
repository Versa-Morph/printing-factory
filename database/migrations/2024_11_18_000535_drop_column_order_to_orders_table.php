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
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('id_pelanggan');
            $table->dropColumn('tanggal_order');
            $table->dropColumn('total_harga');
            $table->dropColumn('status_order');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Add the dropped columns back
            $table->unsignedBigInteger('id_pelanggan')->nullable();
            $table->date('tanggal_order')->nullable();
            $table->float('total_harga')->nullable();
            $table->string('status_order')->nullable();
        });
    }
};
