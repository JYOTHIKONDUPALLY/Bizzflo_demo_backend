<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\OrderServiceInterface;
use App\Domains\Orders\services\OrderService;

class OrderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
    }
}