<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\ProductController;
use App\Http\Controllers\V1\CartController;

Route ::prefix('business')->group(function () {
    Route ::post ('signUp', [AuthController::class, 'businessSignUp']);
    Route ::post ('login', [AuthController::class, 'businessLogin']);
    Route::middleware(['auth.user'])->group(function () {
         Route::post ('logout', [AuthController::class,'businessLogout']);
        Route:: prefix('User')->middleware(['role:admin,Franchise Owner'])->group(function () {
        Route::post ('all', [AuthController::class,'businessUsersList']);
        });
    });
});

Route ::prefix('Customer')->group(function (){
    Route::post('signUp',[AuthController::class, 'customerSignup']);
    Route::post('login', [AuthController ::class, 'customerLogin']);
    Route::middleware(['auth.customer'])->group(function () {
         Route::post ('logout', [AuthController::class,'CustomerLogout']);
        Route::middleware(['role:admin,Franchise Owner'])->group(function () {
        Route::post ('all', [AuthController::class,'businessUsersList']);
        });
    });
});

Route ::prefix('product')->middleware(['auth.customer'])->group(function () {
    Route::post('all',     [ProductController::class, 'ProductsList']);
    Route::middleware(['role:admin, Store Manager,Franchise Owner'])->group(function () {
    Route::post('create_or_update', [ProductController::class,'ProductCreateOrUpdate']);
    Route::delete('delete', [ProductController::class,'ProductDelete']);
    });
});

Route ::prefix('cart')->middleware(['auth:customer'])->group(function () {
    Route::post('all', [CartController::class,'GetCart']);
    Route::post('add', [CartController::class,'AddToCart']);
    Route::post('update', [CartController::class,'UpdateCart']);
    Route::post('clear', [CartController::class,'RemoveFromCart']);
});

