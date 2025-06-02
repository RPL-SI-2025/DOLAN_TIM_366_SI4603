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
        Schema::table('tickets', function (Blueprint $table) {
            // Pastikan satu destinasi hanya bisa punya satu tiket
            $table->unique('destination_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            // 1) Drop foreign key constraint dulu
            $table->dropForeign(['destination_id']);

            // 2) Drop unique index
            $table->dropUnique('tickets_destination_id_unique');

            // 3) Jika Anda masih butuh FK, re-create-nya
            $table->foreign('destination_id')
                  ->references('id')->on('destinations')
                  ->onDelete('cascade');
        });
    }
};
