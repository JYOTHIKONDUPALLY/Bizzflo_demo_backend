<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\CartServiceInterface;
use App\Domains\Cart\Services\CartServices;

class CartServiceProvider extends ServiceProvider
{
    public function register()
    {
         $this->app->bind(CartServiceInterface::class, CartServices::class);
    }
}
    
?>