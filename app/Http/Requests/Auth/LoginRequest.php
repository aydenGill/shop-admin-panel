<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Validator;
use App\Traits\BaseApiResponse;
use App\Traits\FailValidaion;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;


class LoginRequest extends FormRequest
{
    use FailValidaion;
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|max:255|email',
            'password' => 'required'
        ];
    }
}
