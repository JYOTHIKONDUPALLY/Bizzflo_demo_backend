<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
    $table->uuid('id')->primary();

    $table->uuid('tenant_id');
    $table->uuid('customer_id');
    $table->uuid('product_id');

    $table->integer('quantity')->default(1);
    $table->decimal('unit_price', 10, 2);
    $table->decimal('subtotal', 10, 2);

    $table->timestamps();
    $table->softDeletes();

    $table->foreign('tenant_id')->references('tenant_id')->on('tenants')->onDelete('cascade');
    $table->foreign('customer_id')->references('customer_id')->on('customers')->onDelete('cascade');
    $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
