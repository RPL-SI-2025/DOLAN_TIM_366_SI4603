<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'name',
        'description',
        'location',
        'image',
        'stock',
        'price',
        'additional_images'
    ];

    protected $casts = [
        'additional_images' => 'array', // Casting additional_images menjadi array
    ];
}
