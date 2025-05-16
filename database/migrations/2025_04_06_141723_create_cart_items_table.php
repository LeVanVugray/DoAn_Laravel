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
            $table->id('cart_items_id');
            $table->integer('user_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->integer('quantity')->default(0);
            
            $table->integer('check')->default(0);

           
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
