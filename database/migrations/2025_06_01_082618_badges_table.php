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
    Schema::dropIfExists('badges'); // tambahkan ini jika diperlukan
    Schema::create('badges', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('description')->nullable();
        $table->string('icon')->nullable(); // bisa berupa path ke gambar/icon
        $table->integer('required_point')->default(0); // poin yang diperlukan untuk mendapatkan badge
        $table->timestamps();
    });

    Schema::create('badge_user', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('badge_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}

public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('badge_user');
        Schema::dropIfExists('badges');
        Schema::enableForeignKeyConstraints();
    }
};