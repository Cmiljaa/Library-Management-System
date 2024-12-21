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
        $users = [
            ['email' => 'admin@example.com', 'role' => 'admin'],
            ['email' => 'librarian@example.com', 'role' => 'librarian'],
            ['email' => 'member@example.com', 'role' => 'member'],
        ];
        
        foreach ($users as $user) {
            User::factory()->create($user);
        }

        $users = User::factory()->count(30)->create();

        Book::factory()->count(100)->create()->each(function($book) use ($users) {
            $shuffledUsers = $users->shuffle()->take(rand(1, 4));

            $shuffledUsers->each(function ($user) use ($book) {
                Review::factory()->create([
                    'book_id' => $book->id,
                    'user_id' => $user->id
                ]);
            });
        });
    }
}
