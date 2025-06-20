<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\UserServiceInterface;
use App\Domains\User\Services\UserService;
use App\Interface\CustomerServiceInterface;
use App\Domains\Customer\Services\CustomerService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(CustomerServiceInterface::class, CustomerService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
