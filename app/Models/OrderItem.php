<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // Sử dụng khóa chính là 'order_item_id'
    protected $primaryKey = 'order_item_id';
    public $timestamps = false;
    protected $fillable = [
        'order_id',
        'product_id',
        'size_id',
        'color_id',
        'quantity',
        'unit_price',
    ];

    // Quan hệ một-nhiều với Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    // Quan hệ với sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    // Quan hệ với kích thước
    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id', 'size_id');
    }

    // Quan hệ với màu sắc
    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id', 'color_id');
    }
}
