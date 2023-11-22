<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            CategoriesSeeder::class,
            BannerSeeder::class,
            ProductSeeder::class
        ]);

       User::factory()->create([
           "name" => "admin",
           "email" => "admin@shop.com",
           "password" => '$2y$12$c9TusWL6Bgs56fH9Y7Hj5.h7Ntqk2qvM3aspyrgBBf3OXZObVEzFm',
           "is_superuser" => 1,
           "is_staff" => 0
       ]);
    }
}
