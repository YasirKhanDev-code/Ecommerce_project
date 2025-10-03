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
        Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');                  // Product name (e.g., "Blue T-Shirt")
    $table->string('slug')->unique();        // SEO-friendly product URL
    $table->text('description')->nullable(); // Product description
    $table->decimal('price', 10, 2);         // Current price
    $table->decimal('old_price', 10, 2)->nullable(); // Discount price (optional)
    $table->integer('stock')->default(0);    // Stock quantity
    $table->string('sku')->unique()->nullable(); // Product code
    $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Link to category
    $table->string('image')->nullable();     // Main product image
    $table->boolean('status')->default(true); // Active / Inactive
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
