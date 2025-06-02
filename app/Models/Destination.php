<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name', 
        'description', 
        'location', 
        'image',
        'additional_images',
        'tour_includes',
        'tour_payments',
        'has_ticket',
        'status',
        'category'
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
    }
  
    public function ticket(): HasOne
    {
        return $this->hasOne(Ticket::class);
    }
    
    public function hasTicket(): bool
    {
        return $this->ticket()->exists();
    }

    public function getPriceAttribute()
    {
        return $this->ticket ? $this->ticket->price : 0;
    }

    public function getStockAttribute()
    {
        return $this->ticket ? $this->ticket->stock : 0;
    }

    public function getAvailableTicket()
    {
        return $this->ticket()->where('stock', '>', 0)->first();
    }

    public function user()
{
    return $this->belongsTo(User::class);
}
}