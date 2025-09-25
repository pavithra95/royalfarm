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
            $table->string('product_name');
            $table->string('slug');
            $table->text('description')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('gallery_image')->nullable();
            $table->string('category_id')->nullable();
            $table->string('sub_category_id')->nullable();
            $table->string('variant_type')->nullable();
            $table->string('s_stock')->nullable();
            $table->string('v_stock')->nullable();
            $table->string('s_sku')->unique()->nullable();
            $table->string('s_price')->nullable();
            $table->string('s_discount_price')->default(0);
            $table->string('s_image')->nullable();
            $table->string('s_unit_id')->nullable();
            $table->string('s_status')->nullable();
            $table->string('s_weight')->nullable();
            $table->string('v_sku')->unique()->nullable();
            $table->string('v_status')->nullable();
            $table->timestamps();
        });

         Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->string('weight')->nullable(); // You mentioned a price field in your UI
            $table->string('price')->nullable(); // You mentioned a price field in your UI
            $table->string('discount_price')->default(0); // You mentioned a price field in your UI
            $table->string('image')->nullable(); // You mentioned a price field in your UI
            $table->string('status')->nullable(); // You mentioned a price field in your UI
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });

         Schema::create('product_variant_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('variation_id');
            $table->unsignedBigInteger('attribute_id'); 
            $table->string('value'); 
            $table->timestamps();
        
            // Foreign key to the variations table
            $table->foreign('variation_id')->references('id')->on('product_variants')->onDelete('cascade');
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
