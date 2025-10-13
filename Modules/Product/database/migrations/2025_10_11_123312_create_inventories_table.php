<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();

            // Link to product
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');

            // Unique SKU for stock management
            $table->string('sku')->unique();

            // Attribute combination (color, size etc.)
            $table->json('attribute_value_ids')->nullable();

            // Stock quantity
            $table->integer('quantity')->default(0);

            // Price for this variant
            $table->decimal('price', 10, 2)->nullable();

            // Optional warehouse/location
            $table->string('location')->nullable();

            // Status
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
