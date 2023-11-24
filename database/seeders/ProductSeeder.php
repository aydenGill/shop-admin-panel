<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::query()->truncate();


        $products = [
          [   'user_id' => 1,
              'title' => 'Nike model-934',
              'slug' => 'nike-model-934',
              'description' => 'Nike model-934',
              'price' => 120,
              'category_id' => 1,
              'image' => 'https://www.deadstock.de/wp-content/uploads/2023/01/Jordan-1-Mid-Barely-Grape-DQ8423-501-dead-stock-titel-bild-.jpeg',
              'inventory' => 10,
              'view_count' => 10
          ],
            [   'user_id' => 1,
                'title' => 'Nike model-934',
                'slug' => 'nike-model-934',
                'description' => 'Nike model-934',
                'price' => 120,
                'category_id' => 2,
                'image' => 'https://www.deadstock.de/wp-content/uploads/2023/01/Jordan-1-Mid-Barely-Grape-DQ8423-501-dead-stock-titel-bild-.jpeg',
                'inventory' => 10,
                'view_count' => 10
            ],
            [   'user_id' => 1,
                'title' => 'Nike model-934',
                'slug' => 'nike-model-934',
                'description' => 'Nike model-934',
                'price' => 120,
                'category_id' => 3,
                'image' => 'https://www.deadstock.de/wp-content/uploads/2023/01/Jordan-1-Mid-Barely-Grape-DQ8423-501-dead-stock-titel-bild-.jpeg',
                'inventory' => 10,
                'view_count' => 10
            ],
            [   'user_id' => 1,
                'title' => 'Shirt model-131',
                'slug' => 'shirt-model-131',
                'description' => 'Shirt model-131',
                'price' => 13,
                'category_id' => 4,
                'image' => 'https://img.ltwebstatic.com/images3_pi/2022/08/22/1661139363d0af2b9ebc4be1a701c62b3af5e237ef.webp',
                'inventory' => 10,
                'view_count' => 10
            ],
        ];

        foreach ($products as $productData) {
            Product::query()->create($productData);
            // You Can Use This Code For Use relation many to many =>
            // $categories = Category::inRandomOrder()->take(rand(1, 2))->get();

            // foreach ($categories as $category) {
            //     $product->categories()->attach($category->id);
            // }
        }
    }
}
