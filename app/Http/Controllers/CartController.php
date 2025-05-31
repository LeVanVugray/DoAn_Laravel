<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShoppingCart;
use App\Models\CartCheckout;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function getCartDetails(Request $request)
    {
        // Kiểm tra người dùng đã đăng nhập chưa

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


        // Lấy các mục giỏ hàng với eager loading và phân trang (vd: 5 mục mỗi trang).
        $cartItems = $cart->cartItems()
            ->with(['product'])
            ->paginate(5);

        // Lấy danh sách các CartCheckout của người dùng (các sản phẩm đã được thêm vào đơn thanh toán)
        $cartCheckouts = CartCheckout::where('user_id', $user->user_id)
            ->with(['product'])
            ->get();

        // Trả về view cùng với 2 biến: $cartItems (phân trang) và $cartCheckouts
        return view('DoAn_NhomF.cart', compact('cartItems', 'cartCheckouts'));
    }

    public function destroy($cart_item_id)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa.
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để thực hiện hành động này.');
        }

        $user = Auth::user();

        // Tìm CartItem cần xóa
        $cartItem = CartItem::find($cart_item_id);

        if (!$cartItem) {
            return redirect()->back()->with('error', 'Mục giỏ hàng không tồn tại.');
        }

        // Xóa mục giỏ hàng
        $cartItem->delete();

        return redirect()->back()->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng.');
    }

    public function store(Request $request, $cart_item_id)
    {
        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Bạn cần đăng nhập để thực hiện thao tác này.');
        }

        $user = Auth::user();

        // Lấy giỏ hàng của người dùng dựa theo user_id
        $shoppingCart = ShoppingCart::where('user_id', $user->user_id)->first();

        if (!$shoppingCart) {
            return redirect()->back()
                ->with('error', 'Không tìm thấy giỏ hàng cho người dùng này.');
        }

        // Lấy CartItem được chọn dựa trên cart_item_id truyền vào trong giỏ hàng
        $cartItem = $shoppingCart->cartItems()->find($cart_item_id);
        if (!$cartItem) {
            return redirect()->back()
                ->with('error', 'Không tìm thấy sản phẩm được chọn trong giỏ hàng.');
        }

        // Lấy số lượng được chọn từ form (ví dụ input có name="quantity")
        $selectedQuantity = (int) $request->input('quantity-input');
        if ($selectedQuantity <= 0) {
            return redirect()->back()->with('error', 'Số lượng không hợp lệ.');
        }

        // Sử dụng transaction để đảm bảo sự nhất quán của dữ liệu
        DB::transaction(function () use ($user, $cartItem, $selectedQuantity) {
            // Tạo bản ghi mới trong bảng cart_checkouts từ dữ liệu của CartItem được chọn
            CartCheckout::create([
                'user_id'    => $user->user_id,   // Gắn user_id của người dùng
                'product_id' => $cartItem->product_id,
                'quantity'   => $selectedQuantity,
            ]);
        });

        return redirect()->route('cart')
            ->with('success', 'Sản phẩm đã được chuyển sang đơn thanh toán thành công.');
    }
}
