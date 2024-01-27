<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class wishListCollection extends ResourceCollection
{
    public function toArray(Request $request): array
    {
        $productsData = $this->collection->map(function ($likeProduct) {
            $product = $likeProduct->product;

            return [
                'id' => $product->id,
                'title' => $product->title,
                'description' => $product->description,
                'price' => $product->price,
                'image' => $product->image,
                'likes' => 10,
                'isLike' => true,
                'rate' => 3.5,
            ];
        });

        return $productsData->toArray();
    }
}
