<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vouchers')->insert([
            [
               'code' => 'SALE10',
                'description' => 'Giảm 10% cho đơn hàng từ 200K',
                'discount_type' => 'percent',
                'discount_value' => 10,
                'max_discount' => 50000,
                'min_order_value' => 0,
                'quantity' => 100,
                'used' => 0,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(10),
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'FIX50K',
                'description' => 'Giảm trực tiếp 50K',
                'discount_type' => 'fixed',
                'discount_value' => 50000,
                'max_discount' => 50000,
                'min_order_value' => 100000,
                'quantity' => 50,
                'used' => 0,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(7),
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}