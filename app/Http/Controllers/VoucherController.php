<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherController extends Controller
{
   public function checkVoucher(Request $request)
{
    try {
        $voucherCode = $request->input('code');
        $orderTotal = $request->input('order_total'); // Tổng tiền đơn hàng từ request
        $voucher = Voucher::where('code', $voucherCode)
                          ->where('status', 1)
                          ->where('start_date', '<=', now())
                          ->where('end_date', '>=', now())
                          ->first();

        if (!$voucher) {
            return response()->json(['error' => 'Mã voucher không hợp lệ hoặc đã hết hạn'], 400);
        }

        // Kiểm tra giá trị đơn hàng tối thiểu
        if ($voucher->min_order_value && $orderTotal < $voucher->min_order_value) {
            return response()->json(['error' => 'Đơn hàng chưa đạt giá trị tối thiểu để áp dụng voucher'], 400);
        }

        // Tính toán giảm giá
        $discountAmount = 0;
        if ($voucher->discount_type === 'fixed') {
            $discountAmount = $voucher->discount_value; // Giảm giá cố định (số tiền trực tiếp)
        } elseif ($voucher->discount_type === 'percent') {
            $discountAmount = ($orderTotal * $voucher->discount_value) / 100; // Giảm theo phần trăm
            
            // Nếu có `max_discount`, đảm bảo số tiền giảm giá không vượt quá giới hạn
            if ($voucher->max_discount && $discountAmount > $voucher->max_discount) {
                $discountAmount = $voucher->max_discount;
            }
        }

        return response()->json([
            'success' => 'Voucher hợp lệ',
            'voucher' => $voucher,
            'discount_amount' => round($discountAmount, 2), // Làm tròn số tiền giảm giá
        ], 200);

    } catch (\Exception $e) {
        \Log::error('Lỗi kiểm tra voucher: ' . $e->getMessage());
        return response()->json(['error' => 'Đã xảy ra lỗi khi xử lý yêu cầu'], 500);
    }
}

}
