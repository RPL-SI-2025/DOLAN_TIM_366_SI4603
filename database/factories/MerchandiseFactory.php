<?php

namespace Database\Factories;

use App\Models\Merchandise;
use Illuminate\Database\Eloquent\Factories\Factory;

class MerchandiseFactory extends Factory
{
    protected $model = Merchandise::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'price' => $this->faker->numberBetween(10000, 200000),
            'location' => $this->faker->city,
            'detail' => $this->faker->sentence,
            'size' => 'M,L,XL',
            'stock' => $this->faker->numberBetween(1, 100),
            'image' => 'default.jpg',
        ];
    }
}