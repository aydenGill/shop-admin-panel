<?php

namespace App\Http\Resources\Basket;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BasketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->product->id,
            'title' => $this->product->title,
            'description' => $this->product->description,
            'price' => $this->product->price,
            'image' => secure_asset('storage/'.$this->product->image),
            'count' => $this->count,
        ];
    }
}
