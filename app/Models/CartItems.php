<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartItems extends Model
{

    use HasFactory; // Nếu bạn muốn sử dụng factory
    
    protected $primaryKey = 'cart_items_id'; 

    protected $fillable = [
        'user_id',
        'product_id',
        'size',
        'color',
        'quantity',
        'check'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'user_id');
    }
}
