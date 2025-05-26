<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


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

    public function tickets(): HasOne
    {
        return $this->hasOne(Ticket::class);
    }
}
