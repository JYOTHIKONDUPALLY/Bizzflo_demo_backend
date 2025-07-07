<?php

namespace App\Domains\User\Actions;

use Exception;
use App\Domains\User\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\UserException;

use Illuminate\Auth\AuthenticationException;

class UpdateUserAction
{
    public function handle($request, $userId)
    {
        try {
            $User = Auth::guard('users')->user();
            if (!$User) {
                throw new AuthenticationException("UnAuthorized Access");
            }
            $user = User::findOrFail($userId);
            $user->update($request);
            return $user;
        } catch (AuthenticationException $e) {
            throw $e;
        } catch (UserException $e) {
            throw $e;
        } catch (\Throwable $e) {
            throw UserException::creationFailed($e->getMessage());
        }
    }
}
