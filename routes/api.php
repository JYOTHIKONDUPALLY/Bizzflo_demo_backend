<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\AuthController;
use App\Http\Controllers\V1\ProductController;

Route ::prefix('business')->group(function () {
    Route ::post ('signUp', [AuthController::class, 'businessSignUp']);
    Route ::post ('login', [AuthController::class, 'businessLogin']);
    Route::middleware(['auth:sanctum'])->group(function () {
         Route::post ('logout', [AuthController::class,'businessLogout']);
        Route:: prefix('User')->middleware(['role:admin,Franchise Owner'])->group(function () {
        Route::post ('all', [AuthController::class,'businessUsersList']);
        });
    });
});

Route ::prefix('Customer')->group(function (){
    Route::post('signUp',[AuthController::class, 'customerSignup']);
    Route::post('login', [AuthController ::class, 'customerLogin']);
});

Route ::prefix('product')->middleware(['auth:sanctum'])->group(function () {
    Route::post('all',     [ProductController::class, 'ProductsList']);
    Route::middleware(['role:admin, Store Manager,Franchise Owner'])->group(function () {
    Route::post('create_or_update', [ProductController::class,'ProductCreateOrUpdate']);
    Route::delete('delete', [ProductController::class,'ProductDelete']);
    });
});
