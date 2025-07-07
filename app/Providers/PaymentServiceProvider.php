<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\PaymentServiceInterface;
use App\Domains\Payment\Services\PaymentService;

class OrderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(PaymentServiceInterface::class, PaymentService::class);
    }
}