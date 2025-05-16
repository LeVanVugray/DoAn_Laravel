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
            'email' => 'required|email',
            'password' => [
                'required',
                'regex:/^(?=.*[A-Z])(?=.*[\W\d]).+$/'
            ],
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'password.required' => 'Password is required.',
            'password.regex' => 'Password must contain at least one uppercase letter and one number or special character.',
        ]);

        if (!User::where('email', $request->email)->exists()) {
            return redirect("login")->withErrors(['email' => 'Email not found.'])->withInput();
        }

        $remember = $request->has('remember');
        if (!Auth::attempt($request->only('email', 'password'), $remember)) {
            return redirect("login")->withErrors(['password' => 'Incorrect password.'])->withInput();
        }

        if (Auth::user()->role === 0) {
            return redirect()->to('/admin/indexadmin');
        }

        return redirect()->route('index')->withSuccess('Signed in');
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=.*[\W\d]).+$/'
            ],
            'phone' => 'required|numeric|digits_between:10,11',
            'address' => 'required|string|max:255',
        ], [
            'name.required' => 'Name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Invalid email format.',
            'email.unique' => 'Email already exists.',
            'password.required' => 'Password is required.',
            'password.confirmed' => 'Passwords do not match.',
            'password.regex' => 'Password must contain at least one uppercase letter and one number or special character.',
            'phone.required' => 'Phone number is required.',
            'phone.numeric' => 'Phone must be a number.',
            'phone.digits_between' => 'Phone must be between 10 and 11 digits.',
            'address.required' => 'Address is required.',
        ]);
    
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
        ]);
    
        return redirect()->route('login')->withSuccess('You can now login');
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',

        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

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