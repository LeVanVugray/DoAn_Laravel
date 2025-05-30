<?php

namespace App\Http\Controllers;

use Hash;
use Session;
use App\Models\User;
use App\Models\Users;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoAnNhomController extends Controller
{
    public function index(){
        $carouselImages = Product::take(3)->get();
        $products = Product::where('product_id', '>', 3)->take(2)->get();
        $productcate = Product::where('product_id', '>', 5)->take(8)->get();
        $productfeture = Product::where('product_id', '>', 13)->take(4)->get();
        $productss = Product::where('product_id', '>', 3)->take(2)->get();
        return view('DoAN_nhomF.index', compact('carouselImages','products','productcate','productfeture','productss'));
    }
    public function shop(Request $request){ 
        $productshop = Product::paginate(4);
        if ($request->has('page') && (!ctype_digit($request->page) || (int)$request->page < 1)) {
            return redirect()->route('shop', ['page' => 1])
                             ->with('error', 'Trang không hợp lệ, đã chuyển về trang đầu.');
        }
        // Nếu không có dữ liệu trên trang yêu cầu → chuyển về trang 1
        if ($productshop->isEmpty() && $request->has('page') && $request->page > 1) {
            return redirect()->route('shop', ['page' => 1])
                             ->withErrors(['error' => 'Trang không tồn tại, đã chuyển về trang đầu.']);
        }
       
        return view('DoAN_nhomF.shop',compact('productshop'));
    }
    public function detail(){
        return view('DoAN_nhomF.detail');
    }
    public function cart(){
        return view('DoAN_nhomF.cart');
    }
    public function checkout(){
        $user = Users::first();
        return view('DoAN_nhomF.checkout',compact('user'));

    }
    public function contact(){
        return view('DoAN_nhomF.contact');
    }
    public function detailsearch(Request $request){
        // Lấy product_id từ query string
        
        $product_id = $request->input('product_id');
        
        $product = Product::find($product_id);
        if (!$product) {
            return redirect()->route('detailsearch', ['product_id' => 1])
                 ->with('error', 'Id Không Hợp Lệ Vui Lòng Thử Lại');
        }
        $products = Product::take(4)->get();
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
            $products = Product::paginate(4);
        }

        return view('DoAN_nhomF.search', [
            'products' => $products,
            'query' => $query
        ]);
    }
}
