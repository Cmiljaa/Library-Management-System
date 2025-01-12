<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = [
            ['email' => 'admin@example.com', 'role' => 'admin'],
            ['email' => 'librarian@example.com', 'role' => 'librarian'],
            ['email' => 'member@example.com', 'role' => 'member'],
        ];
        
        foreach ($users as $user) {
            User::factory()->create($user);
        }
    }
}
