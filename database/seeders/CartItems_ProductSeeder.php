<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Manufactures;
use App\Models\Product;
use App\Models\Users;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CartItems_ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cart_items')->insert([
            [
                'user_id'    => 1,
                'product_id' => 1, // Sản phẩm 1 từ seeder sản phẩm
                'size'       => 'M',
                'color'      => 'Đỏ',
                'quantity'   => 2,
            ],
            [
                'user_id'    => 1,
                'product_id' => 2, // Sản phẩm 2 từ seeder sản phẩm
                'size'       => 'L',
                'color'      => 'Xanh',
                'quantity'   => 1,
            ],
            [
                'user_id'    => 1,
                'product_id' => 3, // Sản phẩm 3 từ seeder sản phẩm
                'size'       => 'S',
                'color'      => 'Trắng',
                'quantity'   => 3,
            ],
        ]);

         DB::table('products')->insert([
            [
                'name'        => 'Sản phẩm 1',
                'description' => 'Mô tả chi tiết cho sản phẩm 1',
                'price'       => 500000,
                'category_id' => 1,
                'manu_id'     => 1,
                'image'       => 'AnhDoAn/Adidas Ultraboost.jpg',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'name'        => 'Sản phẩm 2',
                'description' => 'Mô tả chi tiết cho sản phẩm 2',
                'price'       => 750000,
                'category_id' => 2,
                'manu_id'     => 1,
                'image'       => 'AnhDoAn/Adidas Gazelle.jpg',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ],
            [
                'name'        => 'Sản phẩm 3',
                'description' => 'Mô tả chi tiết cho sản phẩm 3',
                'price'       => 1000000,
                'category_id' => 1,
                'manu_id'     => 2,
                'image'       => 'AnhDoAn/Adidas Gazelle.jpg',
                'created_at'  => Carbon::now(),
                'updated_at'  => Carbon::now(),
            ]
        ]);

    }
}
