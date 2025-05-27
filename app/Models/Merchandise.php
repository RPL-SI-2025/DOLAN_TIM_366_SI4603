<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    protected $casts = [
        'size' => 'array', // Jika size disimpan sebagai JSON array
    ];
}
