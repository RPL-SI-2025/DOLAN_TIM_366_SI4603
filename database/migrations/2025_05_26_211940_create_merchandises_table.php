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
    Schema::create('merchandises', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('detail');
        $table->decimal('price', 19, 0); // Harga merchandise
        $table->integer('stock'); // Jumlah stock merchandise
        $table->string('location'); // Lokasi merchandise
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User ID yang membuat merchandise
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('merchandises');
    }
};
