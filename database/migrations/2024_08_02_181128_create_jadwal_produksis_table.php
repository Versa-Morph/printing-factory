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
        Schema::create('jadwal_produksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_rencana');
            $table->date('tanggal_produksi');
            $table->string('shift',50);
            $table->string('created_by',255)->nullable();
            $table->string('updated_by',255)->nullable();
            $table->foreign('id_rencana')->references('id')->on('rencana_produksis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_produksis');
    }
};
