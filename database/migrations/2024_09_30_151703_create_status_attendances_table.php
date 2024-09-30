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
        Schema::create('status_attendances', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('radius')->nullable();
            $table->text('address')->nullable();
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_attendances');
    }
};
