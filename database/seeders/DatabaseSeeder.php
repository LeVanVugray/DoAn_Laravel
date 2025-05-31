<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Đồ Án Nhóm F 
            Manufactures_DoAnNhomF::class,
            Categories_DoAnNhomF::class,
            Product_DoAnNhomF::class,
            //Color_DoAnNhomF::class,
            User_DoAnNhomF::class,
            //Sizes_DoAnNhomF::class,
            Order_DoAnNhomF::class,
            OrderItem_DoAnNhomF::class,
            ShoppingCart_DoAnNhomF::class,
            CartItems_DoAnNhomF::class,
            Payment_DoAnNhomF::class,
            VoucherSeeder::class,


            // User Của Thầy
            UserSeeder::class,
            RoleSeeder::class,
            UserRoleSeeder::class,
        ]);
    }
}
