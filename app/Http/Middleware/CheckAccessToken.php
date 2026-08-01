<?php

namespace App\Http\Middleware;

use Closure;

class CheckAccessToken
{
    public function handle($request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        if (!auth()->guard('api')->check()) {
            return response()->json(['error' => 'Invalid token'], 401);
        }

        return $next($request);
    }
}
