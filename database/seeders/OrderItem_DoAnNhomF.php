<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderItem_DoAnNhomF extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset bảng order_items
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('order_items')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('order_items')->insert([
            [
                'order_id'   => 1,    
                'product_id' => 1,    // Sản phẩm #1 (Nike Air Max)
                'size_id'    => 1,    // Size 36
                'color_id'   => 1,    // Màu Đỏ
                'quantity'   => 2,
                'unit_price' => 3590000.00,
            ],
            [
                'order_id'   => 1,   
                'product_id' => 3,    // Sản phẩm #3 (Puma Suede)
                'size_id'    => 2,    // Size 37
                'color_id'   => 2,    // Màu Xanh dương
                'quantity'   => 1,
                'unit_price' => 2590000.00,
            ],
            [
                'order_id'   => 2,    
                'product_id' => 2,    // Sản phẩm #2 (Adidas Ultraboost)
                'size_id'    => 5,    // Size 40
                'color_id'   => 3,    // Màu Xanh lá
                'quantity'   => 1,
                'unit_price' => 1800000.00,
            ],
        ]);
    }
}
