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
            ['name' => 'Clothes' , 'icon' => '' , 'parent' => 0],
            ['name' => 'Computer' , 'icon' => '','parent' => 0],
            ['name' => 'Shoes' , 'icon' => '', 'parent' => 0],
           [ 'name' => 'Watch' , 'icon' => '' , 'parent' => 0],
           [ 'name' => 'Mobile' , 'icon' => '','parent' => 0]
        ];

        foreach ($categories as $category) {
            Category::query()->create($category);
        }
    }
}
