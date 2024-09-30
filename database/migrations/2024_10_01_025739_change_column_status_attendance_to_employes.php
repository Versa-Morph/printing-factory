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
        // Periksa apakah constraint foreign key ada sebelum menghapus
        if (Schema::hasColumn('employes', 'status_attendance')) {
            Schema::table('employes', function (Blueprint $table) {
                // Coba hapus foreign key jika ada
                DB::statement('ALTER TABLE employes DROP CONSTRAINT IF EXISTS employes_status_attendance_foreign');
                
                // Hapus kolom status_attendance
                $table->dropColumn('status_attendance');
            });
        }

        // Tambahkan kembali kolom dengan tipe unsignedBigInteger
        Schema::table('employes', function (Blueprint $table) {
            $table->unsignedBigInteger('status_attendance')->default(1);

            // Tambahkan foreign key yang berelasi ke tabel status_attendances
            $table->foreign('status_attendance')
                ->references('id')
                ->on('status_attendances')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Periksa apakah foreign key ada sebelum dihapus
        if (Schema::hasColumn('employes', 'status_attendance')) {
            Schema::table('employes', function (Blueprint $table) {
                // Hapus foreign key
                $table->dropForeign(['status_attendance']);
                // Hapus kolom status_attendance
                $table->dropColumn('status_attendance');
            });
        }

        // Ubah kembali kolom menjadi enum jika diperlukan
        Schema::table('employes', function (Blueprint $table) {
            $table->enum('status_attendance', ['mobile', 'office'])->nullable();
        });
    }
};
