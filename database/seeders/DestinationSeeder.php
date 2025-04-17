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
            'stock' => 100,
            'price' => 250000,
        ]);

        Destination::create([
            'name' => 'Gunung Bromo',
            'description' => 'Gunung berapi yang aktif di Jawa Timur, Indonesia, terkenal dengan pemandangan matahari terbitnya.',
            'location' => 'Probolinggo, Jawa Timur, Indonesia',
            'image' => 'destinations/gunung_bromo.jpg',  // Pastikan file gambar sudah ada di public/storage
            'stock' => 50,
            'price' => 350000,
        ]);

        Destination::create([
            'name' => 'Danau Toba',
            'description' => 'Danau vulkanik terbesar di Indonesia, dengan pemandangan yang luar biasa dan pulau di tengahnya.',
            'location' => 'Sumatera Utara, Indonesia',
            'image' => 'destinations/danau_toba.jpg',  // Pastikan file gambar sudah ada di public/storage
            'stock' => 75,
            'price' => 300000,
        ]);

        // Tambahkan data lainnya sesuai kebutuhan
    }
}
