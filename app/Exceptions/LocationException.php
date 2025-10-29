<?php
namespace App\Exceptions;

use Exception;

class LocationException extends Exception
{
    public static function creationFailed(string $reason = ''): self
    {
        return new self('Failed to create location' . ($reason ? ': ' . $reason : ''), 422);
    }
}