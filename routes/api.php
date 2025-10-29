<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\{
    AuthController,
    ProductController,
    CartController,
    TenantController,
    UserController,
    OrderController,
    PaymentController,
    fflController
};


// Handle preflight requests

Route::get('tenants-with-locations', [TenantController::class, 'getTenantsWithLocations']);
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

Route::prefix('orders')->group(function () {
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

Route::prefix('pos')->middleware(['auth:users'])->group(function () {
    Route::post('cart/add', [OrderController::class, 'PlaceOrder']);
    Route::post('orders', [OrderController::class, 'placeorder']);
    Route::post('hold', [OrderController::class, 'holdOrder']);
    Route::post('hold/restore', [OrderController::class, 'restoreOrder']);
    Route::post('pay', [PaymentController::class, 'initiatePayment']);
    Route::post('invoice/{order_id} ', [OrderController::class, 'OrderSummary']);
    Route::post('orders/history', [OrderController::class, 'historyOrder']);
    Route::post('return', [PaymentController::class, 'refundPayment']);
    Route::post('stocks', [ProductController::class, 'getInventory']);
});

Route::prefix('ffl')->group(function () {
    Route::post('firearms', [fflController::class, 'AddFirearm']);
    Route::post('acquisition', [fflController::class,'Acquisition']);
    Route::post('logbook', [fflController::class, 'logbook']);
    Route::get('4473-forms', [fflController::class, 'forms']);
    Route::get('multiple-sales', [fflController::class, 'multipleSales']);
    Route::post('multiple-sales', [fflController::class, 'updateMultipleSales']);
    Route::get('firearms/{id}', [fflController::class, 'getFirearmStatus']);
    Route::get('{id}/history', [fflController::class, 'getHistory']);
});
