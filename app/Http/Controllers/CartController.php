<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\CartItems;
use App\Models\CartCheckOuts;
use App\Models\Users;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function xoaSanPham(Request $request)
    {

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('cart')->with('error', 'Bạn cần đăng nhập.');
        }

        $cart_items_id = $request->get('cart_items_id');

        if (!$cart_items_id || !CartItems::find($cart_items_id)) {
            return redirect()->route('cart')->with('error', 'Sản phẩm không tồn tại.');
        }

        CartItems::destroy($cart_items_id);

        return redirect()->route('cart')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }


    public function index(Request $request)
    {
        $user = Auth::user()->getKey();
        if (!$user) {
            return redirect()->route('index');
        }

        $perPage = $request->input('per_page', 15);
        $page = $request->input('page', 1);

        $cartItems = CartItems::where('user_id', $user)
            ->with('product')
            ->paginate($perPage, ['*'], 'page', $page);

         $checkoutItems = CartCheckOuts::where('user_id', $user)
            ->with('product')
            ->get();

        return view('DoAn_NhomF.cart.index', compact('cartItems','checkoutItems'));
    }

     public function checkoutCartItem(Request $request, $cartItemId)
    {
        // Lấy thông tin cart item được chọn (bao gồm cả quan hệ product)
        $cartItem = CartItems::with('product')->find($cartItemId);

        if (!$cartItem) {
            return redirect()->back()->with('error', 'Không tìm thấy cart item.');
        }
        
        // Lấy số lượng từ request; nếu không truyền thì mặc định dùng số lượng hiện có của cart item
        $requestedQuantity = $request->input('quantity', $cartItem->quantity);

        $checkoutData = [
            'user_id'    => $cartItem->user_id,
            'product_id' => $cartItem->product_id,
            'size'       => $cartItem->size,
            'color'      => $cartItem->color,
            'quantity'   => $requestedQuantity,
        ];

        // Tạo record mới trong bảng cart_check_out (model có primaryKey là cart_check_outs_id)
        $checkoutItem = CartCheckOuts::create($checkoutData);

        return redirect()->back()->with('success', 'Sản phẩm đã được chuyển sang Checkout với số lượng ' . $requestedQuantity);
    }

    public function deleteCartCheckout($id)
    {
        
        $checkoutItem = CartCheckOuts::find($id);
        
        if (!$checkoutItem) {
            return redirect()->back()->with('error', 'Không tìm thấy mục checkout.');
        }
        
        $checkoutItem->delete();
        
        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi Cart Checkout thành công.');
    }
}
