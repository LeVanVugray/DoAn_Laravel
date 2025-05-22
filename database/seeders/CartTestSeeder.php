<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use App\Models\Product;
use App\Models\ShoppingCart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Hash;

class CartTestSeeder extends Seeder
{
    /**
     * Chạy seeder để tạo dữ liệu mẫu.
     */
    public function run()
    {
        // Tạo người dùng mẫu theo migration của bảng 'user'
        $user = User::create([
            'name'     => 'Test User',
            'email'    => 'test@example.com',
            'password' => Hash::make('1!pPabc'),  // Mã hóa mật khẩu
            'phone'    => '0123456789',
            'address'  => '123 Test Street, City',
            'role'     => 1,  // 1: customer
        ]);

        // Tạo dữ liệu danh mục (Category)
        $category1 = Category::create([
            'category_name' => 'Thời trang nam',
            'description'   => 'Sản phẩm thời trang dành cho nam giới.',
        ]);
        
        $category2 = Category::create([
            'category_name' => 'Thời trang nữ',
            'description'   => 'Sản phẩm thời trang dành cho nữ giới.',
        ]);

        // Tạo dữ liệu màu sắc (Color)
        $red = Color::create([
            'color_name' => 'Đỏ',
            'color_code' => '#FF0000',
        ]);
        $blue = Color::create([
            'color_name' => 'Xanh',
            'color_code' => '#0000FF',
        ]);
        
        // Tạo dữ liệu kích thước (Size)
        $sizeS = Size::create([
            'size_value' => 'S',
        ]);
        $sizeM = Size::create([
            'size_value' => 'M',
        ]);
        
        // Tạo dữ liệu sản phẩm (Product)
        // Sản phẩm 1 thuộc danh mục Thời trang nam
        $product1 = Product::create([
            'name'         => 'Áo thun Nam',
            'description'  => 'Áo thun chất lượng cao, thiết kế trẻ trung cho nam giới.',
            'price'        => 299000.00,
            'category_id'  => $category1->category_id,
            'manu_id'      => null, // Nếu chưa có dữ liệu manufacturer, để null
            'image'        => 'ao_thun_nam.jpg',
        ]);
        
        // Sản phẩm 2 thuộc danh mục Thời trang nữ
        $product2 = Product::create([
            'name'         => 'Váy Nữ',
            'description'  => 'Váy thời trang, nhẹ nhàng và tinh tế.',
            'price'        => 499000.00,
            'category_id'  => $category2->category_id,
            'manu_id'      => null,
            'image'        => 'vay_nu.jpg',
        ]);

        // Tạo giỏ hàng cho người dùng vừa tạo
        $cart = ShoppingCart::create([
            'user_id' => $user->user_id,
        ]);
        
        // Tạo các mục giỏ hàng (CartItem):
        // Mục 1: Sản phẩm 1, màu Đỏ, kích thước S, số lượng 2.
        CartItem::create([
            'cart_id'    => $cart->cart_id,
            'product_id' => $product1->product_id,
            'color_id'   => $red->color_id,
            'size_id'    => $sizeS->size_id,
            'quantity'   => 2,
        ]);
        
        // Mục 2: Sản phẩm 2, màu Xanh, kích thước M, số lượng 1.
        CartItem::create([
            'cart_id'    => $cart->cart_id,
            'product_id' => $product2->product_id,
            'color_id'   => $blue->color_id,
            'size_id'    => $sizeM->size_id,
            'quantity'   => 1,
        ]);
    }
}
