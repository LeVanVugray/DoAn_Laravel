<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $table = 'cart_items';
    protected $primaryKey = 'cart_item_id';

    public function cart()
    {
        return $this->belongsTo(ShoppingCart::class, 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function size()
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }
}
