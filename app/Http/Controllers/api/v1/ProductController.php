<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Product\wishListCollection;
use App\Models\Category;
use App\Models\LikeProducts;
use App\Models\Product;
use App\Traits\BaseApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ProductController extends Controller
{
    use BaseApiResponse;

    public function index(): JsonResponse
    {
        $products = Product::all();

        return $this->success($products);
    }

    public function show(Product $product): JsonResponse
    {
        $product->likes = $this->calculateLikesForProduct($product->id);
        $product->isLike = $this->isProductLiked($product->id);
        $product->rate = $this->calculateRateForProduct($product->id);
        $product->category = $product->category;
        $product->comments = CommentResource::collection($this->getComments($product));
        $product->gallery = $product->galleries()->pluck('image')->map(function ($item) {
            return secure_asset('storage/'.$item);
        });

        return $this->success($product);
    }

    public function wishlist(Request $request): JsonResponse
    {
        $productsQuery = auth()->user()->likedProducts()->with('product');

        if ($request->has('category_id')) {
            $productsQuery->whereHas('product', function ($query) use ($request) {
                $query->where('category_id', $request->input('category_id'));
            });
        }

        $perPage = $request->has('per_page') ? (int) $request->input('per_page') : 15;
        $currentPage = $request->has('page') ? (int) $request->input('page') : 1;

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $products = $productsQuery->paginate($perPage);

        $categories = Category::query()->select('id', 'name', 'parent', 'icon')->get();

        $data = [
            'categories' => $categories,
            'products' => new wishListCollection($products),
            'pagination' => [
                'page_number' => $products->currentPage(),
                'total_rows' => $products->total(),
                'total_pages' => $products->lastPage(),
                'has_previous_page' => $products->previousPageUrl() !== null,
                'has_next_page' => $products->nextPageUrl() !== null,
            ],
        ];

        return $this->success($data);
    }

    private function getComments($product)
    {
        return $product->comments()->select('id', 'comment', 'created_at', 'user_id')->with('user:id,name,profile_photo_path')->get();
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
