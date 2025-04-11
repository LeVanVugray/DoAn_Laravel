<?php

namespace App\Http\Controllers;

use Hash;
use Session;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * CRUD User controller
 */
class CrudUserController extends Controller
{

    /**
     * Login page
     */
    public function login()
    {
        return view('crud_user.login');
    }
    

    // detail_search.blade


    //
    
    

    /**
     * User submit form login
     */
    public function authUser(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('list')
                ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    /**
     * Registration page
     */
    public function createUser()
    {
        return view('crud_user.create');
    }

    /**
     * User submit form register
     */
    public function postUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'github' => 'required|String|max:255',
            'ale' => 'required|integer|min:0',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            // Kiểm tra nếu tệp là hình ảnh hợp lệ
            if ($avatar->isValid()) {
                $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
                $avatar->move(public_path('img'), $avatarName);  // Lưu vào thư mục public/img/
                $data['avatar'] = $avatarName;
            } else {
                return back()->withErrors(['avatar' => 'The uploaded file is not a valid image.']);
            }
        }
    
        $check = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'github' => $data['github'],
            'ale' => $data['ale'],
            'avatar' => isset($data['avatar']) ? $data['avatar'] : null,
            'password' => Hash::make($data['password'])
        ]);

        return redirect("login");
    }

    /**
     * View user detail page
     */
    public function readUser(Request $request) {
        $user_id = $request->get('id');
        $user = User::find($user_id);

        return view('crud_user.read', ['messi' => $user]);
    }

    /**
     * Delete user by id
     */
    public function deleteUser(Request $request) {
        $user_id = $request->get('id');
        $user = User::destroy($user_id);

        return redirect("list")->withSuccess('You have signed-in');
    }

    /**
     * Form update user page
     */
    public function updateUser(Request $request)
    {
        $user_id = $request->get('id');
        $user = User::find($user_id);

        return view('crud_user.update', ['user' => $user]);
    }

    /**
     * Submit form update user
     */
    public function postUpdateUser(Request $request)
    {
        $input = $request->all();

        $request->validate([
            'name' => 'required',
            'github' => 'required|String|max:255',
            'ale' => 'required|integer|min:0',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'email' => 'required|email|unique:users,id,'.$input['id'],
            'password' => 'required|min:6',

        ]);

       $user = User::find($input['id']);
       $user->name = $input['name'];
       $user->github = $input['github'];
       $user->ale = $input['ale'];
       $user->email = $input['email'];
       $user->password = $input['password'];

     // Kiểm tra và xử lý ảnh nếu có
     if ($request->hasFile('avatar')) {
        // Kiểm tra ảnh hợp lệ
        $avatar = $request->file('avatar');
        
        // Đặt tên ảnh là thời gian hiện tại + extension
        $avatarName = time() . '.' . $avatar->getClientOriginalExtension();

        if ($user->avatar) {
            // Đường dẫn đến ảnh cũ
            $oldAvatarPath = public_path('img/' . $user->avatar);
            
            // Kiểm tra nếu ảnh cũ tồn tại, thì xóa
            if (file_exists($oldAvatarPath)) {
                unlink($oldAvatarPath); // Xóa ảnh cũ
            }
        }
        // Lưu ảnh vào thư mục public/img/
        $avatar->move(public_path('img'), $avatarName);

        // Cập nhật avatar trong database
        $user->avatar = $avatarName;
    }
       $user->save();

        return redirect("list")->withSuccess('You have signed-in');
    }

    /**
     * List of users
     */
    public function listUser()
    {
        if(Auth::check()){
            $users = User::all();
            $products = Product::all();
            return view('crud_user.list', ['users' => $users],['products' => $products]);
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'user_id'); // Giả sử mỗi sản phẩm có thuộc tính user_id
    }
    /**
     * Sign out
     */
    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}