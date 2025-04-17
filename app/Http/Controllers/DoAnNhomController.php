<?php

namespace App\Http\Controllers;

use Hash;
use Session;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoAnNhomController extends Controller
{
    public function index(){
        return view('DoAN_nhomF.index');
    }
    public function shop(){
        return view('DoAN_nhomF.shop');
    }
    public function detail(){
        return view('DoAN_nhomF.detail');
    }
    public function cart(){
        return view('DoAN_nhomF.cart');
    }
    public function checkout(){
        return view('DoAN_nhomF.checkout');
    }
    public function contact(){
        return view('DoAN_nhomF.contact');
    }
    public function detailsearch(Request $request){
        // Lấy product_id từ query string
        $products = Product::take(4)->get();
        $product_id = $request->input('product_id');
        
        // Tìm sản phẩm theo product_id
        $product = Product::find($product_id);
        
        // Kiểm tra nếu không có sản phẩm với product_id
        // if (!$product) {
        // return redirect()->route('shop')->with('error', 'Product not found');
        // }

        // Trả về view với sản phẩm
        return view('DoAN_nhomF.detailsearch', compact('products','product'));  
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Nếu không có query, cho danh sách rỗng
        if ($query) {
            $products = Product::where('name', 'LIKE', "%$query%")
                               ->orWhere('description', 'LIKE', "%$query%")
                             ->paginate(4)
                             ->appends(['query' => $query]);
        } else {
            $products = collect(); // Rỗng để không lỗi view
        }

        return view('DoAN_nhomF.search', [
            'products' => $products,
            'query' => $query
        ]);
    }

    public function xoaSanPham(Request $request) {
        $cart_items_id = $request->get('cart_items_id');
        
        if (!$cart_items_id || !CartItems::find($cart_items_id)) {
            return redirect()->route('DoAn_NhomF.cart')->with('error', 'Sản phẩm không tồn tại.');
        }

        CartItems::destroy($cart_items_id);

        return redirect()->route('DoAn_NhomF.cart')->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }


    public function layGioHang(Request $request) {

        $userId = auth()->id();     

        $cartItems = DB::table('cart_items')
        ->join('product', 'cart_items.product_id', '=', 'product.product_id')
        ->select('cart_items.*', 'product.name', 'product.price')
        ->where('cart_items.user_id', $userId)
        ->get();

        return view('DoAn_NhomF.cart', compact('cartItems'));
    }

}
