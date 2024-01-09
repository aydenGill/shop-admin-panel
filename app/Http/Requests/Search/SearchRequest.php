<?php

namespace App\Http\Requests\Search;

use App\Traits\FailValidaion;
use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    use FailValidaion;
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|gte:min_price',
            'categories_id' => 'nullable|array|regex:/^(\d+,)*\d+$/',
            'page' => 'nullable|numeric|min:1',
        ];
    }
}
