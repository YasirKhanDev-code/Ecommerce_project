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
        Schema::create('carts', function (Blueprint $table) {
    $table->id();

    // user or guest session
    $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
    $table->string('session_id')->nullable();

    // totals and amounts
    $table->decimal('subtotal', 10, 2)->default(0);
    $table->decimal('discount', 10, 2)->default(0);
    $table->decimal('tax', 10, 2)->default(0);
    $table->decimal('shipping_cost', 10, 2)->default(0);
    $table->decimal('grand_total', 10, 2)->default(0);

    // coupon or discount code
    $table->string('coupon_code')->nullable();

    // cart status
    $table->enum('status', [
        'active',        // items being added
        'pending',       // waiting for checkout
        'checked_out',   // converted to order
        'abandoned'      // user left cart
    ])->default('active');

    // timestamps
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
