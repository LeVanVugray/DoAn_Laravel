<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Color_DoAnNhomF extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('colors')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('colors')->insert([
            ['color_name' => 'Đỏ', 'color_code' => '#FF0000', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Xanh dương', 'color_code' => '#0000FF', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Xanh lá', 'color_code' => '#008000', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Vàng', 'color_code' => '#FFFF00', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Cam', 'color_code' => '#FFA500', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Hồng', 'color_code' => '#FFC0CB', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Tím', 'color_code' => '#800080', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Trắng', 'color_code' => '#FFFFFF', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Đen', 'color_code' => '#000000', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Xám', 'color_code' => '#808080', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Nâu', 'color_code' => '#A52A2A', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Be', 'color_code' => '#F5F5DC', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Bạc', 'color_code' => '#C0C0C0', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Vàng chanh', 'color_code' => '#E3FF00', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Xanh ngọc', 'color_code' => '#00FFFF', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Xanh navy', 'color_code' => '#000080', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Hồng đất', 'color_code' => '#D36C6C', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Đỏ đô', 'color_code' => '#8B0000', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Xanh rêu', 'color_code' => '#4B5320', 'created_at' => now(), 'updated_at' => now()],
            ['color_name' => 'Vàng đồng', 'color_code' => '#DAA520', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
