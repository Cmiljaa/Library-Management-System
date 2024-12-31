<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'rating' => fake()->numberBetween(1, 5),
            'description' => fake()->paragraph(3),
            'created_at' => fake()->date()
        ];
    }
}
