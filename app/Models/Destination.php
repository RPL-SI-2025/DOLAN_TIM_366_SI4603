<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi (fillable)
    protected $fillable = ['name', 'description', 'image'];

    // Jika kamu ingin Laravel mengonversi 'created_at' dan 'updated_at' menjadi objek Carbon, 
    // kamu bisa menambahkannya pada $dates (untuk date, timestamp, atau datetime).
    protected $dates = ['created_at', 'updated_at'];

    // Menambahkan accessor atau mutator jika perlu untuk image
}