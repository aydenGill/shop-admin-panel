<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\StoreComment;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Product;
use App\Traits\BaseApiResponse;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    use BaseApiResponse;

    public function index(Product $product): JsonResponse
    {
        return $this->success(CommentResource::collection($this->getComments($product)));
    }

    public function store(StoreComment $request): JsonResponse
    {
        auth()->user()->comments()->create($request->validated());
        return $this->success(null, 'Comment', 'It is registered successfully');
    }

    private function getComments(Product $product): Collection
    {
        return $product->comments()->select('id', 'comment', 'created_at', 'rate', 'user_id')->with('user:id,name,profile_photo_path')->get();
    }
}
