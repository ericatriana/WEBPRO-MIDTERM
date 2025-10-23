<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a test user for development
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password') // password: "password"
        ]);

        // Create another test user with different email
        User::factory()->create([
            'name' => 'Erica Triana',
            'email' => 'erica@example.com',
            'password' => bcrypt('password123')
        ]);
    }
}
