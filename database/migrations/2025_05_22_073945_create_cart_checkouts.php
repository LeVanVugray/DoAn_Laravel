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
        Schema::create('cart_checkouts', function (Blueprint $table) {
            // Khóa chính cho bảng cart_checkouts
            $table->id('checkout_id');
            
            // Thay cart_id thành user_id - đây là khóa ngoại tham chiếu đến bảng users 
            $table->unsignedBigInteger('user_id');
            
            // Các thông tin của sản phẩm được chọn từ giỏ hàng:
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('size_id')->nullable();
            $table->unsignedBigInteger('color_id')->nullable();
            $table->integer('quantity');
            
            // Tạo các ràng buộc kết nối đến bảng liên quan:
            // Lưu ý: Trong migration của bảng user, khóa chính là 'user_id'
            $table->foreign('user_id')->references('user_id')->on('user')->onDelete('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')->onDelete('cascade');
            $table->foreign('size_id')->references('size_id')->on('sizes')->onDelete('cascade');
            $table->foreign('color_id')->references('color_id')->on('colors')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_checkouts');
    }
};
