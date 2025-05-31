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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->tinyInteger('status')->default(1); // 1 = pending
            $table->timestamp('shipped_at')->nullable();
            $table->timestamps();
            $table->string("payment");

            // Khóa ngoại
            $table->foreign('user_id')
            ->references('user_id')
            ->on('user')
            ->onDelete('set null');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
