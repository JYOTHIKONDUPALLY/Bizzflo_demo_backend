<?php

namespace App\Domains\User\Actions;

use App\Domains\User\Models\User;
<<<<<<< HEAD
use Illuminator\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
=======
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\UserException;
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a

class AuthenticateUserLoginAction
{
    public function handle($data)
    {
        try {
            $user = User::where('email', $data['email'])
<<<<<<< HEAD
                // ->where('location_id', $data['location_id'])
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
=======
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
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
        }
    }
}
