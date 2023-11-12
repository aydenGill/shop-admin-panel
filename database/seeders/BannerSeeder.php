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
            ['banner' => '', 'alt' => '', 'link' => '', 'expired_at' => Carbon::now(), 'is_enable' => 1]
        ];

        foreach ($banners as $banner) {
            Banner::query()->create($banner);
        }
    }
}
