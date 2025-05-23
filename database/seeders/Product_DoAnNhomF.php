<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Product_DoAnNhomF extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tắt kiểm tra khóa ngoại tạm thời
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('products')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Thêm dữ liệu sản phẩm với manu_id tương ứng:
        // 1 => Nike, 2 => Adidas, 3 => Puma, 4 => New Balance, 5 => Asics
        DB::table('products')->insert([
            [
                'name' => 'Nike Air Max',
                'description' => 'Một trong những dòng giày nổi bật với thiết kế đệm khí Air.',
                'price' => 359,
                'category_id' => rand(1, 5),
                'manu_id' => 1,
                'image' => 'Nike Air Max.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nike Dunk Low',
                'description' => 'Thiết kế trẻ trung, phù hợp phong cách đường phố.',
                'price' => 299,
                'category_id' => rand(1, 5),
                'manu_id' => 1,
                'image' => 'Nike Dunk Low.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nike Jordan',
                'description' => 'Huyền thoại bóng rổ kết hợp thời trang đỉnh cao.',
                'price' => 450,
                'category_id' => rand(1, 5),
                'manu_id' => 1,
                'image' => 'Nike Jordan.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nike Pegasus',
                'description' => 'Đôi giày chạy bộ cân bằng giữa đệm êm và phản hồi lực.',
                'price' => 339,
                'category_id' => rand(1, 5),
                'manu_id' => 1,
                'image' => 'Nike Pegasus.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nike React Infinity Run',
                'description' => 'Tối ưu hỗ trợ chạy đường dài, giảm chấn thương.',
                'price' => 399,
                'category_id' => rand(1, 5),
                'manu_id' => 1,
                'image' => 'Nike React Infinity Run.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'New Balance Fresh Foam',
                'description' => 'Công nghệ Fresh Foam mang lại cảm giác mềm mại, linh hoạt.',
                'price' => 369,
                'category_id' => rand(1, 5),
                'manu_id' => 4,
                'image' => 'New Balance Fresh Foam.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'New Balance 574',
                'description' => 'Kiểu dáng retro kinh điển, phù hợp đi hằng ngày.',
                'price' => 289,
                'category_id' => rand(1, 5),
                'manu_id' => 4,
                'image' => 'New Balance 574.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'New Balance 997H',
                'description' => 'Phiên bản hiện đại của dòng 997 với đế êm ái.',
                'price' => 309,
                'category_id' => rand(1, 5),
                'manu_id' => 4,
                'image' => 'New Balance 997H.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'New Balance FuelCell Rebel',
                'description' => 'Được thiết kế cho những bước chạy tốc độ cao.',
                'price' => 399,
                'category_id' => rand(1, 5),
                'manu_id' => 4,
                'image' => 'New Balance FuelCell Rebel.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'New Balance XC-72',
                'description' => 'Đôi giày thời trang lấy cảm hứng từ tương lai.',
                'price' => 349,
                'category_id' => rand(1, 5),
                'manu_id' => 4,
                'image' => 'New Balance XC-72.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Puma Cali',
                'description' => 'Phong cách đơn giản, tinh tế cho giới trẻ.',
                'price' => 269,
                'category_id' => rand(1, 5),
                'manu_id' => 3,
                'image' => 'Puma Cali.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Puma Future Rider',
                'description' => 'Thiết kế retro hiện đại, êm ái và linh hoạt.',
                'price' => 279,
                'category_id' => rand(1, 5),
                'manu_id' => 3,
                'image' => 'Puma Future Rider.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Puma Ignite',
                'description' => 'Công nghệ Ignite Foam giúp tăng cường phản hồi lực.',
                'price' => 299,
                'category_id' => rand(1, 5),
                'manu_id' => 3,
                'image' => 'Puma Ignite.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Puma RS-X',
                'description' => 'Đôi giày thời thượng với thiết kế hầm hố.',
                'price' => 309,
                'category_id' => rand(1, 5),
                'manu_id' => 3,
                'image' => 'Puma RS-X.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Puma Suede',
                'description' => 'Dòng giày biểu tượng của Puma, chất liệu da lộn.',
                'price' => 259,
                'category_id' => rand(1, 5),
                'manu_id' => 3,
                'image' => 'Puma Suede.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Asics Gel-Kayano',
                'description' => 'Giày chạy bộ hỗ trợ ổn định cao, phù hợp overpronators.',
                'price' => 369,
                'category_id' => rand(1, 5),
                'manu_id' => 5,
                'image' => 'Asics Gel-Kayano.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Asics Gel-Nimbus',
                'description' => 'Giày chạy đường dài với đệm gel êm ái.',
                'price' => 379,
                'category_id' => rand(1, 5),
                'manu_id' => 5,
                'image' => 'Asics Gel-Nimbus.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Asics Gel-Venture 8',
                'description' => 'Dành cho chạy trail, bền bỉ và chắc chắn.',
                'price' => 319,
                'category_id' => rand(1, 5),
                'manu_id' => 5,
                'image' => 'Asics Gel-Venture 8.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Asics Metaracer',
                'description' => 'Giày chạy tốc độ với thiết kế tối ưu cho thi đấu.',
                'price' => 419,
                'category_id' => rand(1, 5),
                'manu_id' => 5,
                'image' => 'Asics Metaracer.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Asics Novablast',
                'description' => 'Cảm giác bật nảy tốt, lý tưởng cho chạy hàng ngày.',
                'price' => 339,
                'category_id' => rand(1, 5),
                'manu_id' => 5,
                'image' => 'Asics Novablast.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
