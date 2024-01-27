<?php

namespace App\Http\Requests\Basket;

use App\Traits\FailValidaion;
use Illuminate\Foundation\Http\FormRequest;

class BasketDeleteRequest extends FormRequest
{
    use FailValidaion;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'product' => ['required', 'exists:products,id'],
        ];
    }
}
