<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model
{
    use HasFactory;

    // Xác định bảng: mặc định Laravel sẽ hiểu tên model là 'colors', nhưng nên khai báo rõ ràng
    protected $table = 'colors';

    // Khai báo khóa chính của bảng là 'color_id' thay vì 'id'
    protected $primaryKey = 'color_id';

    // Cho phép mass-assignment cho các trường cần thiết
    protected $fillable = [
        'color_name',
        'color_code',
    ];
}
