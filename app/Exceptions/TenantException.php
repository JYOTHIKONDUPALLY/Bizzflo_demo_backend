<?php
namespace App\Exceptions;

use Exception;

class TenantException extends Exception
{
    public static function notFound(): self
    {
        return new self('Tenant not found', 404);
    }

    public static function creationFailed(string $reason = ''): self
    {
        return new self('Failed to create tenant' . ($reason ? ': ' . $reason : ''), 422);
    }

    public static function updateFailed(string $reason = ''): self
    {
        return new self('Failed to update tenant' . ($reason ? ': ' . $reason : ''), 422);
    }
    public static function unauthorized(): self
    {
        return new self('Unauthorized',401);
    }
}