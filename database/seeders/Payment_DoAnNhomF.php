<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Payment_DoAnNhomF extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('payments')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('payments')->insert([
            [
                'order_id' => 1,
                'payment_method' => 'Credit Card',
                'payment_status' => 1,
                'payment_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'order_id' => 2,
                'payment_method' => 'PayPal',
                'payment_status' => 1,
                'payment_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
