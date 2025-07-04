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
        Schema::create('destinations', function (Blueprint $table) {
            $table->id();
            // Tambahkan kolom user_id dan definisikan relasinya
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->string('name');
            $table->text('description');
            $table->string('location');
            $table->string('image')->nullable();
            $table->integer('stock')->default(0); // jumlah tiket tersedia
            $table->decimal('price', 10, 2)->default(0); // harga tiket
            $table->string('status')->nullable(); // tambahkan kolom status

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinations');
    }
};