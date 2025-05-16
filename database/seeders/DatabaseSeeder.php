<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        User::create([
            'name' => 'Admin Dewa',
            'email' => 'super1@gmail.com',
            'password' => 'super123456',
            'phone' => '123456',
            'role' => 'super_admin',
        ]);

        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin1@gmail.com',
            'password' => 'admin123456',
            'phone' => '123456',
            'role' => 'admin',
        ]);

        // User
        User::create([
            'name' => 'Bento',
            'email' => 'user1@gmail.com',
            'password' => 'user123456',
            'phone' => '123456',
            'role' => 'user',
        ]);

        // Call other seeders
        $this->call([
            DestinationSeeder::class,
            ArticleSeeder::class,
            PromoSeeder::class,
        ]);
    }
}
