<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthenticateCustomer
{
    public function handle($request, Closure $next)
    {
        dd('i am here');
        if (!Auth::guard('customer')->check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
?>