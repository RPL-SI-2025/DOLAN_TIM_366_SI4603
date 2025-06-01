<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Ticket extends Model
{
    protected $fillable = [
        'ticket_name',
        'price',
        'destination_id',
        'stock',
    ];

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }

    public function orders(): MorphMany
    {
        return $this->morphMany(Order::class, 'product');
    }

    public function isAvailable($quantity = 1): bool
    {
        return $this->stock >= $quantity;
    }

    public function reduceStock($quantity): bool
    {
        if ($this->stock >= $quantity) {
            $this->decrement('stock', $quantity);
            return true;
        }
        return false;
    }

    public function getStockStatusAttribute(): string
    {
        if ($this->stock <= 0) {
            return 'Out of Stock';
        } elseif ($this->stock <= 10) {
            return 'Low Stock';
        } else {
            return 'In Stock';
        }
    }
}
