<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Merchandise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'stock',
        'image',
        'detail',
        'size',
        'price',
        'location',
    ];

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
        } elseif ($this->stock <= 5) {
            return 'Low Stock';
        } else {
            return 'In Stock';
        }
    }

    public function getSizesArrayAttribute(): array
    {
        if (is_string($this->size)) {
            return array_map('trim', explode(',', $this->size));
        }
        return is_array($this->size) ? $this->size : [];
    }
}
