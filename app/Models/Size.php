<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Size extends Model
{
    use HasFactory;

    // Xác định bảng liên kết, mặc định Laravel sẽ chuyển tên model thành số nhiều,
    // nhưng bạn nên khai báo rõ ràng nếu tên bảng khác quy tắc mặc định.
    protected $table = 'sizes';

    // Vì khóa chính của bảng là "size_id" thay vì "id"
    protected $primaryKey = 'size_id';

    // Cho phép mass assignment cho các trường cần thiết
    protected $fillable = [
        'size_value',
    ];
}
