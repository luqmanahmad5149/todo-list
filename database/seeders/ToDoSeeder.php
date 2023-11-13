<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToDoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example: Create 25 users with 10 tasks for each user.
        User::factory()
            ->count(25)
            ->hasTasks(10)
            ->create();

        // Example: Create 10 users without task.
        User::factory()
            ->count(10)
            ->create();
    }
}