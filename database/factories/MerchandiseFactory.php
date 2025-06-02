<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MerchandiseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'stock' => $this->faker->numberBetween(0, 100),
            'image' => null, // atau 'merchandise-images/dummy.jpg'
            'detail' => $this->faker->sentence(10),
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL']),
            'price' => $this->faker->randomFloat(2, 10000, 500000),
            'location' => $this->faker->city,
        ];
    }
}