<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\LikeProducts;
use App\Models\Product;
use App\Traits\BaseApiResponse;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use MongoDB\Driver\Exception\EncryptionException;

class HomeController extends Controller
{
    use BaseApiResponse;
    public function index(): JsonResponse
    {
        try {
            $banners = Banner::query()->select('id','banner')->get();

            $products = Product::query()->select('id','title','description','price','image')->get();

            foreach ($products as $product) {
                $product->likes = $this->calculateLikesForProduct($product->id);
                $product->isLike = $this->isProductLiked($product->id);
                $product->rate = $this->calculateRateForProduct($product->id);
            }


            $categories = Category::query()->select('id','name','parent','icon')->get();

            return $this->success([
                'banners' => $banners,
                'categories' => $categories,
                'newest_product' => $products,
                'flash_sale' => [
                    'expired_at' => Carbon::now()->addDays(5),
                    'products' => $products
                ],
                'most_sale' => $products
            ]);

        }catch (EncryptionException $exception){
            return $this->failed($exception->getMessage(),'Error','Error from server');
        }
    }


    private function calculateLikesForProduct($productId): int
    {
        return LikeProducts::query()->where('product_id', $productId)->count();
    }

    private function isProductLiked($productId): bool
    {
        return LikeProducts::query()->where('product_id', $productId)
            ->where('user_id', auth()->user()->id)
            ->exists();
    }

    private function calculateRateForProduct($productId): float
    {
        return 3.5;
    }

}
