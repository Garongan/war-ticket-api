<?php

namespace App\Http\Controllers;

use App\Utils\CommonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    private $commonResponse;

    public function __construct(CommonResponse $commonResponse)
    {
        $this->commonResponse = $commonResponse;
    }

    public function login()
    {
        $validators = Validator::make(request(['email', 'password']), [
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8']
        ]);

        if ($validators->fails()) {
            return $this->commonResponse->commonResponse(401, ['message' => $validators->errors()]);
        }

        $credentials = request(['email', 'password']);

        if (! $token = Auth::attempt($credentials)) {
            return $this->commonResponse->commonResponse(401, ['message' => 'Unauthorized']);
        }

        return $this->respondWithToken(200, $token);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(200, Auth::refresh());
    }

    public function logout()
    {
        Auth::logout();
        return $this->commonResponse->commonResponse(200, ['message' => 'Logout successfull']);
    }

    protected function respondWithToken($statusCode, $token)
    {
        return $this->commonResponse->commonResponse($statusCode, [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => Auth::factory()->getTTL() * 60
        ]);
    }
}
