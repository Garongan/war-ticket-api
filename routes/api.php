<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\UserRole;
use App\Utils\CommonResponse;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::group([
        'prefix' => 'auth'
    ], function ($router) {
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh-token');
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    });

    // User Controller
    Route::resource('users', UserController::class)->except(['show'])->middleware('role:' . UserRole::Admin->value)->missing(function (CommonResponse $commonResponse) {
        return $commonResponse->commonResponse(404, ['message' => 'Route not found']);
    });
});
