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
            $table->id('product_id'); // Khóa chính
            $table->string('name'); // Tên sản phẩm
            $table->text('description')->nullable(); // Mô tả sản phẩm
            $table->decimal('price', 10, 2); // Giá sản phẩm
            $table->unsignedBigInteger('category_id')->nullable(); // Khóa ngoại tham chiếu đến bảng categories
            $table->unsignedBigInteger('manu_id')->nullable(); // Khóa ngoại tham chiếu đến bảng categories
            $table->string('image')->nullable(); // Thêm cột image, có thể null
            $table->timestamps(); // Thời gian tạo và cập nhật
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->foreign('manu_id')->references('manu_id')->on('manufactures')->onDelete('cascade');
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
