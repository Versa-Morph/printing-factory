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
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('employee_code');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->text('address')->nullable();
            $table->date('hire_date');
            $table->string('status');
            $table->string('profile_picture')->nullable();
            $table->string('ktp_number')->nullable();
            $table->string('ktp_file')->nullable();
            $table->string('npwp_number')->nullable();
            $table->string('npwp_file')->nullable();
            $table->string('bpjs_kesehatan_number')->nullable();
            $table->string('bpjs_kesehatan_file')->nullable();
            $table->string('bpjs_ketenagakerjaan_number')->nullable();
            $table->string('bpjs_ketenagakerjaan_file')->nullable();
            $table->string('family_card_number')->nullable();
            $table->string('family_card_file')->nullable();
            $table->string('marital_status')->nullable();
            $table->enum('status_attendance', ['mobile', 'office']);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
