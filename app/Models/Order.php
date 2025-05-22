<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Sử dụng khóa chính là 'order_id'
    protected $primaryKey = 'order_id';
    public $timestamps = false;
    // Các cột có thể gán giá trị hàng loạt
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'shipped_at',
    ];

    // Quan hệ: Một đơn hàng có nhiều đơn hàng con
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }
}
