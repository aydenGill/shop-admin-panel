<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::query()->truncate();

        $categories = [
            ['name' => 'Computer', 'icon' => '', 'parent' => 0],
            ['name' => 'Electronics', 'icon' => '', 'parent' => 0],
            ['name' => 'Arts & Crafts', 'icon' => '', 'parent' => 0],
            ['name' => 'Automotive', 'icon' => '', 'parent' => 0],
            ['name' => 'Baby', 'icon' => '', 'parent' => 0],
            ['name' => 'Beauty and personal care', 'icon' => '', 'parent' => 0],
            ['name' => 'Women\'s Fashion', 'icon' => '', 'parent' => 0],
            ['name' => 'Men\'s Fashion', 'icon' => '', 'parent' => 0],
            ['name' => 'Health and Household', 'icon' => '', 'parent' => 0],
            ['name' => 'Home and Kitchen', 'icon' => '', 'parent' => 0],
            ['name' => 'Industrial and Scientific', 'icon' => '', 'parent' => 0],
            ['name' => 'Luggage', 'icon' => '', 'parent' => 0],
            ['name' => 'Movies & Television', 'icon' => '', 'parent' => 0],
            ['name' => 'Pet supplies', 'icon' => '', 'parent' => 0],
            ['name' => 'Sports and Outdoors', 'icon' => '', 'parent' => 0],
            ['name' => 'Tools & Home Improvement', 'icon' => '', 'parent' => 0],
            ['name' => 'Toys and Games', 'icon' => '', 'parent' => 0],
        ];

        foreach ($categories as $category) {
            Category::query()->create($category);
        }
    }
}
