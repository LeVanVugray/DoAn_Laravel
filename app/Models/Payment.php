<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $primaryKey = 'payment_id';

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
}
