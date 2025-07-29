<?php

namespace App\Domains\User\Actions;

use App\Domains\User\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\UserException;

class AuthenticateUserLoginAction
{
    public function handle($data)
    {
        try {
            $user = User::where('email', $data['email'])
                ->where('tenant_id', $data['tenant_id'])
                ->where('location_id', $data['location_id'])
                ->first();

            if (!$user) {
                 throw UserException::notFound();
            }

            if (!Hash::check($data['password'], $user->password_hash)) {
              throw UserException::unauthorized();
            }

            $token = $user->createToken('business-token')->plainTextToken;

            return [
                    'token' => $token,
                    'user' => [  
                        'name' => $user->full_name,
                        'email' => $user->email,
                        'role' => $user->role->role_name,
                         'tenant' => $user->tenant->name,
                    'location' => $user->location->name??null,
                    ],
                ];
        } catch (UserException $e) {
            throw $e;
        } catch (\Throwable $e) {
            throw $e->getMessage();
        }
    }
}
