<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'image' => asset('storage/'.auth()->user()->profile_photo_path),
            ],
            'id' => $this->id,
            'comment' => $this->comment,
            'created_at' => $this->created_at,
            'rate' => $this->rate,
        ];
    }
}
