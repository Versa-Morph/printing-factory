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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->string('quotation_number',50);
            $table->string('company_code',50);
            $table->string('product_type',255);
            $table->string('material_detail',255);
            $table->string('thickness',255)->nullable();
            $table->integer('reduction')->nullable();
            $table->string('position',50)->nullable();
            $table->decimal('price', 15, 2);
            $table->integer('discount_percent')->nullable();
            $table->decimal('discount_price', 15, 2)->nullable();
            $table->dateTime('datetime');
            $table->enum('status', ['draft', 'sent','accepted','rejected']);
            $table->timestamp('status_change_at')->nullable();
            $table->date('valid_until')->nullable();
            $table->string('po_number',50)->nullable();
            $table->string('created_by',255)->nullable();
            $table->string('updated_by',255)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};
