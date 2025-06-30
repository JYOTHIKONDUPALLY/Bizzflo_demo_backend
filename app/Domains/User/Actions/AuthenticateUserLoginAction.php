<?php

namespace App\Domains\User\Actions;

use App\Domains\User\Models\User;
use Illuminator\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthenticateUserLoginAction
{
    public function handle($data)
    {
        try {
            $user = User::where('email', $data['email'])
                ->where('location_id', $data['location_id'])
                ->first();
            if (!$user) {
                return [
                    'error' => 'false',
                    'status' => 401,
                    'message' => 'UnAuthorized Access, InValid User',
                ];
            }

            if (!Hash::check($data['password'], $user->password_hash)) {
                return [
                    'error' => 'false',
                    'status' => 401,
                    'message' => 'UnAuthorized Access, InValid password',
                ];
            }
            $token = $user->createToken('business-token')->plainTextToken;

            return [
                'error' => 'false',
                'status' => 200,
                'message' => 'LoggedIn successfully',
                'data' => [
                    'token' => $token
                ]
            ];
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
