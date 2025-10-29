<?php

namespace App\Exceptions;
use Exception;

class OrderException extends Exception
{
    public static function notFound(): self
    {
        return new self('Order not found', 404);
    }
    public static function invalidOrder(): self
    {
        return new self('Invalid Order', 400);
    }
    public static function unableToCheckOut(): self
    {
        return new self('Unable to checkout',422);
    }
}