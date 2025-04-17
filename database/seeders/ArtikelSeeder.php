<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artikel;

class ArtikelSeeder extends Seeder
{
    public function run()
    {
        Artikel::create([
            'text' => 'Sample Article 1',
            'image' => 'images/artikel1.jpg',
            'user_id' => 1,
        ]);
        
        Artikel::create([
            'text' => 'Sample Article 2',
            'image' => 'images/artikel2.jpg',
            'user_id' => 1,
        ]);
    }
}
