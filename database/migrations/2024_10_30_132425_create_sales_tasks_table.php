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
        Schema::create('sales_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_name')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('assigned_employee_id')->nullable();
            $table->date('due_date')->nullable();
            $table->enum('priority', ['high', 'medium','low']);
            $table->enum('status', ['pending', 'in progress','completed','overdue']);
            $table->text('remarks')->nullable();

            $table->foreign('assigned_employee_id')->references('id')->on('employes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_tasks');
    }
};
