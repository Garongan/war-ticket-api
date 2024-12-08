<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     * @method static \Illuminate\Http\JsonResponse common(string $message, array $data = [])
     */
    public function boot(): void
    {
        //
    }
}
