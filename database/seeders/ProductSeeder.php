<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Thêm dữ liệu sản phẩm với manu_id tương ứng:
        // 1 => Nike, 2 => Adidas, 3 => Puma, 4 => New Balance, 5 => Asics
        DB::table('products')->insert([
            [
                'name' => 'New Balance 9943',
                'description' => 'Phiên bản hiện đại của dòng 9943 với đế êm ái.',
                'price' => 3590000,
                'category_id' => rand(1, 5),
                'manu_id' => 4,
                'image' => 'New Balance 9943.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Acics-Purple',
                'description' => 'Giày chạy đường dài với đệm gel êm ái',
                'price' => 3590000,
                'category_id' => rand(1, 5),
                'manu_id' => 5,
                'image' => 'acics-purple.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
