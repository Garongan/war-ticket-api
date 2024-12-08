<?php

use App\Utils\CommonResponse;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('api/auth/csrf-token', function (CommonResponse $commonResponse) {
    return $commonResponse->commonResponse(200, ['csrf-token' => csrf_token()]);
});