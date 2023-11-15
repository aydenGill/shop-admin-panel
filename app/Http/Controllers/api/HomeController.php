<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\LikeProducts;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use MongoDB\Driver\Exception\EncryptionException;

class HomeController extends Controller
{
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

            foreach($categories as $category){
                $category->icon =  asset('storage/'.$category->icon);
            }

            return response()->json(['result' => [
                'banners' => $banners,
                'categories' => $categories,
                'flash_sale' => $products,
                'newest_product' => [
                    'expired_at' => Carbon::now()->addDays(5),
                    'products' => $products
                ],
                'most_sale' => $products
            ] , 'status' => true,'alert' => null ]);

        }catch (EncryptionException $exception){
            return response()->json(['result' => $exception->getMessage() , 'status' => false ,'alert' => ['title' => 'Error' , 'message' => 'Error form server']], 500);
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
