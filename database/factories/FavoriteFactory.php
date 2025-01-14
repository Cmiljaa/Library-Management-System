<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FavoriteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'book_id' => \App\Models\Book::query()->inRandomOrder()->value('id'),
            'user_id' => \App\Models\User::query()->inRandomOrder()->value('id'),
        ];
    }
}
