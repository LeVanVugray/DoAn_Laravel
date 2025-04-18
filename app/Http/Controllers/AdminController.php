<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Users;
use Hash;
use Session;
use Illuminate\Http\Request;

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
    
        if ($keyword) {
            $products = Product::where('name', 'LIKE', "%$keyword%")
                                ->orWhere('description', 'LIKE', "%$keyword%")
                                ->paginate(4)
                                ->appends(['keyword' => $keyword]);
        } else {
            $products = Product::paginate(4);
        }
    
        return view('DoAN_nhomF.admin.products', compact('products', 'keyword'));
    }    

}   
