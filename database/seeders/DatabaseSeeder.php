<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Faculty;
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
        User::query()->updateOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User']
        );

        Faculty::query()->delete();
        Faculty::create(['name' => 'Jay Wyndel Bagsic']);
    }
}
