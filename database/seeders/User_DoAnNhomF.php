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
    const MAX_RECORDS = 30;
    public function run(): void
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table("user")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
        //Truncate table
        DB::table("user")->insert([
            [
                "name" => "Nguyễn Văn A",
                "email" => "admin@example.com",
                "password" => bcrypt("123456"),
                "phone" => "0987654321",
                "address" => "123 Đường ABC, Quận 1, TP.HCM",
                "role" => 0, // 0 = admin (ví dụ)
            ]
        ]);

        for($i = 2; $i < self::MAX_RECORDS; $i++) {
            DB::table("user")->insert([
                [
                    "name" => "Nguyễn Văn A",
                    "email" => "user{$i}@example.com",
                    "password" => bcrypt("123456"),
                    "phone" => "098765432{$i}",
                    "address" => "123 Đường ABC, Quận 1, TP.HCM",
                    "role" => rand(1,2), // 0 = admin (ví dụ)
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
