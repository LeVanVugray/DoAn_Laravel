<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\CartItems; 
use Illuminate\Http\Request;
use App\Models\CartCheckOut;

class cart_controller extends Controller
{
    public function xoaSanPham(Request $request) {
        $cart_items_id = $request->get('cart_items_id');
        
        if (!$cart_items_id || !CartItems::find($cart_items_id)) {
            return redirect()->route('DoAn_NhomF.cart')->with('error', 'Sản phẩm không tồn tại.');
        }

        CartItems::destroy($cart_items_id);

        return redirect()->route('DoAn_NhomF.cart')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }


    public function layGioHang(Request $request)
{
    $currentPage = $request->query('page', 1);
    $userId = auth()->id();     

    $cartItems = DB::table('cart_items')
          ->join('product', 'cart_items.product_id', '=', 'product.product_id')
          ->select('cart_items.*', 'product.name', 'product.price')
          ->where('cart_items.user_id', $userId)
          ->paginate(10);
    
    // Lấy các sản phẩm trong giỏ thanh toán (CartCheckOut)
    $checkoutItems = \App\Models\CartCheckOut::where('user_id', $userId)->get();

    return view('DoAn_NhomF.cart', compact('cartItems', 'checkoutItems'));
}

    public function addToCheckout(Request $request)
{
    // Xác thực yêu cầu
    $data = $request->validate([
        'cart_item_id' => 'required|integer|exists:cart_items,cart_items_id',
        'quantity'     => 'required|integer|min:1',
        // Bạn có thể thêm rule cho price, name, size, color nếu cần
    ]);

    // Lấy sản phẩm trong giỏ hàng
    $cartItem = CartItems::find($data['cart_item_id']);

    if (!$cartItem) {
        return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại.'], 404);
    }

    // Giả sử bạn có model CartCheckOut để lưu các sản phẩm checkout
    // Hãy nhớ import model này: use App\Models\CartCheckOut;
    $checkoutItem = \App\Models\CartCheckOut::create([
        'user_id'    => auth()->id(),
        'product_id' => $cartItem->product_id,
        'number'     => $data['quantity'],
        'size'       => $cartItem->size,
        'color'      => $cartItem->color,
    ]);

    // Bạn có thể chọn xoá sản phẩm khỏi giỏ hàng nếu cần
    // CartItems::destroy($cartItem->cart_items_id);

    return response()->json(['success' => true, 'message' => 'Đã thêm sản phẩm vào giỏ thanh toán.', 'checkout_item' => $checkoutItem]);
}
}
