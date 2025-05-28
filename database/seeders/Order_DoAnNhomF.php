<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Order_DoAnNhomF extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạm tắt kiểm tra khóa ngoại và reset bảng
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('orders')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Chèn 2 đơn hàng mẫu
        DB::table('orders')->insert([
            [
                'user_id'      => 1,           
                'total_amount' => 500000,      
                'status'       => 1,           // 1 = pending
                'shipped_at'   => null,       
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'user_id'      => 2,          
                'total_amount' => 1200000,     
                'status'       => 2,           // 2 = processing 
                'shipped_at'   => now()->addDay(), 
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
        
    }
}
