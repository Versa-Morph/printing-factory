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
        Schema::create('laporan_produksis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jadwal');
            $table->integer('jumlah_produksi');
            $table->integer('jumlah_reject');
            $table->text('keterangan');
            $table->date('tanggal_laporan');
            $table->string('created_by',255)->nullable();
            $table->string('updated_by',255)->nullable();
            $table->foreign('id_jadwal')->references('id')->on('jadwal_produksis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_produksis');
    }
};
