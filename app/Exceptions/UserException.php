<?php

namespace App\Exceptions;

use Exception;

class UserException extends Exception
{
    public static function creationFailed(string $reason = ''): self
    {
        return new self('Failed to create user' . ($reason ? ': ' . $reason : ''), 422);
    }

    public static function notFound(): self
    {
        return new self('User not found', 404);
    }

    public static function unauthorized(): self
    {
        return new self('unAuthorized',401);
    }

    public static function accessDenied(): self
    {
        return new self('You are not Authorized to perform this action',403);
    }
}