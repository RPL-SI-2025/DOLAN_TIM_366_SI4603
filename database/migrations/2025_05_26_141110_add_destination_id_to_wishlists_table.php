<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::table('wishlists', function (Blueprint $table) {
        $table->unsignedBigInteger('destination_id'); // Menambahkan kolom destination_id
        $table->foreign('destination_id')->references('id')->on('destinations'); // Menambahkan foreign key
    });
    }

public function down()
    {
    Schema::table('wishlists', function (Blueprint $table) {
        $table->dropColumn('destination_id'); // Menghapus kolom destination_id
    });
    }
};
