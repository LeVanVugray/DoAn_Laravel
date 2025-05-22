<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Xác định bảng liên kết với model Category
    protected $table = 'categories';

    // Khai báo khóa chính của bảng là 'category_id'
    protected $primaryKey = 'category_id';

    // Các trường được phép gán giá trị hàng loạt
    protected $fillable = [
        'category_name',
        'description',
    ];

    /**
     * Một danh mục có thể chứa nhiều sản phẩm.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
