<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookLoan>
 */
class BookLoanFactory extends Factory
{
    
    public function definition(): array
    {
        return [
            'book_id' => \App\Models\Book::query()->inRandomOrder()->value('id'),
            'user_id' => \App\Models\User::query()->inRandomOrder()->value('id'),
            'borrow_date' => fake()->date(),
            'return_date' => fake()->boolean() ? fake()->date() : null,
            'status' => fake()->randomElement(array_keys(config('book.statuses')))
        ];
    }
}
