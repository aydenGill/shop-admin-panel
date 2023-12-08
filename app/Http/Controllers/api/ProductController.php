<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Models\Category;
use App\Models\LikeProducts;
use App\Models\Product;
use App\Traits\BaseApiResponse;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;use Illuminate\Pagination\Paginator;


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
        $product = $product
            ->select('id', 'title', 'description', 'price', 'image', 'category_id')
            ->with('category:id,name,parent,icon')
            ->first();

        $product->likes = $this->calculateLikesForProduct($product->id);
        $product->isLike = $this->isProductLiked($product->id);
        $product->rate = $this->calculateRateForProduct($product->id);
        $product->category = $product->category;
        $product->comments = $this->getComments();

        $galleryImages = [
            'https://dkstatics-public.digikala.com/digikala-products/0795518309651e3dda9fde57c607389380138e41_1681912848.jpg',
            'https://dkstatics-public.digikala.com/digikala-products/db0cc3025e0cc1ce4b66facca2ada2d69a804a03_1681912853.jpg',
            'https://dkstatics-public.digikala.com/digikala-products/391e9ce961e2a603642be1cf1ce2a3c6c08cd43c_1681912851.jpg'
        ];

        $product->gallery = $galleryImages;

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

        $perPage = $request->has('per_page') ? (int)$request->input('per_page') : 15;
        $currentPage = $request->has('page') ? (int)$request->input('page') : 1;

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $products = $productsQuery->paginate($perPage);

        $categories = Category::query()->select('id','name','parent','icon')->get();

        $data = [
            'categories' => $categories,
            'products' => new ProductCollection($products),
            'pagination' => [
                'page_number' => $products->currentPage(),
                'total_rows' => $products->total(),
                'total_pages' => $products->lastPage(),
                'has_previous_page' => $products->previousPageUrl() !== null,
                'has_next_page' => $products->nextPageUrl() !== null,
            ]
        ];

        return $this->success($data);
    }

    private function getComments(): array
    {
        $comments = [
            [
                'user' => [
                    'first_name' => 'Soheil',
                    'last_name' => 'Khaledabadi',
                    'image' => 'https://images.unsplash.com/photo-1633332755192-727a05c4013d'
                ],
                'comment' => 'This product is amazing! I love it!',
                'create_at' => Carbon::now(),
                'rate' => 3.5
            ],
            [
                'user' => [
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'image' => 'https://images.unsplash.com/photo-1633332755192-727a05c4013d'
                ],
                'comment' => 'This product is amazing! I love it!',
                'create_at' => Carbon::now(),
                'rate' => 3.5
            ],
            [
                'user' => [
                    'first_name' => 'Alice',
                    'last_name' => 'Smith',
                    'image' => 'https://images.unsplash.com/photo-1633332755192-727a05c4013d'
                ],
                'comment' => 'This product is amazing! I love it!',
                'create_at' => Carbon::now(),
                'rate' => 3.5
            ],
            [
                'user' => [
                    'first_name' => 'Michael',
                    'last_name' => 'Johnson',
                    'image' => 'https://images.unsplash.com/photo-1633332755192-727a05c4013d'
                ],
                'comment' => 'This product is amazing! I love it!',
                'create_at' => Carbon::now(),
                'rate' => 3.5
            ],
            [
                'user' => [
                    'first_name' => 'Emily',
                    'last_name' => 'Williams',
                    'image' => 'https://images.unsplash.com/photo-1633332755192-727a05c4013d'
                ],
                'comment' => 'This product is amazing! I love it!',
                'create_at' => Carbon::now(),
                'rate' => 3.5
            ]
        ];

        return $comments;
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
