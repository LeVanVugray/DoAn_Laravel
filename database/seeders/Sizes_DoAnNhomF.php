<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Sizes_DoAnNhomF extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('sizes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $sizes = [
            '36', '37', '38', '39', '40',
            '41', '42', '43', '44', '45',
            'US 6', 'US 7', 'US 8', 'US 9', 'US 10'
        ];

        foreach ($sizes as $size) {
            DB::table('sizes')->insert([
                'size_value' => $size,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
