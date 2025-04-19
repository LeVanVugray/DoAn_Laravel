<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Users extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'user_id'; 
    
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'role',
        
    ];

    // Nếu muốn ẩn password khi xuất ra JSON
    protected $hidden = [
        'password',
    ];
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'user_id', 'user_id');
    }
    public function shoppingCart()
{
    return $this->hasOne(ShoppingCart::class, 'user_id', 'id');
}

}
