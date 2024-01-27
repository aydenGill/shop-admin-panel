<?php

namespace App\Http\Requests\Comment;

use App\Traits\FailValidation;
use Illuminate\Foundation\Http\FormRequest;

class StoreComment extends FormRequest
{
    use FailValidation;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required|integer',
            'parent_id' => 'nullable|integer',
            'comment' => 'required|string',
            'rate' => 'required|integer',
        ];
    }
}
