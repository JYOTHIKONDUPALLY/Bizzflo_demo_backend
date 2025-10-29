<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interface\ProductServiceInterface;
use App\Domains\Products\Services\ProductServices;


class ProductServiceProvider extends ServiceProvider 
{
    public function register() {
        $this->app->bind(ProductServiceInterface::class, ProductServices::class);
    }
    
    public function boot() {
         $this->app->resolving('files', function () {
        throw new \Exception('Something is trying to resolve "files" - check stack trace');
    });
    }
}
?>