<?php
namespace App\Exceptions;

use Exception;

class ProductException  extends Exception
{
    public static function notFound(): self
    {
        return new self('Product not found', 404);
    }

    public static function creationFailed(string $reason = ''): self
    {
        return new self('Failed to create Product' . ($reason ? ': ' . $reason : ''), 422);
    }

    public static function updateFailed(string $reason = ''): self
    {
        return new self('Failed to update Product' . ($reason ? ': ' . $reason : ''), 422);
    }
    public static function unauthorized(): self
    {
        return new self('Unauthorized',401);
    }
      public static function accessDenied(): self
    {
        return new self('You are not Authorized to perform this action',403);
    }

    public static function unabelToAddToCart(): self
    {
        return new self('Something went wrong, unable to add the product to cart. Try after some time',500);
    }

    public static function EmptyCart(): self
    {
        return new self('No items in cart',200);
    } 

    public static function OutOfStock(): self
    {
        return new self('Product is out of stock', 200);
    }
  
}