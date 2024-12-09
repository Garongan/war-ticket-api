<?php

namespace App\Http\Middleware;

use App\Utils\CommonResponse;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    private $commonResponse;

    public function __construct(CommonResponse $commonResponse)
    {
        $this->commonResponse = $commonResponse;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();
        if ($user == null) {
            return $this->commonResponse->commonResponse(400, ['message' => 'Invalid token']);
        }
        if ($user->role->value !== $role) {
            return $this->commonResponse->commonResponse(403, ['message' => 'Access Forbidden']);
        }

        return $next($request);
    }
}
