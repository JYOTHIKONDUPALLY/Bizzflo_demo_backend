<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    // First, find and drop the existing unique constraint
    DB::statement('ALTER TABLE customers DROP INDEX email');
    
    // Or if the constraint name is different:
    // DB::statement('ALTER TABLE customers DROP INDEX customers_email_unique');
    
    // Add composite unique constraint
    Schema::table('customers', function (Blueprint $table) {
        $table->unique(['email', 'tenant_id'], 'customers_email_tenant_unique');
    });
}

public function down()
{
    Schema::table('customers', function (Blueprint $table) {
        $table->dropUnique('customers_email_tenant_unique');
        $table->unique('email');
    });
}
};
