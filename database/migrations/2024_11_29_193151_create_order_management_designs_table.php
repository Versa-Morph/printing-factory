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
        Schema::create('order_management_designs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_management_id')->unsigned(); // Foreign key
            $table->string('document_name'); // Nama dokumen
            $table->text('document_path'); // Lokasi file dokumen
            $table->string('uploaded_by'); // Nama karyawan
            $table->enum('status', ['waiting', 'approved', 'rejected', 'revision']);

            $table->foreign('order_management_id')->references('id')->on('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_management_designs');
    }
};
