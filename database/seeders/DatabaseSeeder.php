<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Manufactures;
use App\Models\Product;
use App\Models\Users;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        
        Users::create([
            'name' => 'Nguyễn Văn A',
            'email' => 'admin@example.com',
            'password' => bcrypt('123456'),
            'phone' => '0987654321',
            'address' => '123 Đường ABC, Quận 1, TP.HCM',
            'role' => 0, // 0 = admin (ví dụ)
        ]);
    
        Users::create([
            'name' => 'Trần Thị B',
            'email' => 'user@example.com',
            'password' => bcrypt('123456'),
            'phone' => '0912345678',
            'address' => '456 Đường XYZ, Quận 3, TP.HCM',
            'role' => 1, // 1 = customer
        ]);
        Users::create([
            'name' => 'Trần Thị F',
            'email' => 'user1@example.com',
            'password' => bcrypt('123456'),
            'phone' => '0912345678',
            'address' => '456 Đường XYZ, Quận 3, TP.HCM',
            'role' => 1, // 1 = customer
        ]);
        Users::create([
            'name' => 'Trần Thị D',
            'email' => 'user2@example.com',
            'password' => bcrypt('123456'),
            'phone' => '0912345678',
            'address' => '456 Đường XYZ, Quận 3, TP.HCM',
            'role' => 1, // 1 = customer
        ]);
        Users::create([
            'name' => 'Trần Thị C',
            'email' => 'user3@example.com',
            'password' => bcrypt('123456'),
            'phone' => '0912345678',
            'address' => '456 Đường XYZ, Quận 3, TP.HCM',
            'role' => 1, // 1 = customer
        ]);

        User::factory()->create([
            'name' => 'Vule',
            'email' => 'vule@gmail.com',
            'password' => bcrypt('123456'),
            'github' => 'dfsdfsd',
            'ale' => 7,
        ]);

         // Tạo danh mục
        Category::insert([
            ['category_name' => 'Sneakers', 'description' => 'abc'],
            ['category_name' => 'Running Shoes', 'description' => 'hshda'],
            ['category_name' => 'Training Shoes', 'description' => 'hshda'],
            ['category_name' => 'Basketball Shoes', 'description' => 'hshda'],
            ['category_name' => 'Combat Boots', 'description' => 'hshda'],
        ]);

         // Tạo nhà sản xuất
            Manufactures::insert([
            ['manu_name' => 'Nike', 'image_manu' => 'abcd'],
            ['manu_name' => 'Adidas', 'image_manu' => 'abcd'],
            ['manu_name' => 'Puma', 'image_manu' => 'abcd'],
            ['manu_name' => 'New Balance', 'image_manu' => 'abcd'],
            ['manu_name' => 'Asics', 'image_manu' => 'abcd'],
        ]);

        // Lấy danh mục và nhà sản xuất để tạo sản phẩm
            $categories = Category::all();  // Lấy tất cả danh mục
            $manufactures = Manufactures::all();  // Lấy tất cả nhà sản xuất
            $images = [
                'Adidas Superstar.jpg',
                'Asics Gel-Kayano.jpg',
                'New Balance 574.jpg',
                'Nike Air Max.jpg',
                'Puma Cali.jpg',
        ];
        foreach ($images as $image) {
            // Tìm nhà sản xuất phù hợp với tên ảnh
            $matchedManu = $manufactures->first(function ($manu) use ($image) {
            return stripos($image, $manu->manu_name) !== false;
        });
        // Nếu tìm được nhà sản xuất
        if ($matchedManu) {
            // Lấy category ngẫu nhiên
            $category = $categories->random();
    
            Product::factory(1)->create([
                'category_id' => $category->category_id,
                'manu_id' => $matchedManu->manu_id,
                'image' => $image,
            ]);
        }
    }
    }
}
