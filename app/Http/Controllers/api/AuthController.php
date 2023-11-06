<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Login(LoginRequest $request): JsonResponse
    {
        try {
            $user = User::query()->select('id','email','password')->where('email', $request->input('email'))->first();

            if (!$user || !Hash::check($request->input('password'), $user->password)) {
                return response()->json(['result' => null , 'status' => false,'alert' => ['title' => 'Invalid' , 'message' => 'Invalid credentials']],401);
            }

            $token = $user->createToken('token_base_name')->plainTextToken;
            return response()->json(['result' => $token , 'status' => true,'alert' => ['title' => 'Login' , 'message' => 'Login successful']]);
        } catch (Exception $exception) {
            return response()->json(['result' => $exception->getMessage() , 'status' => false,'alert' => ['title' => 'Error' , 'message' => 'Error form server']], 500);
        }
    }

    public function Register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = User::query()
                ->select('id')
                    ->create($request->all());
            $token = $user->createToken('token_base_name')->plainTextToken;
            return response()->json(['result' => $token , 'status' => true,'alert' => ['title' => 'Registration' , 'message' => 'Registration successful']]);

        } catch (Exception $exception) {
            return response()->json(['result' => $exception->getMessage() , 'status' => false,'alert' => ['title' => 'Error' , 'message' => 'Error form server']], 500);
        }
    }
}
