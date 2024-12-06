<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Review;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'email' => 'test@example.com',
        ]);

        User::factory()->count(10)->create();

        Book::factory()->count(100)->create()->each(function($book){
            Review::factory()->count(rand(1, 4))->create([
                'book_id' => $book->id
            ]);
        });
    }
}
