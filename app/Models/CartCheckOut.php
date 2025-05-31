<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartCheckout extends Model
{
    use HasFactory;
    
    // Chỉ định bảng tương ứng
    protected $table = 'cart_checkouts';
    
    // Khai báo khóa chính của bảng là checkout_id
    protected $primaryKey = 'checkout_id';
    
    // Các trường được phép gán hàng loạt (mass assignment)
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];
    
    /**
     * Mối quan hệ với model User.
     * Lưu ý: trong migration của bảng users, khóa chính là user_id.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
    
    /**
     * Mối quan hệ với model Product.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
