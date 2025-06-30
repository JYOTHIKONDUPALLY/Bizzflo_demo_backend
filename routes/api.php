<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\{
    AuthController,
    ProductController,
    CartController,
    TenantController,
    UserController,
    OrderController,
    PaymentController
};


Route::prefix("Admin")->group(function () {
    Route::post('login', [AuthController::class, 'AdminLogin']);
    Route::middleware('auth:Admin')->group(function () {
        Route::post('logout', [AuthController::class, 'AdminLogout']);
        Route::post('tenants-with-locations', [TenantController::class, 'getTenantsWithLocations']);
        Route::prefix('tenants')->group(function () {
            Route::post('create', [TenantController::class, 'createTenant']);
            Route::post('{tenant_id}/update', [TenantController::class, 'tenantUpdate']);
            Route::post('{tenant_id}/deactivate', [TenantController::class, 'deactivateTenant']);
            Route::post('{tenant_id}/location/create', [TenantController::class, 'tenantLocation']);
            Route::post('location/{location_id}/update', [TenantController::class, 'tenantLocationUpdate']);
        });
    });
});

Route::prefix('business')->group(function () {

    Route::post('login', [AuthController::class, 'businessLogin']);

    Route::middleware(\App\Http\Middleware\AuthenticateUser::class)->group(function () {
        Route::post('logout', [AuthController::class, 'businessLogout']);
        Route::middleware(['role:Admin,Franchise Owner'])->group(function () {
            Route::post('register', [AuthController::class, 'businessSignUp']);
        });
    });

    Route::prefix('User')->middleware(['auth:users', 'role:Admin, Franchise Owner'])->group(function () {
        Route::post('all', [UserController::class, 'businessUsersList']);
        Route::post('{user_id}/update', [UserController::class, 'UpdateUser']);
    });
});

Route::prefix('Customer')->group(function () {
    Route::post('signUp', [AuthController::class, 'customerSignup']);
    Route::post('login', [AuthController::class, 'customerLogin']);
    Route::middleware(['auth.customer'])->group(function () {
        Route::post('logout', [AuthController::class, 'CustomerLogout']);
        Route::middleware(['role:Admin,Franchise Owner'])->group(function () {
            Route::post('all', [AuthController::class, 'businessUsersList']);
        });
    });
});

Route::prefix('product')->group(function () {
    Route::middleware(['auth:users', 'role:Franchise Owner, Store Manager'])->group(function () {
        Route::post('create_or_update', [ProductController::class, 'ProductCreateOrUpdate']);
        // Route::delete('delete', [ProductController::class, 'ProductDelete']);
    });
    Route::post('all', [ProductController::class, 'ProductsList']);
});

Route::prefix('category')->group(function () {
    //  Route::post('all', [CategoryController::class,'CategoryList']);
    Route::middleware(['auth:users', 'role:Franchise Owner, Store Manager'])->group(function () {
        // Route::post('create_or_update', [CategoryController::class,'CategoryCreateOrUpdate']);
    });
});

Route::prefix('inventory')->group(function () {
    Route::middleware(['auth:users', 'role:Franchise Owner, Store Manager'])->group(function () {
        Route::post('add', [ProductController::class, 'AddInventory']);
        Route::post('{inventory_id}/update', [ProductController::class, 'UpdateInventory']);
    });
});


Route::prefix('cart')->middleware(['auth:customer,users'])->group(function () {
    Route::post('all', [CartController::class, 'GetCart']);
    Route::post('add', [CartController::class, 'AddToCart']);
    Route::post('update', [CartController::class, 'UpdateCart']);
    Route::post('clear', [CartController::class, 'RemoveFromCart']);
    Route::post('checkout', [CartController::class, 'CheckoutFromCart']);
});

Route::prefix('orders')->middleware(['auth:customer,users', 'role:Franchise Owner, Store Manager'])->group(function () {
    Route::post('all', [OrderController::class, 'OrdersList']);
    Route::post('{order_id}/place_order', [OrderController::class, 'PlaceOrder']);
    Route::post('{order_id}/summary', [OrderController::class, 'OrderSummary']);
    Route::post('{order_id}/cancel', [OrderController::class, 'CancelOrder']);
});

Route::prefix('payment')->middleware(['auth:customer'])->group(function () {
    Route::post('initiate', [PaymentController::class, 'InitiatePayment']);
    Route::post('confirm', [PaymentController::class, 'ConfirmPayment']);
    Route::post('history', [PaymentController::class, 'PaymentHistory']);
    Route::post('status', [PaymentController::class, 'paymentStatus']);
    Route::post('Refund', [PaymentController::class, 'RefundPayment']);
});
