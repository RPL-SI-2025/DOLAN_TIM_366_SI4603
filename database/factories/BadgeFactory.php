<?php

namespace Database\Factories;

use App\Models\Badge;
use Illuminate\Database\Eloquent\Factories\Factory;

class BadgeFactory extends Factory
{
    protected $model = Badge::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->sentence(),
            'icon' => 'badge.png',
            'required_point' => $this->faker->numberBetween(0, 100),
        ];
    }
}
