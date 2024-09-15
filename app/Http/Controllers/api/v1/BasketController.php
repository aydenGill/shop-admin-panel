<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Basket\BasketBuyRequest;
use App\Http\Requests\Basket\BasketDeleteRequest;
use App\Http\Requests\Basket\BasketRequest;
use App\Http\Resources\Basket\BasketResource;
use App\Models\Basket;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Traits\BaseApiResponse;
use Illuminate\Http\JsonResponse;

class BasketController extends Controller
{
    use BaseApiResponse;

    public function index(): JsonResponse
    {
        $baskets = auth()->user()->baskets()
            ->where('status', 'created')
            ->with('product')->get();

        return $this->success(BasketResource::collection($baskets), 'success', 'Product successfully.');
    }

    public function add(BasketRequest $request): JsonResponse
    {
        $userId = auth()->user()->id;

        $existingBasket = Basket::query()
            ->where('status', 'created')
            ->where('user_id', $userId)
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

        auth()->user()->notifications()->create([
            'title' => 'Product added to the basket',
            'description' => 'Product added to the basket successfully',
        ]);
        
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

    public function buy(BasketBuyRequest $request): JsonResponse
    {
        $validated = $request->validated();
        if (auth()->user()->baskets()->where('status', 'created')->count() == 0) {
            return $this->success(null, 'Empty', 'Your shopping cart is empty');
        }
        $products = auth()->user()->baskets()->where('status', 'created')->get();

        auth()->user()->baskets()->where('status', 'created')->update([
            'status' => 'paid',
        ]);

        $method = '';
        switch ($validated['shipping_type']) {
            case 0:
                $method = 'economy';
            case 1:
                $method = 'regular';
            case 1:
                $method = 'cargo';
            case 1:
                $method = 'express';
        }

        $order = Order::query()->create([
            'code' => rand(),
            'user_id' => auth()->user()->id,
            'address_id' => $validated['address_id'],
            'method' => $method,
        ]);

        foreach ($products as $product) {
            OrderProduct::query()->create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'count' => $product->count,
            ]);
        }

        return $this->success(null, 'Success', 'Your purchase was successful');
    }
}
