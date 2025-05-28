<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Manufactures extends Model
{
    use HasFactory;
    protected $fillable = [
        'manu_name', 
        'image_manu',
    ];
    // Quan hệ với Product (1 Manufacture có thể có nhiều Product)
    public function products()
    {
        return $this->hasMany(Product::class, 'manu_id');
    }
}
