<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Basket\BasketDeleteRequest;
use App\Http\Requests\Basket\BasketRequest;
use App\Models\Basket;
use App\Traits\BaseApiResponse;
use Illuminate\Http\JsonResponse;

class BasketController extends Controller
{
    use BaseApiResponse;

    public function index(): JsonResponse
    {
        $baskets = Basket::query()->where('user_id', auth()->user()->id)->with('Product')->get();

        return $this->success($baskets, 'success', 'Product successfully.');
    }

    public function add(BasketRequest $request): JsonResponse
    {
        $userId = auth()->user()->id;

        $existingBasket = Basket::query()->where('user_id', $userId)
            ->where('product_id', $request['product'])
            ->first();

        if ($existingBasket) {
            $existingBasket->count += $request['count'];
            $existingBasket->save();
        } else {
            Basket::query()->create([
                'user_id' => $userId,
                'product_id' => $request['product'],
                'count' => $request['count'],
            ]);
        }

        return $this->success(null, 'success', 'Product added to the basket successfully.');
    }

    public function delete(BasketDeleteRequest $request): JsonResponse
    {
        $basketItem = Basket::query()->where('id', $request->product)
            ->where('user_id', auth()->user()->id)
            ->first();

        if ($basketItem) {
            $basketItem->delete();

            return $this->success(null, 'success', 'Item removed from the basket.');
        }

        return $this->success(null, 'success', 'Basket item not found or you do not have permission to delete it.');
    }
}
