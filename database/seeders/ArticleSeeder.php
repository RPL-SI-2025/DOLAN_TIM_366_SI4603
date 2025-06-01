<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        Article::create([
            'title' => 'Wisata Alam di Bali',
            'text' => 'Wisata Alam di Bali',
            'image' => 'artikel/pantai_kuta.jpg',
        ]);
        
    }
}
