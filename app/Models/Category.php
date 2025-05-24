<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name', 
        'description',
    ];
    // Quan hệ với Product (1 Category có thể có nhiều Product)
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
