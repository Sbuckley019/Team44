<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('brief_description');
            $table->text('description');
            $table->decimal('price', 10, 2)->unsigned();
            $table->unsignedBigInteger('category_id');
            $table->integer('stock_quantity')->unsigned();
            $table->float('discount')->default('0');
            $table->string('image_url');
            $table->decimal('rating', 3, 1)->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('product_categories');
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
