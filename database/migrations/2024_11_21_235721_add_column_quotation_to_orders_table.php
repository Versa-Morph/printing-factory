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
        Schema::table('orders', function (Blueprint $table) {
            $table->bigInteger('order_number')->unique();
            $table->bigInteger('quotation_number');
            $table->bigInteger('po_number');
            $table->string('company_code', 50);
            $table->string('job_no' , 50)->nullable();
            $table->integer('reduction')->nullable();
            $table->enum('position', ['vertical', 'horizontal'])->nullable();
            $table->enum('status_order', ['normal', 'issue']);
            $table->enum('priority', ['Not Urgent', 'Less Urgent', 'Urgent', 'Top Urgent']);
            $table->timestamp('delivery_datetime');
            $table->timestamp('received_datetime');
            $table->string('cc_user', 255)->nullable();
            $table->string('designer_user', 255)->nullable();
            $table->timestamp('designer_start_datetime')->nullable();
            $table->timestamp('designer_end_datetime')->nullable();
            $table->string('operator_user', 255)->nullable();
            $table->timestamp('operator_start_datetime')->nullable();
            $table->timestamp('operator_end_datetime')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {

        // Hapus kolom yang ditambahkan
        $table->dropColumn('order_number');
        $table->dropColumn('quotation_number');
        $table->dropColumn('po_number');
        $table->dropColumn('company_code');
        $table->dropColumn('job_no');
        $table->dropColumn('reduction');
        $table->dropColumn('position');
        $table->dropColumn('priority');
        $table->dropColumn('delivery_datetime');
        $table->dropColumn('received_datetime');
        $table->dropColumn('cc_user');
        $table->dropColumn('designer_user');
        $table->dropColumn('designer_start_datetime');
        $table->dropColumn('designer_end_datetime');
        $table->dropColumn('operator_user');
        $table->dropColumn('operator_start_datetime');
        $table->dropColumn('operator_end_datetime');
        $table->dropColumn('created_by');
        $table->dropColumn('updated_by');
        });
    }
};
