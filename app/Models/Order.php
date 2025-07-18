<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Sử dụng khóa chính là 'order_id'
    protected $primaryKey = 'order_id';

    // Các cột có thể gán giá trị hàng loạt
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'shipped_at',
        'payment',
    ];

   // Quan hệ một-nhiều với OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    // Quan hệ một-nhiều với User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}
