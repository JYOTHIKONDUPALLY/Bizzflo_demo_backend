<?php 
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\UserServiceInterface;
use App\Domains\User\Services\AuthServices;

class AuthServiceProvider extends ServiceProvider
{
    public function register(){
       $this->app->bind(UserServiceInterface::class, AuthServices::class); 
    }

    public function boot(){
        $this->app->resolving('files', function () {
        throw new \Exception('Something is trying to resolve "files" - check stack trace');
    });  
    }
}