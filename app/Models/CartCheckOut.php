<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartCheckOut extends Model
{
    use HasFactory;

    // Nếu tên bảng không theo quy ước mặc định (cart_check_outs)
    // Bạn có thể khai báo tên bảng cụ thể
    protected $table = 'cart_checkouts';

    // Cho phép gán giá trị hàng loạt cho các trường này
    protected $fillable = [
        'user_id',
        'product_id',
        'number',
        'size',
        'color'
    ];

    // Nếu cần, có thể khai báo các quan hệ (relationships)
    // Ví dụ, nếu muốn liên kết với model User
    public function user()
    {
        return $this->belongsTo(Users::class);
    }

    // Tương tự, nếu có model Product, bạn có thể khai báo quan hệ sau:
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}