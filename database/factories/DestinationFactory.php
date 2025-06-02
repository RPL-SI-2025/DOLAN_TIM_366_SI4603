<?php
// filepath: database/factories/DestinationFactory.php

namespace Database\Factories;

use App\Models\Destination;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DestinationFactory extends Factory
{
    protected $model = Destination::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(),
            'location' => $this->faker->city(),
            'image' => 'test-image.jpg',
            'additional_images' => [],
            'tour_includes' => $this->faker->paragraph(),
            'tour_payments' => $this->faker->paragraph(),
            'has_ticket' => true,
            'status' => 'approved',
            'category' => $this->faker->randomElement(['adventure', 'cultural', 'nature', 'beach'])
        ];
    }
}