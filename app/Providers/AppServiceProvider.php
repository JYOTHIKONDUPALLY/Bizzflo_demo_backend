<?php

namespace App\Providers;

use App\Domains\Admin\Models\admin;
use Illuminate\Support\ServiceProvider;
use App\Interface\{UserServiceInterface, FflServiceInterface,CustomerServiceInterface,AdminServiceInterface,OrderServiceInterface};
use App\Domains\User\Services\UserService;
use App\Domains\Customer\Services\CustomerService;
use App\Domains\Admin\Services\AdminService;
use Illuminate\Contracts\Debug\ExceptionHandler;
use App\Exceptions\Handler;
use App\Domains\Orders\services\OrderService;
use App\Domains\FFL\Services\fflServices;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(CustomerServiceInterface::class, CustomerService::class);
        $this->app->bind(AdminServiceInterface::class , AdminService::class);
        $this->app->singleton(ExceptionHandler::class,Handler::class);
        $this->app->bind(OrderServiceInterface:: class , OrderService::class);
        $this->app->bind(FflServiceInterface::class , fflServices::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
