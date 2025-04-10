<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Destination;

class DestinationSeeder extends Seeder
{
    public function run()
    {
        Destination::create([
            'name' => 'Jawa',
            'description' => 'Jelajahi keindahan pulau Jawa yang kaya akan budaya dan alam.',
            'image' => 'images/image-jawa.jpg',
        ]);
        
        Destination::create([
            'name' => 'Sumatera',
            'description' => 'Nikmati pesona alam Sumatera dengan berbagai wisata alamnya.',
            'image' => 'images/image-sumatera.jpg',
        ]);

        Destination::create([
            'name' => 'Kalimantan',
            'description' => 'Nikmati pesona alam Kalimantan dengan berbagai wisata alamnya.',
            'image' => 'images/image-sumatera.jpg',
        ]);

        Destination::create([
            'name' => 'Sulawesi',
            'description' => 'Nikmati pesona alam Sumatera dengan berbagai wisata alamnya.',
            'image' => 'images/image-sumatera.jpg',
        ]);

        Destination::create([
            'name' => 'Papua',
            'description' => 'Nikmati pesona alam Sumatera dengan berbagai wisata alamnya.',
            'image' => 'images/image-sumatera.jpg',
        ]);
        
        Destination::create([
            'name' => 'Bali',
            'description' => 'Jelajahi keindahan pulau Jawa yang kaya akan budaya dan alam.',
            'image' => 'images/image-jawa.jpg',
        ]);
        
        Destination::create([
            'name' => 'Ambon',
            'description' => 'Nikmati pesona alam Sumatera dengan berbagai wisata alamnya.',
            'image' => 'images/image-sumatera.jpg',
        ]);

        Destination::create([
            'name' => 'Kalimantan',
            'description' => 'Nikmati pesona alam Kalimantan dengan berbagai wisata alamnya.',
            'image' => 'images/image-sumatera.jpg',
        ]);

        Destination::create([
            'name' => 'Maluku',
            'description' => 'Nikmati pesona alam Sumatera dengan berbagai wisata alamnya.',
            'image' => 'images/image-sumatera.jpg',
        ]);

        Destination::create([
            'name' => 'Lombok',
            'description' => 'Nikmati pesona alam Sumatera dengan berbagai wisata alamnya.',
            'image' => 'images/image-sumatera.jpg',
        ]);
    }
}
