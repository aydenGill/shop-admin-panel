<?php

namespace App\Http\Requests\Basket;

use App\Traits\FailValidation;
use Illuminate\Foundation\Http\FormRequest;

class BasketDeleteRequest extends FormRequest
{

    use FailValidation;

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
