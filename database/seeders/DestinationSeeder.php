<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan data dummy untuk destinasi
        Destination::create([
            'name' => 'Pantai Kuta',
            'description' => 'Pantai yang terkenal dengan pasir putihnya yang indah dan ombak yang cocok untuk surfing.',
            'location' => 'Bali, Indonesia',
            'image' => 'images/destinations/pantai_kuta.jpg',  
            'additional_images' => [
                'images/additional_destinations/pantai_kuta_1.jpg',
                'images/additional_destinations/pantai_kuta_2.jpg',
            ],
            'stock' => 100,
            'price' => 250000,
            'has_ticket' => true,
        ]);

        Destination::create([
            'name' => 'Gunung Bromo',
            'description' => 'Gunung berapi yang aktif di Jawa Timur, Indonesia, terkenal dengan pemandangan matahari terbitnya.',
            'location' => 'Probolinggo, Jawa Timur, Indonesia',
            'image' => 'images/destinations/gunung_bromo.jpg',  
            'additional_images' => [
                'images/additional_destinations/gunung_bromo_1.jpg',
                'images/additional_destinations/gunung_bromo_2.jpg',
            ],
            'stock' => 50,
            'price' => 350000,
            'has_ticket' => true,
        ]);

        Destination::create([
            'name' => 'Danau Toba',
            'description' => 'Danau vulkanik terbesar di Indonesia, dengan pemandangan yang luar biasa dan pulau di tengahnya.',
            'location' => 'Sumatera Utara, Indonesia',
            'image' => 'images/destinations/danau_toba.jpg',  // Path baru untuk gambar utama
            'additional_images' => [
                'images/additional_destinations/danau_toba_1.jpg',
                'images/additional_destinations/danau_toba_2.jpg',
            ],
            'stock' => 75,
            'price' => 300000,
            'has_ticket' => false,
        ]);
        
        // Tambahkan data lainnya sesuai kebutuhan
    }
}