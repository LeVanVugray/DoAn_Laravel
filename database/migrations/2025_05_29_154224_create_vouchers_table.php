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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id('voucher_id');
            $table->string('code',20)->unique(); // Mã voucher
            $table->string('description')->nullable();//mô tả 
            $table->enum('discount_type', ['percent', 'fixed'])->nullable(); // Loại giảm giá
            $table->decimal('discount_value', 10, 2); // Giá trị giảm
            $table->decimal('max_discount', 10, 2)->nullable(); // Giảm tối đa nếu là %
            $table->decimal('min_order_value', 10, 2)->nullable(); // Đơn hàng tối thiểu
            $table->integer('quantity')->default(0); // Tổng số lượng
            $table->integer('used')->default(0); // Số lần đã dùng
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->tinyInteger('status')->default(1); // Có hiệu lực không
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};