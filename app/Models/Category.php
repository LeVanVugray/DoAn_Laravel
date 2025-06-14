<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Category extends Model
{
    use HasFactory;
     protected $table = 'categories';
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'category_id',
        'category_name', 
        'description',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    // Quan hệ với Product (1 Category có thể có nhiều Product)
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
}
