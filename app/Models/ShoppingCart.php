<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    // Xác định tên bảng trong cơ sở dữ liệu
    protected $table = 'shopping_cart';

    // Khai báo khóa chính là 'cart_id' thay vì mặc định 'id'
    protected $primaryKey = 'cart_id';

    // Vì migration không định nghĩa các cột timestamps nên tắt tính năng timestamps
    public $timestamps = false;

    // Cho phép mass assignment cho các trường cần thiết
    protected $fillable = [
        'user_id',
    ];

    // Định nghĩa mối quan hệ với model User
    // Lưu ý: bảng user và model User cần có khóa chính là 'user_id'
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

     public function cartItems()
    {
        return $this->hasMany(CartItem::class, 'cart_id', 'cart_id');
    }
}
