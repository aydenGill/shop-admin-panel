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
            ProductSeeder::class,
            UserSeeder::class
        ]);

       User::factory()->create([
           "name" => "admin",
           "email" => "admin@shop.com",
           "password" => Hash::make('admin_admin'),
           "is_superuser" => 1,
           "is_staff" => 0
       ]);
    }
}
