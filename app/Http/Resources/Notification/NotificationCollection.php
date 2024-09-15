<?php

namespace App\Http\Resources\Notification;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NotificationCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->map(function ($notification) {
            return [
                'id' => $notification->id,
                'title' => $notification->title,
                'description' => $notification->description,
                'is_read' => $notification->is_read,
                'created_at' => $notification->created_at,
            ];
        })->toArray();
    }
}
