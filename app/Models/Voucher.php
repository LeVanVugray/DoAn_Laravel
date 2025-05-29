<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    // Tên bảng nếu không phải dạng số nhiều của model (Laravel sẽ đoán là `vouchers` mặc định)
    protected $table = 'vouchers';
    protected $primaryKey = 'voucher_id';
    // Các cột được phép gán giá trị tự động (mass assignable)
    protected $fillable = [
        'code',
        'description',
        'discount_type',
        'discount_value',
        'max_discount',
        'min_order_value',
        'quantity',
        'used',
        'start_date',
        'end_date',
        'status',
    ];

    // Nếu có ngày tháng kiểu datetime
    protected $dates = [
        'start_date',
        'end_date',
    ];
}