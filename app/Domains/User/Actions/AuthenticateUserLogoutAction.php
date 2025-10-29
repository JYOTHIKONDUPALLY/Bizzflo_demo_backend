<?php

namespace App\Domains\User\Actions;

use App\Domains\User\Models\User;
use Illuminate\Http\Request;

class AuthenticateUserLogoutAction
{
    public function handle(Request $request)
    {
        try {
            $user = $request->user();
            if ($user) {
                $user->currentAccessToken()->delete();
                return "Logout successfully";
            }
            return "UnAuthorized Access";
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
