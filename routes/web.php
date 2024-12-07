<?php

use App\Http\Controllers\AuthController;
use App\Utils\CommonResponse;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/csrf-token', function (CommonResponse $commonResponse) {
    return $commonResponse->commonResponse(200, ['csrf-token' => csrf_token()]);
});
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
