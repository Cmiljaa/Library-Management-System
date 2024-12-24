<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookLoan>
 */
class BookLoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'book_id' => fake()->numberBetween(1, 100),
            'user_id' => fake()->numberBetween(1, 30),
            'pickup_date' => fake()->date(),
            'return_date' => fake()->boolean() ? fake()->date() : null,
            'status' => fake()->randomElement(array_keys(config('book.statuses')))
        ];
    }
}
