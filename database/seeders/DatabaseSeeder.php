<?php

namespace Database\Seeders;

use App\Models\Announcement;
use App\Models\Category;
use App\Models\Photo;
use App\Models\Transaction;
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
        // User::factory(50)->create();
        // Announcement::factory(50)->create();
        // Category::factory(10)->create();
        // Photo::factory(50)->create();
        // Transaction::factory(50)->create();


        User::factory()->create([
            'name' => 'exauce',
            'email' => 'exaucebodi4@gmail.com',
            'password' => 'password'
        ]);
    }
}
