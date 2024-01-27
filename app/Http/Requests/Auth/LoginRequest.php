<?php

namespace App\Http\Requests\Auth;

use App\Traits\FailValidation;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use FailValidation;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|max:255|email',
            'password' => 'required',
        ];
    }
}
