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
    $table->id();

    // link with cart and product
    $table->foreignId('cart_id')->constrained()->onDelete('cascade');
    $table->foreignId('product_id')->constrained()->onDelete('cascade');

    // variants (color, size, etc.)
    $table->json('variant_data')->nullable();  // Example: {"color": "Red", "size": "XL"}

    // pricing
    $table->integer('quantity')->default(1);
    $table->decimal('unit_price', 10, 2);   // price per item
    $table->decimal('subtotal', 10, 2);     // unit_price * quantity

    // stock snapshot at add time (optional)
    $table->integer('available_stock')->nullable();

    // timestamps
    $table->timestamps();
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
