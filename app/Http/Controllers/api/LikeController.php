<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\LikeProducts;
use App\Models\Product;

class LikeController extends Controller
{
    public function likeProduct(Product $product)
    {
        $userId = auth()->id();

        $existingLike = LikeProducts::query()->where('product_id', $product->id)
            ->where('user_id', $userId)
            ->first();

        if ($existingLike) {
            $existingLike->delete();

            return response()->json([
                'result' => null,
                'status' => true,
                'alert' => [
                    'title' => 'Success',
                    'message' => 'Product unliked successfully'
                ]
            ]);
        }

        LikeProducts::create([
            'product_id' => $product->id,
            'user_id' => $userId,
        ]);

        return response()->json([
            'result' => null,
            'status' => true,
            'alert' => [
                'title' => 'Success',
                'message' => 'Product liked successfully'
            ]
        ]);
    }
}
