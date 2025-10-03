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
        Schema::create('categories', function (Blueprint $table) {
    $table->id();
    $table->string('name');             // Category name (e.g., "Men", "Shoes")
    $table->string('slug')->unique();   // SEO-friendly URL (e.g., "men-shoes")
    $table->text('description')->nullable(); // Optional category description
    $table->string('image')->nullable(); // For category banner/icon (optional)
    $table->foreignId('parent_id')->nullable()->constrained('categories'); // For sub-categories
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
