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
            'image' => 'destinations/pantai_kuta.jpg',  // Pastikan file gambar sudah ada di public/storage
            'additional_images' => json_encode([
                'destinations/pantai_kuta.jpg',
                'destinations/pantai_kuta.jpg',
            ]),
            'stock' => 100,
            'price' => 250000,
        ]);

        Destination::create([
            'name' => 'Gunung Bromo',
            'description' => 'Gunung berapi yang aktif di Jawa Timur, Indonesia, terkenal dengan pemandangan matahari terbitnya.',
            'location' => 'Probolinggo, Jawa Timur, Indonesia',
            'image' => 'destinations/gunung_bromo.jpg',  // Pastikan file gambar sudah ada di public/storage
            'additional_images' => json_encode([
                'destinations/gunung_bromo.jpg',
                'destinations/gunung_bromo.jpg',
            ]),
            'stock' => 50,
            'price' => 350000,
        ]);

        Destination::create([
            'name' => 'Danau Toba',
            'description' => 'Danau vulkanik terbesar di Indonesia, dengan pemandangan yang luar biasa dan pulau di tengahnya.',
            'location' => 'Sumatera Utara, Indonesia',
            'image' => 'destinations/danau_toba.jpg',  
            'additional_images' => json_encode([
                'destinations/danau_toba.jpg',
                'destinations/danau_toba.jpg',
            ]),
            'stock' => 75,
            'price' => 300000,
        ]);
        
        // Tambahkan data lainnya sesuai kebutuhan
    }
}
