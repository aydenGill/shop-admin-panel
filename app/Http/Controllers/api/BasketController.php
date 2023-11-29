<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BasketDeleteRequest;
use App\Http\Requests\BasketRequest;
use App\Models\Basket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function index(): JsonResponse
    {
        $baskets = Basket::query()->where('user_id', auth()->user()->id)->with('Product')->get();

        return response()->json([
            'result' => $baskets,
            'status' => true,
            'alert' => [
                'title' => 'success',
                'message' => 'Product successfully.'
            ]
        ]);

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

        return response()->json([
            'result' => null,
            'status' => true,
            'alert' => [
                'title' => 'success',
                'message' => 'Product added to the basket successfully.'
            ]
        ]);
    }


    public function delete(BasketDeleteRequest $request): JsonResponse
    {
        $basketItem = Basket::query()->where('id', $request->product)
            ->where('user_id', auth()->user()->id)
            ->first();

        if ($basketItem) {
            $basketItem->delete();

            return response()->json([
                'result' => null,
                'status' => true,
                'alert' => [
                    'title' => 'success',
                    'message' => 'Item removed from the basket.'
                ]
            ]);
        }

        return response()->json([
            'result' => null,
            'status' => true,
            'alert' => [
                'title' => 'success',
                'message' => 'Basket item not found or you do not have permission to delete it.'
            ]
        ]);

    }
}
