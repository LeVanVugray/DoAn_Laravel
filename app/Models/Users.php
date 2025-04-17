<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
