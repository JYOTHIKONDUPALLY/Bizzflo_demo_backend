<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateAdmin
{
    public function handle($request, Closure $next)
    {
        if (!Auth::guard('admin')->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
?>