<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Size;
use App\Models\Color;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Chạy Seeder để tạo dữ liệu mẫu cho đơn hàng.
     */
    public function run()
    {
        // Tạo người dùng mẫu thứ nhất: John Doe
        $john = User::create([
            'name'     => 'John Doe',
            'email'    => 'johndoe@example.com',
            'password' => Hash::make('password123'),
            'phone'    => '0123456789',
            'address'  => '123 Main Street, City',
            'role'     => 1, // 1: customer
        ]);

        // Tạo người dùng mẫu thứ hai: Jane Smith
        $jane = User::create([
            'name'     => 'Jane Smith',
            'email'    => 'janesmith@example.com',
            'password' => Hash::make('password456'),
            'phone'    => '0987654321',
            'address'  => '456 Another Ave, City',
            'role'     => 1, // 1: customer
        ]);

        // Tạo sản phẩm mẫu (sẽ tạo mới nếu database rỗng)
        $product1 = Product::create([
            'name'        => 'Áo sơ mi nam',
            'description' => 'Áo sơ mi cao cấp, phong cách thanh lịch.',
            'price'       => 500000,
            'image'       => 'ao_somi.jpg',
        ]);

        $product2 = Product::create([
            'name'        => 'Quần jeans nữ',
            'description' => 'Quần jeans thời trang, năng động.',
            'price'       => 700000,
            'image'       => 'quan_jeans.jpg',
        ]);

        // Tạo kích thước (Size)
        $sizeM = Size::create(['size_value' => 'M']);
        $sizeL = Size::create(['size_value' => 'L']);

        // Tạo màu sắc (Color) - Cung cấp đầy đủ 'color_code' để tránh lỗi
        $red  = Color::create(['color_name' => 'Đỏ', 'color_code' => '#FF0000']);
        $blue = Color::create(['color_name' => 'Xanh', 'color_code' => '#0000FF']);

        // Tạo đơn hàng cho John Doe (status = 1, ví dụ: "Chờ xử lý")
        $orderJohn = Order::create([
            'user_id'      => $john->user_id,
            'total_amount' => 1700000, // Tổng tiền mẫu
            'status'       => 1,       // 1: Chờ xử lý
            'shipped_at'   => null,
            'payment' => "mbb",
        ]);

        // Thêm các sản phẩm vào đơn hàng của John Doe
        OrderItem::create([
            'order_id'   => $orderJohn->order_id,
            'product_id' => $product1->product_id,
            'size_id'    => $sizeM->size_id,
            'color_id'   => $red->color_id,
            'quantity'   => 2,
            'unit_price' => 500000,
        ]);

        OrderItem::create([
            'order_id'   => $orderJohn->order_id,
            'product_id' => $product2->product_id,
            'size_id'    => $sizeL->size_id,
            'color_id'   => $blue->color_id,
            'quantity'   => 1,
            'unit_price' => 700000,
        ]);

        // Tạo đơn hàng cho Jane Smith (status = 2, ví dụ: đã giao hàng)
        $orderJane = Order::create([
            'user_id'      => $jane->user_id,
            'total_amount' => 1200000,
            'status'       => 2,      // 2: Đã giao hoặc trạng thái khác
            'shipped_at'   => now(),
            'payment' => "tienmat",
        ]);

        // Thêm các sản phẩm vào đơn hàng của Jane Smith
        OrderItem::create([
            'order_id'   => $orderJane->order_id,
            'product_id' => $product2->product_id,
            'size_id'    => $sizeM->size_id,
            'color_id'   => $blue->color_id,
            'quantity'   => 1,
            'unit_price' => 700000,
        ]);

        OrderItem::create([
            'order_id'   => $orderJane->order_id,
            'product_id' => $product1->product_id,
            'size_id'    => $sizeL->size_id,
            'color_id'   => $red->color_id,
            'quantity'   => 1,
            'unit_price' => 500000,
        ]);

        // Tạo hoặc lấy người dùng test (giả sử email duy nhất)
        $testUser = User::firstOrCreate(
            ['email' => 'status3user@example.com'],
            [
                'name'     => 'Status 3 User',
                'password' => Hash::make('password'), // Chú ý: mật khẩu chọn bới bạn
                'phone'    => '123456789',
                'address'  => 'Test Address, City',
                'role'     => 1,
            ]
        );

        // Tạo hoặc lấy sản phẩm test
        $product = Product::firstOrCreate(
            ['name' => 'Test Product'],
            [
                'description' => 'Test product description',
                'price'       => 100000, // Đơn vị VND
                'image'       => 'test-product.jpg',
            ]
        );

        // Tạo hoặc lấy kích thước test
        $size = Size::firstOrCreate(
            ['size_value' => 'M']
        );

        // Tạo hoặc lấy màu sắc test (phải có đủ trường, ví dụ: color_code)
        $color = Color::firstOrCreate(
            ['color_name' => 'Test Color'],
            ['color_code' => '#AAAAAA']
        );

        // Tạo đơn hàng với status = 3 (ví dụ: "Đã giao" hoặc trạng thái riêng bạn định nghĩa)
        $order = Order::create([
            'user_id'      => $testUser->user_id,
            'total_amount' => 200000, // Tổng tiền mẫu
            'status'       => 3,      // Status = 3
            'shipped_at'   => Carbon::now(),
            'payment' => "momo",
        ]);

        // Thêm một mục đơn hàng vào đơn vừa tạo
        OrderItem::create([
            'order_id'   => $order->order_id,
            'product_id' => $product->product_id,
            'size_id'    => $size->size_id,
            'color_id'   => $color->color_id,
            'quantity'   => 2,
            'unit_price' => 100000,
        ]);
    }
}
