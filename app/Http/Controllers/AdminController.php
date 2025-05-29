<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Users;
use App\Models\Voucher;
use Hash;
use Session;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Category;
use App\Models\Manufactures;
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
        $users = Users::all();
        $usercount= Users ::count();
        $Manucount= Manufactures ::count();
        $Catecount= Category ::count();
        $Productcount= Product ::count();
        $Vouchercount= Voucher ::count();

        $cards = [
                        ['label' => 'DOANH THU THÁNG NÀY', 'value' => '32,990,000 VNÐ', 'color' => '#1cc88a', 'icon' => 'fa-dollar-sign'],
                        ['label' => 'DOANH THU NĂM NAY', 'value' => '567,890,000 VNÐ', 'color' => '#1cc88a', 'icon' => 'fa-chart-line'],
                        ['label' => 'KHÁCH HÀNG', 'value' =>  $usercount , 'color' => '#36b9cc', 'icon' => 'fa-users'],
                        ['label' => 'THƯƠNG HIỆU', 'value' => $Manucount, 'color' => '#36b9cc', 'icon' => 'fa-tags'],
                        ['label' => 'LOẠI GIÀY', 'value' => $Catecount, 'color' => '#4e73df', 'icon' => 'fa-th-list'],
                        ['label' => 'GIÀY', 'value' => $Productcount, 'color' => '#4e73df', 'icon' => 'fa-shoe-prints'],
                        ['label' => 'KHUYẾN MÃI', 'value' => $Vouchercount, 'color' => '#f6c23e', 'icon' => 'fa-percent'],
                        ['label' => 'HÓA ĐƠN', 'value' => '2', 'color' => '#e74a3b', 'icon' => 'fa-receipt'],
                        ];

        return view('DoAN_nhomF.admin.revenue',compact('users','usercount','cards'));
    }

    // voucher
    public function voucheradmin()
    {
        $vouchers = Voucher::all();
        $vouchers = Voucher::paginate(5);
        return view('DoAn_NhomF.admin.Voucher', compact('vouchers'));
    }

    // them voucher
    public function from_add_voucher()
    {

        return view('DoAN_nhomF.admin.from_add_voucher');
    }
    public function post_from_add_voucher(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string', 'max:6', 'regex:/^[A-Za-z0-9]+$/'],
            'description' => 'required|string|max:255',
            'discount_type' => 'required|in:percent,fixed',
            'discount_value' => 'required|numeric|min:1|max:100000',
            'max_discount' => 'nullable|numeric|min:1|max:100000',
            'min_order_value' => 'nullable|numeric|min:100000|max:500000',
            'quantity' => 'required|integer|min:1|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:0,1',
        ],[
            'code.required' => 'Mã code là bắt buộc.',
            'code.unique' => 'Code đã tồn tại',
            'code.max' => 'Tối đa 6 kí tự .',
            'code.regex' => ' Code gồm chữ cái(thường và hoa) và số, không có khoảng trắng hay ký tự đặc biệt.',

            'description.required' => 'Mô tả là bắt buộc',
            'description.max' => 'Tối đa 255 kí tự .',

            'discount_type.required' => 'Kiểu voucher là bắt buộc',

            'discount_value.required' => 'Gía trị voucher là bắt buộc',
            'discount_value.min' => 'Tối thiểu là 1 .',
            'discount_value.max' => 'Tối đa 100000 .',
            
            'max_discount.required' => 'Gía trị tối đa của voucher là bắt buộc',
            'max_discount.min' => 'Tối thiểu là 1 .',
            'max_discount.max' => 'Tối đa 100000 .',

            'min_order_value.required' => 'Gía trị tối thiểu mà được áp dụng voucher là bắt buộc',
            'min_order_value.min' => 'Tối thiểu là 100000 .',
            'min_order_value.max' => 'Tối đa 500000 .',

            'quantity.required' => 'Số lượng là bắt buộc',
            'quantity.min' => 'Tối thiểu là 1 .',
            'quantity.max' => 'Tối đa 100 .',

            'status.required' => 'Trạng thái  là bắt buộc',
        
             
        ]);
        // $data = $request->all();
        // $check = Voucher::create([
        //     'code' => $data['code'],
        //     'description' => $data['description'],
        //     'discount_type' => $data['discount_type'],
        //     'discount_value' => $data['discount_value'],
        //     'max_discount' => $data['max_discount'],
        //     'min_order_value' => $data['min_order_value'],
        //     'quantity' => $data['quantity'],
        //     'start_date' => $data['start_date'],
        //     'end_date' => $data['end_date'],
        //     'status' => $data['status'],
        // ]);
        // return redirect("voucheradmin");

        try {
        Voucher::create([
            'code' => $request->input('code'),
            'description' => $request->input('description'),
            'discount_type' => $request->input('discount_type'),
            'discount_value' => $request->input('discount_value'),
            'max_discount' => $request->input('max_discount'),
            'min_order_value' => $request->input('min_order_value'),
            'quantity' => $request->input('quantity'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'status' => $request->input('status'),
        ]);

        return redirect('voucheradmin')->with('success', 'Thêm voucher thành công.');
    } catch (\Illuminate\Database\QueryException $e) {
        // Bắt lỗi duplicate code
        if ($e->errorInfo[1] == 1062) {
            return redirect()->back()
                ->withErrors(['code' => 'Mã voucher này đã tồn tại, vui lòng chọn mã khác.'])
                ->withInput();
        }

        // Lỗi khác
        return redirect()->back()
            ->withErrors(['msg' => 'Đã xảy ra lỗi khi thêm voucher.'])
            ->withInput();
    }

    }

    // voucher
    public function from_update_voucher(Request $request)
    {
        $voucher_id = $request->get('voucher_id');
        $voucher = Voucher::find($voucher_id);

        return view('DoAN_nhomF.admin.from_update_voucher', ['voucher' => $voucher]);
    }

    public function post_from_update_voucher(Request $request)
    {
        // $input = $request->all();

        $input = $request->all();
    
    // Tìm voucher theo ID
    $voucher = Voucher::find($input['voucher_id']);

    // Kiểm tra nếu không tồn tại
    if (!$voucher) {
        return redirect()->back()
            ->withErrors(['msg' => 'Voucher không tồn tại.'])
            ->withInput();
    }

    // Kiểm tra xung đột cập nhật bằng updated_at
    if ($voucher->updated_at->toDateTimeString() !== $input['updated_at']) {
        $changedFields = [];

        if ($voucher->code !== $input['code']) $changedFields[] = 'mã code';
        if ($voucher->description !== $input['description']) $changedFields[] = 'mô tả';
        if ($voucher->discount_type !== $input['discount_type']) $changedFields[] = 'kiểu giảm giá';
        if ($voucher->discount_value != $input['discount_value']) $changedFields[] = 'giá trị giảm';
        if ($voucher->max_discount != $input['max_discount']) $changedFields[] = 'giảm tối đa';
        if ($voucher->min_order_value != $input['min_order_value']) $changedFields[] = 'đơn tối thiểu';
        if ($voucher->quantity != $input['quantity']) $changedFields[] = 'số lượng';
        if ($voucher->start_date != $input['start_date']) $changedFields[] = 'ngày bắt đầu';
        if ($voucher->end_date != $input['end_date']) $changedFields[] = 'ngày kết thúc';
        if ($voucher->status != $input['status']) $changedFields[] = 'trạng thái';

        $changedList = implode(', ', $changedFields);

        return redirect()->back()
            ->withErrors(['msg' => 'Dữ liệu đã bị thay đổi ở các mục: ' . $changedList . '. Vui lòng tải lại trang và thử lại.'])
            ->withInput();
    }

    // Cập nhật nếu không có xung đột
    try {
        $voucher->update([
            'code' => $input['code'],
            'description' => $input['description'],
            'discount_type' => $input['discount_type'],
            'discount_value' => $input['discount_value'],
            'max_discount' => $input['max_discount'],
            'min_order_value' => $input['min_order_value'],
            'quantity' => $input['quantity'],
            'start_date' => $input['start_date'],
            'end_date' => $input['end_date'],
            'status' => $input['status'],
        ]);

        return redirect('voucheradmin')->with('success', 'Cập nhật voucher thành công.');
    } catch (\Exception $e) {
        return redirect()->back()
            ->withErrors(['msg' => 'Đã xảy ra lỗi khi cập nhật voucher.'])
            ->withInput();
    }



        // Validate dữ liệu đầu vào
        $request->validate([
            'code' => ['required', 'string', 'max:6', 'regex:/^[A-Za-z0-9]+$/'],
            'description' => 'required|string|max:255',
            'discount_type' => 'required|in:percent,fixed',
            'discount_value' => 'required|numeric|min:1|max:100000',
            'max_discount' => 'nullable|numeric|min:1|max:100000',
            'min_order_value' => 'nullable|numeric|min:100000|max:500000',
            'quantity' => 'required|integer|min:1|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:0,1',
        ],[
            'code.required' => 'Mã code là bắt buộc.',
            'code.unique' => 'Code đã tồn tại',
            'code.max' => 'Tối đa 6 kí tự .',
            'code.regex' => ' Code gồm chữ cái(thường và hoa) và số, không có khoảng trắng hay ký tự đặc biệt.',

            'description.required' => 'Mô tả là bắt buộc',
            'description.max' => 'Tối đa 255 kí tự .',

            'discount_type.required' => 'Kiểu voucher là bắt buộc',

            'discount_value.required' => 'Gía trị voucher là bắt buộc',
            'discount_value.min' => 'Tối thiểu là 1 .',
            'discount_value.max' => 'Tối đa 100000 .',
            
            'max_discount.required' => 'Gía trị tối đa của voucher là bắt buộc',
            'max_discount.min' => 'Tối thiểu là 1 .',
            'max_discount.max' => 'Tối đa 100000 .',

            'min_order_value.required' => 'Gía trị tối thiểu mà được áp dụng voucher là bắt buộc',
            'min_order_value.min' => 'Tối thiểu là 100000 .',
            'min_order_value.max' => 'Tối đa 500000 .',

            'quantity.required' => 'Số lượng là bắt buộc',
            'quantity.min' => 'Tối thiểu là 1 .',
            'quantity.max' => 'Tối đa 100 .',

            'status.required' => 'Trạng thái  là bắt buộc',
        
             
        ]);

        // Tìm voucher theo ID
        $voucher = Voucher::find($input['voucher_id']);
        // Cập nhật dữ liệu
        $voucher->code = $input['code'];
        $voucher->description = $input['description'];
        $voucher->discount_type = $input['discount_type'];
        $voucher->discount_value = $input['discount_value'];
        $voucher->max_discount = $input['max_discount'];
        $voucher->min_order_value = $input['min_order_value'];
        $voucher->quantity = $input['quantity'];
        $voucher->start_date = $input['start_date'];
        $voucher->end_date = $input['end_date'];
        $voucher->status = $input['status'];

        $voucher->save();

        return redirect('voucheradmin')->with('success', 'Cập nhật voucher thành công.');
    }

    public function deleteVoucher(Request $request)
    {
        $voucher_id = $request->get('voucher_id');
        $voucher = Voucher::destroy($voucher_id);

         if(!$voucher){
            return redirect()->route('voucheradmin')->withErrors([
                'msg' => 'Không có Voucher Này Để Xóa Hãy Load Lại trang'
            ])
            ->withInput(); // Để giữ lại input cũ;
        }
        else{
            return redirect()->route('voucheradmin')->with('success', 'Xóa voucher thành công.');
        }


        
    }
    
    public function sidebaradmin(){
        return view('DoAN_nhomF.admin.sidebar');
    }
    public function usersadmin(Request $request)
    {
        $keyword = $request->input('keyword');
        $perPage = 5;
    
        // Kiểm tra tham số 'page' có hợp lệ không (phải là số nguyên dương)
        if ($request->has('page') && (!ctype_digit($request->page) || (int)$request->page < 1)) {
            return redirect()->route('usersadmin', ['page' => 1])
                             ->with('error', 'Trang không hợp lệ, đã chuyển về trang đầu.');
        }
    
        if ($keyword) {
            $users = Users::where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%$keyword%");
    
                if (strtolower($keyword) === "admin") {
                    $query->orWhere('role', 0);
                } elseif (strtolower($keyword) === 'customer') {
                    $query->orWhere('role', 1);
                }
            })
            ->orderBy('user_id', 'desc')
            ->paginate($perPage)
            ->appends(['keyword' => $keyword]);
        } else {
            $users = Users::orderBy('user_id', 'desc')
                ->paginate($perPage);
        }
    
        // Nếu không có dữ liệu trên trang yêu cầu → chuyển về trang 1
        if ($users->isEmpty() && $request->has('page') && $request->page > 1) {
            return redirect()->route('usersadmin', ['page' => 1])
                             ->withErrors(['error' => 'Trang không tồn tại, đã chuyển về trang đầu.']);
        }
    
        return view('DoAN_nhomF.admin.users', compact('users', 'keyword'));
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
        'password' => [
            'required',
            'string',
            'min:6',
            'max:100',
            'regex:/^\S{6,50}$/'
        ],
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
        'password.regex' => 'Mật khẩu không được chứa khoảng trắng.',

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
            'password' => [
                'required',
                'string',
                'min:6',
                'max:50',
                'regex:/^\S{6,50}$/'
            ],
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
            'password.regex' => 'Mật khẩu không được chứa khoảng trắng.',
        
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
                'msg' => 'Không có Người Tên Này Để Xóa Hãy Load Lại trang'
            ])
            ->withInput(); // Để giữ lại input cũ;
        }
        else{
            return redirect()->route('usersadmin')->with('success', 'Xóa người dùng thành công.');
        }

    
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
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('AnhDoAn'), $imageName); // Lưu vào thư mục public/AnhDoAn
            $imagePath = $imageName; // Đường dẫn để lưu vào DB
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
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('AnhDoAn'), $imageName);

            $product->image = $imageName;
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