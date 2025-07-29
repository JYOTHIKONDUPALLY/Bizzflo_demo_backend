<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Handle unauthenticated requests.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request): ?string
    {
        if ($request->is('api/*') || $request->expectsJson()) {
            // dd("reached autheticate.php");
            return null;
        }
        // if (! $request->expectsJson()) {
        //     // For browser/web app fallback
        //     return route('login');
        // }

        // For API clients (Postman, frontend apps)
        return response()->json([
            'error' => true,
            'status' => 401,
            'message' => 'Unauthorized. Please log in again.',
            'timestamp' => now()->toISOString(),
            'path' => $request->path(),
        ], 401);
    }
}
