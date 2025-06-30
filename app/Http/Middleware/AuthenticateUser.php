<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
    public function handle($request, Closure $next)
    {
        // if (!Auth::guard('users')->check()) {
        //     return response()->json(['message' => 'Unauthorized'], 401);
        // }
         if (!Auth::guard('users')->check()) {
            return response()->json([
                'error' => true,
                'status' => 401,
                'message' => 'Unauthorized'
            ], 401);
        }

        return $next($request);
    }
}
?>