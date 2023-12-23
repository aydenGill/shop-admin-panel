<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Traits\BaseApiResponse;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    use BaseApiResponse;
    public function index(): JsonResponse
    {
        return $this->success([
            'name' => auth()->user()->name,
            'profile_url'=> asset('storage/'.auth()->user()->profile_photo_path)
        ]);
    }
}
