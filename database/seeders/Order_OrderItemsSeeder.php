<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\OrderItem;

class Order_OrderItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Order::create([
                'user_id' => 1, // Giả sử có 50 users
                'total_amount' => rand(100000, 5000000) / 100,
                'status' => rand(1, 2), // 1 = Pending, 2 = Processed
                'shipped_at' => now()->addDays(rand(1, 15))->format('Y-m-d H:i:s'),
            ]);
        }


        $orders = DB::table('orders')->pluck('order_id');

        foreach ($orders as $orderId) {
            for ($i = 0; $i < 1; $i++) { // Mỗi đơn có 1-5 sản phẩm
                OrderItem::create([
                    'order_id' => $orderId,
                    'product_id' => 1, // Giả sử có 100 sản phẩm
                    'size_id' => rand(1, 5), // Có 5 kích thước
                    'color_id' => rand(1, 5), // Có 5 màu sắc
                    'quantity' => rand(1, 10),
                    'unit_price' => rand(50000, 300000) / 100,
                ]);
            }
        }
    }
}
