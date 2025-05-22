<?php

namespace App\Http\Controllers;

use App\Models\CartCheckout;
use Illuminate\Support\Facades\Auth;

class CartCheckoutController extends Controller
{
    /**
     * Xóa một sản phẩm khỏi đơn thanh toán (CartCheckout).
     *
     * @param int $checkout_id - ID của bản ghi trong bảng cart_checkouts
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($checkout_id)
    {
        // Kiểm tra người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Bạn cần đăng nhập để thực hiện thao tác này.');
        }

        $user = Auth::user();

        // Tìm CartCheckout dựa theo checkout_id
        $cartCheckout = CartCheckout::find($checkout_id);
        if (!$cartCheckout) {
            return redirect()->back()
                ->with('error', 'Không tìm thấy sản phẩm trong đơn thanh toán.');
        }

        // Kiểm tra quyền sở hữu: sản phẩm trong đơn thanh toán phải thuộc về người dùng đang đăng nhập
        if ($cartCheckout->user_id != $user->user_id) {
            return redirect()->back()
                ->with('error', 'Bạn không có quyền xóa sản phẩm này.');
        }

        // Xóa bản ghi khỏi bảng cart_checkouts
        $cartCheckout->delete();

        return redirect()->back()
            ->with('success', 'Sản phẩm đã được xóa khỏi đơn thanh toán.');
    }
}
