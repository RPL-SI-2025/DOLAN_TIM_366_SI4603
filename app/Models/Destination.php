<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
        'image',
        'stock',
        'price',
        'additional_images',
        'tour_includes',
        'tour_payments',
        'has_ticket'
    ];

    protected $casts = [
        'additional_images' => 'array', // Casting additional_images menjadi array
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    public function tickets(): HasOne
    {
        return $this->hasOne(Ticket::class);
    }
}
