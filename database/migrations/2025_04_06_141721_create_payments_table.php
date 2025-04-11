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
        Schema::create('payments', function (Blueprint $table) {
            $table->id('payment_id');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->string('payment_method', 20);  // Ví dụ: "Credit Card", "PayPal"
            $table->tinyInteger('payment_status')->default(1); // 1 = success
            $table->timestamp('payment_date')->useCurrent();

            // Khóa ngoại
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
