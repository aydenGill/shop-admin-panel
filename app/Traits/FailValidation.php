<?php

namespace App\Traits;

use App\Http\Requests\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait FailValidation
{
    public function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'result' => null,
            'status' => false,
            'alert' => [
                'title' => 'Error',
                'message' => 'validation error , please fill data currently',
            ],
        ], 400));
    }
}
