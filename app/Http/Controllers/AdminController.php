<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Users;
use App\Models\Category;
use Hash;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AdminController extends Controller
{
    public function indexadmin(){
        return view('DoAN_nhomF.admin.index');
    }
    public function itemadmin(){
        $products = Product::paginate(4);
        return view('DoAN_nhomF.admin.items', compact('products'));
    }
    public function resultadmin(){
        
        return view('DoAN_nhomF.admin.result');
    }
    public function revenuetadmin(){
        
        return view('DoAN_nhomF.admin.revenue');
    }
    
    public function sidebaradmin(){
        return view('DoAN_nhomF.admin.sidebar');
    }
    public function usersadmin(Request $request){
        // $users = Users::all();
        // $users = Users::paginate(2);
        // return view('DoAN_nhomF.admin.users',compact('users'));
        $keyword = $request->input('keyword');
        // Nếu không có query, cho danh sách rỗng
        if ($keyword) {
            $users = Users::where('name', 'LIKE', "%$keyword%")
                             ->paginate(3)
                             ->appends(['keyword' => $keyword]);
        } else {
            $users = Users::all();
            $users = Users::paginate(2);
        }
        return view('DoAN_nhomF.admin.users',compact('users','keyword'));
    }

    public function footeradmin(){
        return view('DoAN_nhomF.admin.footer');
    }
    public function headeradmin(){
        return view('DoAN_nhomF.admin.header');
    }
    public function categoriesadmin(){
        
        return view('DoAN_nhomF.admin.categories');
    }
    public function from_add_user(){
        
        return view('DoAN_nhomF.admin.from_add_user');
    }
    public function from_update_user(Request $request){
        $user_id = $request->get('user_id');
        $user = Users::find($user_id);

        return view('DoAN_nhomF.admin.from_update_user',['user' => $user]);
    }
    public function post_from_update_user(Request $request)
    {
        $input = $request->all();

        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:user,email,' . $input['user_id'] . ',user_id', // chú ý đổi lại đúng cột ID
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|min:6',
            'role' => 'required|in:0,1', // 0 = admin, 1 = customer
        ]);

        // Tìm user theo ID
        $user = Users::find($input['user_id']);
        // Cập nhật dữ liệu
        $user->name = $input['name'];
        $user->email = $input['email'];
        $user->phone = $input['phone'] ?? null;
        $user->address = $input['address'] ?? null;
        $user->role = $input['role'];

        if (!empty($input['password'])) {
            $user->password = bcrypt($input['password']);
        }

        $user->save();

        return redirect('usersadmin')->with('success', 'Cập nhật người dùng thành công.');
    }
    public function post_from_add_user(Request $request){
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:user',
            'phone' => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|min:6',
            'role' => 'required|in:0,1', // 0 = admin, 1 = customer
        ]);
        $data = $request->all();
        $check = Users::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'phone' => $data['phone'],
        'address' => $data['address'],
        'password' => Hash::make($data['password']),
        'role' => $data['role'],
        ]);
        return redirect("usersadmin");
    }
    public function deleteUser(Request $request) {
        $user_id = $request->get('user_id');
        $user = Users::destroy($user_id);

        return redirect("usersadmin")->withSuccess('You have signed-in');
    }

    public function productsadmin(Request $request) {
        $keyword = $request->input('keyword');
        $sort = $request->input('sort');
    
        $query = Product::query();
    
        if ($keyword) {
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'LIKE', "%$keyword%")
                  ->orWhere('description', 'LIKE', "%$keyword%");
            });
        }
    
        // Sorting logic
        if ($sort === 'price') {
            $query->orderBy('price', 'asc');
        } else {
            $query->orderBy('created_at', 'desc');
        }
    
        $products = $query->paginate(16)->appends([
            'keyword' => $keyword,
            'sort' => $sort
        ]);
    
        return view('DoAN_nhomF.admin.products', compact('products', 'keyword', 'sort'));
    }
    

    public function products(Request $request)
    {
        $keyword = $request->input('keyword');
        $products = Product::when($keyword, function ($query, $keyword) {
            return $query->where('name', 'like', '%' . $keyword . '%');
        })->get();

        return view('DoAN_nhomF.admin.products', compact('products', 'keyword'));
    }

    public function form_add_product() {
        $categories = Category::all();
        return view('DoAn_NhomF.admin.form_add_product', compact('categories'));
    }

    public function post_form_add_product(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,category_id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'category_id.exists' => 'The selected category no longer exists.',
            'image.max' => 'Image size must not exceed 2MB.',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.productadmin')->with('success', 'Product added successfully!');
    }

    public function form_edit_product(Request $request)
    {
        $product_id = $request->get('product_id');
        $product = Product::find($product_id);
        $categories = Category::all();

        return view('DoAn_NhomF.admin.form_edit_product', compact('product', 'categories'));
    }

    public function post_edit_product(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,category_id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'category_id.exists' => 'The selected category no longer exists.',
            'image.max' => 'Image size must not exceed 2MB.',
        ]);

        $product = Product::find($request->product_id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
        }

        $product->save();

        return redirect()->route('admin.productadmin')->withSuccess('Product updated successfully!');
    }

    public function deleteProduct(Request $request) {
        $product_id = $request->get('product_id');
        $product = Product::find($product_id);

        if ($product && $product->image) {
            Storage::disk('public')->delete($product->image);
        }

        Product::destroy($product_id);

        return redirect()->route('admin.productadmin')->withSuccess('Product deleted successfully!');
    }
}   
