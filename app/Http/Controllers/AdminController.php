<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Users;
use Hash;
use Session;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $users = Users::all();
        return view('DoAN_nhomF.admin.revenue',compact('users'));
    }
    
    public function sidebaradmin(){
        return view('DoAN_nhomF.admin.sidebar');
    }
    public function usersadmin(Request $request){
        $keyword = $request->input('keyword');
        // Nếu không có query, cho danh sách rỗng
        if ($keyword) {
            $users = Users::where(function ($query) use ($keyword) {
                // Tìm theo tên
                $query->where('name', 'LIKE', "%$keyword%");
    
                // Tìm theo role
                if (strtolower($keyword) === "admin") {
                    $query->orWhere('role', 0);
                } elseif (strtolower($keyword) === 'customer') {
                    $query->orWhere('role', 1);
                }
            })
            ->orderBy('user_id', 'desc')
            ->paginate(3)
            ->appends(['keyword' => $keyword]);
        } else {
            $users = Users::orderBy('user_id', 'desc') 
            ->paginate(5);
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
        // Tìm user theo ID
        $user = Users::find($input['user_id']);
        
        // Kiểm tra xung đột cập nhật bằng updated_at
        if ($user->updated_at->toDateTimeString() !== $input['updated_at']) {
            $changedFields = [];
            if ($user->name !== $input['name']) $changedFields[] = 'tên người dùng';
            if ($user->email !== $input['email']) $changedFields[] = 'email';
            if ($user->phone !== $input['phone']) $changedFields[] = 'số điện thoại';
            if ($user->address !== $input['address']) $changedFields[] = 'địa chỉ';
            if ($user->role != $input['role']) $changedFields[] = 'quyền';
            // Không kiểm tra password vì không thể so sánh hash
    
            $changedList = implode(', ', $changedFields);
            return back()->withErrors([
                'msg' => 'Dữ liệu đã bị thay đổi ở các mục: ' . $changedList . '. Vui lòng tải lại trang và thử lại.'
            ])
            ->withInput(); // Để giữ lại input cũ
            ;
        }
        // Validate dữ liệu đầu vào
        $request->validate([
        'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\pN\s]+$/u'],
        'email' => [
            'required',
            'email',
            'regex:/^[a-zA-Z0-9._%+-]+@gmail\.com$/',
            'max:100',
            Rule::unique('user', 'email')->ignore($input['user_id'], 'user_id')
        ],
        'phone' => ['required', 'digits:11'],
        'address' => ['required', 'string', 'max:255'],
        'password' => ['nullable', 'string', 'min:6', 'max:100'],
        'role' => ['required', 'in:0,1'],
    ], [
        'name.required' => 'Tên người dùng là bắt buộc.',
        'name.regex' => 'Tên người dùng chỉ được chứa chữ cái và khoảng trắng và s.',
        'name.max' => 'Tên người dùng không được vượt quá 255 ký tự.',

        'email.required' => 'Email là bắt buộc.',
        'email.email' => 'Email không hợp lệ.',
        'email.regex' => 'Email phải có định dạng @gmail.com.',
        'email.unique' => 'Email đã tồn tại.',
        'email.max' => 'Email không được dài quá 100 ký tự.',

        'phone.required' => 'Số điện thoại là bắt buộc.',
        'phone.digits' => 'Số điện thoại phải đúng 11 chữ số.',

        'address.required' => 'Địa chỉ là bắt buộc.',
        'address.max' => 'Địa chỉ không được dài quá 255 ký tự.',

        'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
        'password.max' => 'Mật khẩu không được vượt quá 100 ký tự.',

        'role.required' => 'Vui lòng chọn quyền.',
        'role.in' => 'Giá trị quyền không hợp lệ.',
    ]);
        
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
            'name' => ['required', 'string', 'max:255', 'regex:/^[\pL\pN\s]+$/u'],
            'email' => [
                'required',
                'email',
                'regex:/^[a-z0-9._%+-]+@gmail\.com$/i',
                'max:100',
                'unique:user,email'
            ],
            'phone' => 'required|digits:11',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:6|max:50',
            'role' => 'required|in:0,1',
        ], [
            'name.required' => 'Tên người dùng là bắt buộc.',
            'name.max' => 'Tên người dùng không được vượt quá 255 ký tự.',
            'name.regex' => 'Tên người dùng chỉ được phép gồm chữ cái và dấu cách.',
        
            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.regex' => 'Email phải có định dạng @gmail.com.',
            'email.unique' => 'Email đã tồn tại.',
            'email.max' => 'Email không được dài quá 100 ký tự.',
        
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.digits' => 'Số điện thoại phải đúng 11 chữ số.',
        
            'address.required' => 'Địa chỉ là bắt buộc.',
            'address.max' => 'Địa chỉ không được dài quá 255 ký tự.',
        
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá 50 ký tự.',
        
            'role.required' => 'Vui lòng chọn quyền.',
            'role.in' => 'Giá trị quyền không hợp lệ.', 
        ]);
    
        try {
            Users::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'password' => Hash::make($request->input('password')),
                'role' => $request->input('role'),
            ]);
    
            return redirect('usersadmin')->with('success', 'Thêm người dùng thành công.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->errorInfo[1] == 1062) { // lỗi duplicate entry
                return redirect()->back()
                    ->withErrors(['email' => 'Email này đã tồn tại, vui lòng chọn email khác.'])
                    ->withInput();
            }
    
            // Lỗi khác
            return redirect()->back()
                ->withErrors(['msg' => 'Đã xảy ra lỗi khi thêm người dùng.'])
                ->withInput();
        }
    }
    public function deleteUser(Request $request) {
        $user_id = $request->get('user_id');
        $user = Users::destroy($user_id);
        if(!$user){
            return redirect()->route('usersadmin')->withErrors([
                'msg' => 'Không Người Tên Này Để Xóa Hãy Load Lại trang'
            ])
            ->withInput(); // Để giữ lại input cũ;
        }
        else{
            return redirect()->route('usersadmin')->with('success', 'Xóa người dùng thành công.');
        }

    
    }

}   