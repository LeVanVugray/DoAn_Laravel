<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class User_DoAnNhomF extends Seeder
{
    /**
     * Run the database seeds.
     */
    const MAX_RECORDS = 100;
    public function run(): void
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table("user")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
        //Truncate table
        DB::table("user")->insert([
            [
                "name" => "Lê Văn Vũ",
                "email" => "admin@gmail.com",
                "password" => bcrypt("123456"),
                "phone" => "0987654321",
                "address" => "123 Đường ABC, Quận 1, TP.HCM",
                "role" => 0, // 0 = admin (ví dụ)
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
        for ($i = 2; $i < self::MAX_RECORDS; $i++) {
            $lastNames = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Hoàng', 'Phan', 'Vũ', 'Đặng', 'Bùi', 'Đỗ'];
            $middleNames = ['Văn', 'Thị', 'Hữu', 'Đức', 'Gia', 'Minh', 'Thanh', 'Quang', 'Ngọc', 'Nhật'];
            $firstNames = ['An', 'Bình', 'Cường', 'Dũng', 'Hương', 'Hải', 'Linh', 'Lan', 'Nam', 'Phong', 'Quân', 'Trang', 'Tú', 'Vy'];
        
            $randomName = $lastNames[array_rand($lastNames)] . ' ' .
                          $middleNames[array_rand($middleNames)] . ' ' .
                          $firstNames[array_rand($firstNames)];
        
            DB::table("user")->insert([
                [
                    "name" => $randomName,
                    "email" => "user{$i}@gmail.com",
                    "password" => bcrypt("123456"),
                    "phone" => "098765432" . str_pad($i, 2, '0', STR_PAD_LEFT), // đảm bảo 10 số
                    "address" => "123 Đường ABC, Quận 1, TP.HCM",
                    "role" => rand(0, 1), // 0 = admin, 1 = user
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
        
        // user::create([
        //     "name" => "Nguyễn Văn A",
        //     "email" => "admin@example.com",
        //     "password" => bcrypt("123456"),
        //     "phone" => "0987654321",
        //     "address" => "123 Đường ABC, Quận 1, TP.HCM",
        //     "role" => 0, // 0 = admin (ví dụ)
        // ]);
    
        // user::create([
        //     "name" => "Trần Thị B",
        //     "email" => "user@example.com",
        //     "password" => bcrypt("123456"),
        //     "phone" => "0912345678",
        //     "address" => "456 Đường XYZ, Quận 3, TP.HCM",
        //     "role" => 1, // 1 = customer
        // ]);
        // user::create([
        //     "name" => "Trần Thị F",
        //     "email" => "user1@example.com",
        //     "password" => bcrypt("123456"),
        //     "phone" => "0912345678",
        //     "address" => "456 Đường XYZ, Quận 3, TP.HCM",
        //     "role" => 1, // 1 = customer
        // ]);
        // user::create([
        //     "name" => "Trần Thị D",
        //     "email" => "user2@example.com",
        //     "password" => bcrypt("123456"),
        //     "phone" => "0912345678",
        //     "address" => "456 Đường XYZ, Quận 3, TP.HCM",
        //     "role" => 1, // 1 = customer
        // ]);
        // user::create([
        //     "name" => "Trần Thị C",
        //     "email" => "user3@example.com",
        //     "password" => bcrypt("123456"),
        //     "phone" => "0912345678",
        //     "address" => "456 Đường XYZ, Quận 3, TP.HCM",
        //     "role" => 1, // 1 = customer
        // ]);
    }
}