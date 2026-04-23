<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'description' => fake()->sentence(),
            'price_per_day' => fake()->numberBetween(1000, 10000),
            'category' => 'Power Tools',
            'user_id' => User::factory(), 
        ];
    }
}