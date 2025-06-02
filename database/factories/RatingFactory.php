<?php
// filepath: database/factories/RatingFactory.php

namespace Database\Factories;

use App\Models\Rating;
use App\Models\User;
use App\Models\Destination;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingFactory extends Factory
{
    protected $model = Rating::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'destination_id' => Destination::factory(),
            'rating' => $this->faker->numberBetween(1, 5),
            'feedback' => $this->faker->paragraph(),
        ];
    }
}