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
        Schema::create('rencana_produksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_desain')->nullable();
            $table->bigInteger('jumlah_produksi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('status_rencana', 255);
            $table->string('created_by', 255);
            $table->string('updated_by', 255)->nullable();
            $table->foreign('id_desain')->references('id')->on('desain_products')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rencana_produksis');
    }
};
