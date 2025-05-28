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
        Schema::table('destinations', function (Blueprint $table) {
            $table->text('tour_includes')->nullable()->after('price');
            $table->text('tour_payments')->nullable()->after('tour_includes');
            $table->boolean('has_ticket')->default(true)->after('tour_payments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table) {
            $table->dropColumn('tour_includes');
            $table->dropColumn('tour_payments');
            $table->dropColumn('has_ticket');
        });
    }
};