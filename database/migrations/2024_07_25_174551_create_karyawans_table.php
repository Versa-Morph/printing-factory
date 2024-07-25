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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nama_karyawan', 255);
            $table->string('jabatan', 255);
            $table->decimal('gaji', 10, 2);
            $table->string('alamat', 255);
            $table->string('no_telepon', 20);
            $table->string('email', 255);
            $table->date('tanggal_lahir');
            $table->date('tanggal_masuk');
            $table->enum('status', ['Aktif', 'Tidak Aktif']);
    
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
