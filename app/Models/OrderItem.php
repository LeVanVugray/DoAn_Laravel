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

    // Quan hệ: Một order item thuộc về 1 đơn hàng
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
