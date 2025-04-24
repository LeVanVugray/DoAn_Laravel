<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\CartItems;
use App\Models\Users;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function xoaSanPham(Request $request) {

        $user = Auth::user();
        if (!$user) {
            return redirect()->route('DoAn_NhomF.index')->with('error', 'Bạn cần đăng nhập.');
        }

        $cart_items_id = $request->get('cart_items_id');
        
        if (!$cart_items_id || !CartItems::find($cart_items_id)) {
            return redirect()->route('DoAn_NhomF.cart')->with('error', 'Sản phẩm không tồn tại.');
        }

        CartItems::destroy($cart_items_id);

        return redirect()->route('DoAn_NhomF.cart')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }


    public function index(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return view('DoAN_nhomF.index');
        }

        $perPage = $request->input('per_page', 15);
        $page = $request->input('page', 1);

        $cartItems = CartItems::where('user_id', $user->id)
        ->with('product')
        ->paginate($perPage, ['*'], 'page', $page);

        $cartItemsToCal = CartItems::where('user_id', $user->id)
        ->where('check', 1)
        ->with('product')
        ->get();

        $total = 0;

        foreach ($cartItemsToCal as $item) {
            if ($item->product) {
            $total += $item->product->price * $item->quantity;}
        }   

         // Tính tiền ship là 10% của tổng số tiền sản phẩm
        $shippingCost = $total * 0.10;

        // Tổng số tiền cuối cùng bằng tổng số tiền sản phẩm cộng với tiền ship
        $finalTotal = $total + $shippingCost;

        return view('cart.index', compact('cartItems', 'total', 'shippingCost', 'finalTotal'));
    }


    public function update(Request $request){
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('DoAn_NhomF.index')->with('error', 'Bạn cần đăng nhập.');
        }

        $quantities = $request->input('quantity', []);
        $selected   = $request->input('selected', []);

    
        foreach ($quantities as $cart_item_id => $quantity) {
        
            $cartItem = CartItems::where('user_id', $user->id)->find($cart_item_id);
            if ($cartItem) {
            
                $cartItem->quantity = (int)$quantity;
            
                $cartItem->check = isset($selected[$cart_item_id]) ? 1 : 0;
                $cartItem->save();
            }
        }
        return redirect()->route('DoAn_NhomF.cart')->with('success', 'Giỏ hàng đã được cập nhật.');
    }
}
