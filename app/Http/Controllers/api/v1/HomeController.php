<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Search\SearchRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Profile\AddressResource;
use App\Models\Banner;
use App\Models\Category;
use App\Models\LikeProducts;
use App\Models\Product;
use App\Traits\BaseApiResponse;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Pagination\Paginator;
use MongoDB\Driver\Exception\EncryptionException;

class HomeController extends Controller
{
    use BaseApiResponse;

    public function index(): JsonResponse
    {
        try {
            $banners = Banner::query()->select('id', 'banner')->get();

            $products = Product::query()->select('id', 'title', 'description', 'price', 'image')->get();

            foreach ($products as $product) {
                $product->likes = $this->calculateLikesForProduct($product->id);
                $product->isLike = $this->isProductLiked($product->id);
                $product->rate = $this->calculateRateForProduct($product->id);
            }

            $categories = Category::query()->select('id', 'name', 'parent', 'icon')->get();
            $address = auth()->user()->address()->first() ? new AddressResource(auth()->user()->address()->first()) : null;

            return $this->success([
                'banners' => $banners,
                'categories' => $categories,
                'newest_product' => $products,
                'address' => $address,
                'flash_sale' => [
                    'expired_at' => Carbon::now()->addDays(5),
                    'products' => $products,
                ],
                'most_sale' => $products,
            ]);
        } catch (EncryptionException $exception) {
            return $this->failed($exception->getMessage(), 'Error', 'Error from server');
        }
    }

    public function filter(): JsonResponse
    {
        try {
            $get_min_price = Product::query()->min('price');
            $get_max_price = Product::query()->max('price');
            $categories = Category::query()->select('id', 'name', 'parent', 'icon')->get();

            return $this->success([
                'min_price' => $get_min_price,
                'max_price' => $get_max_price,
                'categories' => $categories,
            ]);
        } catch (\Exception $exception) {
            return $this->failed($exception->getMessage(), 'Error', 'Error from server');
        }
    }

    public function search(SearchRequest $request): JsonResponse
    {
        $validatedData = $request->validated();

        $productsQuery = Product::query();

        if ($request->has('categories_id')) {
            $productsQuery->whereIn('category_id', explode(',', $validatedData['categories_id']));
        }

        if ($request->has('min_price')) {
            $productsQuery->where('price', '>=', $validatedData['min_price']);
        }

        if ($request->has('max_price')) {
            $productsQuery->where('price', '<=', $validatedData['max_price']);
        }

        if ($request->has('sort')) {
            if ($validatedData['sort'] == '0') {
                $productsQuery->orderBy('created_at', 'asc');
            } elseif ($validatedData['sort'] == '1') {
                $productsQuery->orderBy('created_at', 'desc');
            } elseif ($validatedData['sort'] == '2') {
                $productsQuery->orderBy('price', 'desc');
            } elseif ($validatedData['sort'] == '3') {
                $productsQuery->orderBy('price', 'asc');
            } elseif ($validatedData['sort'] == '4') {
                $productsQuery->orderBy('view_count', 'desc');
            } elseif ($validatedData['sort'] == '5') {
                $productsQuery->orderBy('view_count', 'asc');
            }
        }

        $perPage = $request->input('per_page', 15);
        $currentPage = $request->input('page', 1);

        Paginator::currentPageResolver(fn () => $currentPage);

        $products = $productsQuery->paginate((int) $perPage);

        $paginationData = [
            'page_number' => $products->currentPage(),
            'total_rows' => $products->total(),
            'total_pages' => $products->lastPage(),
            'has_previous_page' => $products->previousPageUrl() !== null,
            'has_next_page' => $products->nextPageUrl() !== null,
        ];

        return $this->success([
            'products' => new ProductCollection($products),
            'pagination' => $paginationData,
        ]);
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
