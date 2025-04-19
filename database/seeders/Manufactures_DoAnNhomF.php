<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class Manufactures_DoAnNhomF extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('manufactures')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

         // Tạo nhà sản xuất
         Db::table('manufactures')-> insert([
            ['manu_name' => 'Nike', 'image_manu' => 'logo-nike.jpg','created_at' => now(),'updated_at' => now()],
            ['manu_name' => 'Adidas', 'image_manu' => 'adidas.jpg','created_at' => now(),'updated_at' => now()],
            ['manu_name' => 'Puma', 'image_manu' => 'puma.jpg','created_at' => now(),'updated_at' => now()],
            ['manu_name' => 'New Balance', 'image_manu' => 'New Balance.jpg','created_at' => now(),'updated_at' => now()],
            ['manu_name' => 'Asics', 'image_manu' => 'Asics.jpg','created_at' => now(),'updated_at' => now()],
        ]);
    }
}