<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $primaryKey = 'order_id'; // Chỉ định khóa chính nếu nó khác 'id'

    // Một đơn hàng thuộc về một người dùng
    public function user(): BelongsTo
    {
        return $this->belongsTo(Users::class, 'user_id', 'user_id');
    }
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }
    public function payment()
{
    return $this->hasOne(Payment::class, 'order_id', 'order_id');
}

}