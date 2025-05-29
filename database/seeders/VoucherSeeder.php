<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('vouchers')->insert([
        //     [
        //         'code' => 'SALE10',
        //         'description' => 'Giảm 10% cho đơn hàng từ 200K',
        //         'discount_type' => 'percent',
        //         'discount_value' => 10,
        //         'max_discount' => 50000,
        //         'min_order_value' => 200000,
        //         'quantity' => 100,
        //         'used' => 0,
        //         'start_date' => Carbon::now(),
        //         'end_date' => Carbon::now()->addDays(10),
        //         'status' => true,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        //     [
        //         'code' => 'FIX50K',
        //         'description' => 'Giảm trực tiếp 50K',
        //         'discount_type' => 'fixed',
        //         'discount_value' => 50000,
        //         'max_discount' => 50000,
        //         'min_order_value' => 100000,
        //         'quantity' => 50,
        //         'used' => 0,
        //         'start_date' => Carbon::now(),
        //         'end_date' => Carbon::now()->addDays(7),
        //         'status' => true,
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]
        // ]);


        $now = now();
        $vouchers = [];

        for ($i = 0; $i < 100; $i++) {
            // Random loại giảm giá
            $isPercent = rand(0, 1) === 1;

            $discountType = $isPercent ? 'percent' : 'fixed';
            $discountValue = $isPercent ? rand(5, 20) : rand(20000, 100000); // phần trăm hoặc tiền
            $maxDiscount = $isPercent ? rand(30000, 100000) : null; // chỉ cần nếu là percent

            $vouchers[] = [
                'code' => 'VC' . strtoupper(Str::random(6)), // ví dụ: VC4JG8ZL
                'description' => $isPercent ? 'Giảm ' . $discountValue . '% tối đa ' . number_format($maxDiscount) . 'đ'
                    : 'Giảm ' . number_format($discountValue) . 'đ',
                'discount_type' => $discountType,
                'discount_value' => $discountValue,
                'max_discount' => $maxDiscount,
                'min_order_value' => rand(100000, 500000),
                'quantity' => rand(1, 5),
                'used' => 0,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addDays(rand(7, 30)),
                'status' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('vouchers')->insert($vouchers);
    }
}
