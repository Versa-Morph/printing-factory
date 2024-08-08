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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_pelanggan');
            $table->date('tanggal_order');
            $table->decimal('total_harga', 10, 2);
            $table->string('status_order',50);
            $table->string('created_by',255)->nullable();
            $table->string('updated_by',255)->nullable();
            $table->foreign('id_pelanggan')->references('id')->on('pelanggans')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
