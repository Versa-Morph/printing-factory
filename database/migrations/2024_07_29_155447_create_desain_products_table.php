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
        Schema::create('desain_products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_desain',255);
            $table->text('deskripsi')->nullable();
            $table->string('file_desain',255);
            $table->date('tanggal_buat');
            $table->date('created_by', 255)->nullable();
            $table->date('updated_by', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desain_products');
    }
};
