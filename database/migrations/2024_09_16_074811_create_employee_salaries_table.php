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
        Schema::create('employee_salaries', function (Blueprint $table) {
            $table->id(); // Primary key, auto increment
            $table->foreignId('employee_id')->constrained('employes')->onDelete('cascade'); // Foreign key to employees table
            $table->string('payment_method'); // Payment method (e.g., 'Bank Transfer BCA', 'Cash')
            $table->string('rekening_number'); // Employee's bank account number
            $table->integer('working_days'); // Number of working days
            $table->decimal('overtime_per_hour', 15, 2)->nullable(); // Overtime per hour
            $table->decimal('additional_overtime', 15, 2)->nullable(); // Additional overtime (e.g., for weekends)
            $table->decimal('basic_salary', 15, 2); // Basic salary
            $table->decimal('transportation_incentive', 15, 2)->nullable(); // Transportation incentive
            $table->decimal('daily_incentive', 15, 2)->nullable(); // Daily incentive
            $table->decimal('position_incentive', 15, 2)->nullable(); // Position incentive (e.g., job allowances)
            $table->decimal('bpjs_kesehatan_base', 15, 2)->nullable(); // BPJS Kesehatan base calculation
            $table->integer('bpjs_kesehatan_employee')->nullable(); // BPJS Kesehatan percentage by employee
            $table->integer('bpjs_kesehatan_employer')->nullable(); // BPJS Kesehatan percentage by employer
            $table->decimal('bpjs_ketenagakerjaan_base', 15, 2)->nullable(); // BPJS Ketenagakerjaan base calculation
            $table->integer('bpjs_ketenagakerjaan_employee')->nullable(); // BPJS Ketenagakerjaan percentage by employee
            $table->integer('bpjs_ketenagakerjaan_employer')->nullable(); // BPJS Ketenagakerjaan percentage by employer
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_salaries');
    }
};
