<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class BannerSeeder extends Seeder
{
    /**
     * .Run the database seeds
     */
    public function run(): void
    {

        Banner::query()->truncate();

        $banners = [
            ['banner' => 'https://m.media-amazon.com/images/I/614VOsGXsqL._SX1500_.jpg', 'alt' => 'amazon image', 'link' => 'shop.soheilkhaledabadi.ir', 'expired_at' => Carbon::now(), 'is_enable' => 1],
            ['banner' => 'https://m.media-amazon.com/images/I/71kFc7PP3PL._SX3000_.jpg', 'alt' => 'amazon image', 'link' => 'shop.soheilkhaledabadi.ir', 'expired_at' => Carbon::now(), 'is_enable' => 1],
            ['banner' => 'https://m.media-amazon.com/images/I/717Qv6Rdi+L._SX3000_.jpg', 'alt' => 'amazon image', 'link' => 'shop.soheilkhaledabadi.ir', 'expired_at' => Carbon::now(), 'is_enable' => 1],
        ];

        foreach ($banners as $banner) {
            Banner::query()->create($banner);
        }
    }
}
