<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class Categories_DoAnNhomF extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        DB::table('categories')->insert([
            [
                'category_name' => 'Sneakers',
                'description' => 'Giày thời trang, phù hợp cho đi chơi, đi học, kết hợp với nhiều phong cách khác nhau.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_name' => 'Running Shoes',
                'description' => 'Giày chuyên dụng cho việc chạy bộ, thiết kế nhẹ, linh hoạt và hỗ trợ giảm chấn.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_name' => 'Training Shoes',
                'description' => 'Giày dùng trong phòng gym hoặc các hoạt động tập luyện cường độ cao, hỗ trợ vận động đa hướng.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_name' => 'Basketball Shoes',
                'description' => 'Giày chơi bóng rổ, thiết kế cổ cao hoặc trung để bảo vệ mắt cá, độ bám tốt cho sân đấu.',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_name' => 'Combat Boots',
                'description' => 'Giày bốt chắc chắn, thường dùng cho quân sự hoặc đi phượt, thiết kế bền và chống nước.',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
        
    }
}
