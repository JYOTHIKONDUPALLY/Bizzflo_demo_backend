<?php

namespace App\Providers;

use App\Domains\Admin\Models\admin;
use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
use App\Interface\{UserServiceInterface, FflServiceInterface,CustomerServiceInterface,AdminServiceInterface,OrderServiceInterface};
=======
use App\Interface\{UserServiceInterface, FflServiceInterface,CustomerServiceInterface,AdminServiceInterface,OrderServiceInterface,DashboardServiceInterface};
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
use App\Domains\User\Services\UserService;
use App\Domains\Customer\Services\CustomerService;
use App\Domains\Admin\Services\AdminService;
use Illuminate\Contracts\Debug\ExceptionHandler;
use App\Exceptions\Handler;
use App\Domains\Orders\services\OrderService;
use App\Domains\FFL\Services\fflServices;
<<<<<<< HEAD
=======
use App\Domains\Dashboard\Services\DashboardService;
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a

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
<<<<<<< HEAD
=======
        $this->app->bind(DashboardServiceInterface::class , DashboardService::class);
>>>>>>> 06caea9a819f808ad58d5ff3ac872d51153c422a
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
