<?php
use Illuminate\Auth\AuthenticationException;

class MyHandler {
public function unauthenticated($request, AuthenticationException $exception)
{
    if ($request->expectsJson()) {
        return response()->json(['message' => 'Unauthenticated.'], 401);
    }

    return redirect()->guest(route('login'));
}
}

?>