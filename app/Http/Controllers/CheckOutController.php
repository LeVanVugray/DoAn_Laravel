<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use App\Models\CartCheckout;
use App\Models\Voucher;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckOutController extends Controller
{
    public function checkout(Request $request)
    {


        if (!Auth::check()) {
            return redirect()->route('index')
                ->with('error', 'Người dùng chưa đăng nhập.');
        }

        // Lấy thông tin người dùng từ authentication.
        $user = Auth::user();

        $cart = ShoppingCart::firstOrCreate(
            ['user_id' => $user->user_id],
            ['created_at' => now(), 'updated_at' => now()]
        );

        // Lấy tất cả các sản phẩm trong giỏ hàng của người dùng
        $cartCheckouts = CartCheckout::where('user_id', $user->user_id)
            ->with(['product'])
            ->get();

        // Tính tổng tiền của tất cả sản phẩm
        $totalProductPrice = 0;
        foreach ($cartCheckouts as $item) {
            // Kiểm tra xem sản phẩm có tồn tại hay không
            if (isset($item->product)) {
                // Giả sử mỗi đối tượng CartCheckout có thuộc tính 'quantity'
                $lineTotal = $item->product->price * $item->quantity;
                $totalProductPrice += $lineTotal;
            }
        }

        // Lấy mã voucher từ request
        $voucherCode = $request->input('voucher');

        // Kiểm tra xem mã voucher có hợp lệ hay không
        $voucher = Voucher::where('code', $voucherCode)
            ->where('status', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        // Tính số tiền giảm dựa vào loại voucher
        $discountAmount = 0;
        if ($voucher) {
            if ($voucher->discount_type === 'fixed') {
                // Voucher giảm giá cố định
                $discountAmount = $voucher->discount_value;
            } elseif ($voucher->discount_type === 'percent') {
                // Voucher giảm theo phần trăm
                $discountAmount = $totalProductPrice * ($voucher->discount_value / 100);
                // Nếu có giới hạn giảm giá tối đa, đảm bảo số tiền giảm không vượt quá giới hạn đó
                if ($voucher->max_discount && $discountAmount > $voucher->max_discount) {
                    $discountAmount = $voucher->max_discount;
                }
            }
        }

        // Tính tổng số tiền cần thanh toán sau khi trừ voucher
        $finalTotal = $totalProductPrice - $discountAmount;
        if ($finalTotal < 0) {
            $finalTotal = 0;
        }

        return view('DoAN_nhomF.checkout', compact('cartCheckouts', 'totalProductPrice', 'discountAmount', 'finalTotal'));
    }


    public function placeOrder(Request $request)
    {
        // Lấy user hiện tại, bạn có thể sử dụng Auth::user() nếu dùng hệ thống xác thực của Laravel
        $user = Auth::user();

        // Lấy dữ liệu cart checkout của user, kèm theo mối quan hệ 'product'
        $cartCheckouts = CartCheckout::where('user_id', $user->user_id)
            ->with('product')
            ->get();

        if ($cartCheckouts->isEmpty()) {
            return redirect()->back()->with('error', 'Giỏ hàng trống, không thể đặt đơn!');
        }

        // 1. Tính tổng số tiền của tất cả sản phẩm trong giỏ hàng
        $totalProductPrice = 0;
        foreach ($cartCheckouts as $item) {
            // Kiểm tra sự tồn tại của sản phẩm
            if (isset($item->product)) {
                $lineTotal = $item->product->price * $item->quantity;
                $totalProductPrice += $lineTotal;
            }
        }

        // 2. Lấy voucher từ request và kiểm tra voucher hợp lệ
        $voucherCode = $request->input('voucher');
        $voucher = Voucher::where('code', $voucherCode)
            ->where('status', 1)
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        // 3. Tính số tiền giảm dựa vào loại voucher (fixed hoặc percent)
        $discountAmount = 0;
        if ($voucher) {
            if ($voucher->discount_type === 'fixed') {
                $discountAmount = $voucher->discount_value;
            } elseif ($voucher->discount_type === 'percent') {
                $discountAmount = $totalProductPrice * ($voucher->discount_value / 100);
                // Nếu có giới hạn giảm tối đa, đảm bảo không vượt quá giới hạn
                if ($voucher->max_discount && $discountAmount > $voucher->max_discount) {
                    $discountAmount = $voucher->max_discount;
                }
            }
        }

        // 4. Tính tổng số tiền cần thanh toán sau khi trừ voucher
        $finalTotal = $totalProductPrice - $discountAmount;
        if ($finalTotal < 0) {
            $finalTotal = 0;
        }

        DB::beginTransaction();
        try {
            // 5. Tạo record đơn hàng trong bảng orders
            $order = new Order();
            $order->user_id = $user->user_id;
            $order->total_amount = $finalTotal;
            $order->status = 1; // 1: pending
            // Lấy thông tin phương thức thanh toán từ request (hoặc gán mặc định nếu cần)
            $order->payment = $request->input('payment', 'default_method');
            // shipped_at để null (chưa giao hàng)
            $order->save();

            // 6. Lặp qua các item trong cart để tạo record trong order_items
            foreach ($cartCheckouts as $item) {
                if (isset($item->product)) {
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $order->order_id;
                    $orderItem->product_id = $item->product->product_id;
                    $orderItem->quantity = $item->quantity;
                    $orderItem->unit_price = $item->product->price;
                    $orderItem->save();
                }
            }

            // 7. (Tuỳ chọn) Xoá các mục trong giỏ hàng sau khi đặt đơn
            CartCheckout::where('user_id', $user->user_id)->delete();

            DB::commit();

            // Redirect hoặc trả về thông báo thành công
            return redirect()->route('order.success')->with('success', 'Đơn hàng đã được tạo thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            // Ghi log lỗi nếu cần
            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi đặt đơn: ' . $e->getMessage());
        }
    }
}
