<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'additional_images' => 'array',
        'has_ticket' => 'boolean',
    ];

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }

    public function ticket(): HasOne
    {
        return $this->hasOne(Ticket::class);
    }
    public function hasTicket(): bool
    {
        return $this->ticket()->exists();
    }

    public function getAvailableTicket()
    {
        return $this->ticket()
                    ->where('stock', '>', 0)
                    ->whereNotNull('price')
                    ->where('price', '>', 0)
                    ->first();
    }
}
