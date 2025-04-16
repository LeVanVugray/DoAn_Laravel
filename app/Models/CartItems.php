<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{

    protected $primaryKey = 'cart_items_id'; 

    protected $fillable = [
        'user_id',
        'product_id',
        'size_id',
        'color_id',
        'quantity',
    ];
}
