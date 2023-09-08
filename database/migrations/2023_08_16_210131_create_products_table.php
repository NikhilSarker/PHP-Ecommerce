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
            $table->integer('category_id');
            $table->integer('status')->nullable();
            $table->integer('subcategory_id');
            $table->integer('brand_id')->nullable();
            $table->string('product_name');
            $table->integer('price');
            $table->integer('discount')->nullable();
            $table->integer('after_discount');
            $table->string('tags');
            $table->string('short_description')->nullable();
            $table->longText('long_description');
            $table->string('additional_information')->nullable();
            $table->string('preview_image');
            $table->string('slug');
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
