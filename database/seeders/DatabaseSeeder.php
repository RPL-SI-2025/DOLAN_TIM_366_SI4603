<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menjalankan seeders UserSeeder & ArtikelSeeder
        $this->call([
            UserSeeder::class,
            ArtikelSeeder::class,
        ]);

        // Atau bikin satu user tambahan secara manual
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
