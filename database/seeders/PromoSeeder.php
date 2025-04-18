<?php

// database/seeders/PromoSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Promo;

class PromoSeeder extends Seeder
{
    public function run()
    {
        Promo::create([
            'title' => 'Promo Akhir Tahun!',
            'details' => 'Dapatkan diskon hingga 50% untuk semua destinasi wisata.',
            'valid_until' => now()->addDays(7),
        ]);

        Promo::create([
            'title' => 'Liburan Musim Panas',
            'details' => 'Nikmati liburan seru dengan promo spesial musim panas.',
            'valid_until' => now()->addDays(10),
        ]);
    }
}

