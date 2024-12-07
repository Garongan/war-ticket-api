<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Utils\CommonResponse;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController
{
    /**
     * 
     * register user
     * 
     */
    public function register(Request $request, CommonResponse $commonResponse)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return $commonResponse->commonResponse(201, ['message' => 'User registered successfully']);
    }

    public function login(Request $request, CommonResponse $commonResponse)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8'
        ]);

        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $commonResponse->commonResponse(401, ['message' => 'Unauthorized']);
            }
        } catch (JWTException) {
            return $commonResponse->commonResponse(500, ['message' => 'Token created unsuccessfully']);
        }

        return $commonResponse->commonResponse(200, ['token' => $token]);
    }

    public function logout(CommonResponse $commonResponse)
    {
        Auth::logout();
        return $commonResponse->commonResponse(200, ['message' => 'Logout successfull']);
    }
}
