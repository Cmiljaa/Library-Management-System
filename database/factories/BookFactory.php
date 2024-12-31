<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(6),
            'genre' => fake()->randomElement(array_keys(config('book.genres'))),
            'author' => fake()->name(),
            'description' => fake()->paragraph(),
            'language' => fake()->randomElement(array_keys(config('book.languages')))
        ];
    }
}
