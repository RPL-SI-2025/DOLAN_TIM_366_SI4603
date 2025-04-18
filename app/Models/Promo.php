<?php

// app/Models/Promo.php
// app/Models/Promo.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi (fillable)
    protected $fillable = ['title', 'details', 'valid_until'];

    // Mengonversi valid_until menjadi objek Carbon
    protected $dates = ['valid_until'];

}