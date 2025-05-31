<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItem extends Model
{
    use HasFactory;
    protected $primaryKey = 'cart_item_id';

    // Nếu khóa chính không phải kiểu số tự tăng thì cần khai báo $incrementing và $keyType. 
    // Ở đây, mặc định sử dụng số tự tăng:
    // protected $incrementing = true;
    // protected $keyType = 'int';

    // Các trường có thể mass assign
    protected $fillable = [
        'cart_id',
        'product_id',
      
        'quantity',
    ];

    // Định nghĩa quan hệ với model ShoppingCart
    public function cart()
    {
        // Nếu model của shopping_cart có tên là ShoppingCart và khóa chính là 'cart_id'
        return $this->belongsTo(ShoppingCart::class, 'cart_id', 'cart_id');
    }

    // Định nghĩa quan hệ với model Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

}
