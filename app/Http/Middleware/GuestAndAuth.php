<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class GuestAndAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return $next($request);
        }

        // return response()->json(['error' => 'Unauthorized'], 401);

        $user = Auth::guard('auth:api')->user();

        if (!$user) {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }

        return $next($request);
    }
}
