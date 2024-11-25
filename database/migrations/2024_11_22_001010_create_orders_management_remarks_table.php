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
        Schema::create('orders_management_remarks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_management_id'); // Foreign Key
            $table->text('remark');

            $table->foreign('order_management_id')->references('id')->on('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_management_remarks');
    }
};
