<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Badge;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $badges = [
            [
                'id' => 1,
                'name' => 'First Steps Badge',
                'description' => 'Diperoleh setelah mengumpulkan 10 poin.',
                'icon' => 'images/icons/badge-1.png', 
            ],
            [
                'id' => 2,
                'name' => 'Silver Badge',
                'description' => 'Diperoleh setelah mengumpulkan 100 poin.',
                'icon' => 'images/icons/badge-2.png',
            ],
            [
                'id' => 3,
                'name' => 'Gold Badge',
                'description' => 'Diperoleh setelah mengumpulkan 200 poin.',
                'icon' => 'images/icons/badge-3.png',
            ],
        ];

        foreach ($badges as $badge) {
            Badge::updateOrCreate(['id' => $badge['id']], $badge);
        }
    }
}