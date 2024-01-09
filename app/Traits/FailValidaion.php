<?php
namespace App\Traits;


use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\Validator;

trait FailValidaion
{
    public function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'result' => null,
            'status'   => false,
            'alert'   => [
                'title' => 'Error',
                'message' => 'validation error , please fill data currently'
            ],
        ] , 400));
    }
}

