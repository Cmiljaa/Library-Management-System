<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\BookLoan;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SettingSeeder::class,
            UserSeeder::class
        ]);

        $users = User::factory()->count(300)->create();

        Book::factory()->count(1000)->create()->each(function($book) use ($users) {
            $shuffledUsers = $users->shuffle($users)->take(rand(1, 4));

            $shuffledUsers->each(function ($user) use ($book) {
                Review::factory()->create([
                    'book_id' => $book->id,
                    'user_id' => $user->id
                ]);
            });
        });

        BookLoan::factory()->count(200)->create();

        Favorite::factory()->count(500)->create();
    }
}
