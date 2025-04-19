{{-- resources/views/admin/users.blade.php --}}
@include('DoAn_NhomF.admin.header')
    <!-- start-top-search-->
    <div id="search">
        <form action="{{ route('usersadmin') }}" method="get">
            <input type="text" name="keyword" id="cate" placeholder="Search here..." />
            <button type="submit" class="tip-bottom" title="Search">
                <i class="icon-search icon-white"></i>
            </button>
        </form>
    </div>
    <!--close-top-search -->
@include('DoAn_NhomF.admin.sidebar')
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="" title="Go to Home" class="tip-bottom current">
                <i class="icon-home"></i> Home
            </a>
        </div>
        <h1>Manage User</h1>
    </div>

    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <a href="{{route('admin.from_add_user')}}">
                                <i class="icon-plus"></i>
                            </a>
                        </span>
                        <h5>Users</h5>
                    </div>

                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>Username</th>
                                    <th>email</th>
                                    <th>Password</th>
                                    <th>Address</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->user_id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->password}}</td>
                                        <td>{{$user->address}}</td>
                                        <td>{{$user->role==0 ? 'Admin' : 'Khách Hàng'}}</td>
                                        <td>
                                            <a href="{{route('admin.from_update_user',['user_id'=>$user->user_id])}}" class="btn btn-success btn-mini">Edit</a>
                                            <!-- Form để xóa user -->
                                            <a class="btn btn-danger btn-mini" href="{{route('admin.deleteUser',['user_id'=>$user->user_id])}}" class="btn btn-success btn-mini">Delete</a>

                                            <!-- <form action="{{route('admin.deleteUser',['user_id'=>$user->user_id])}}" style="display:inline-block;">
                                                <input type="submit" class="btn btn-danger btn-mini" value="Delete">
                                            </form> -->
                                        </td>
                                    </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>

                <!-- Phân trang -->
                <div class="row" style="margin-left: 18px;">
                <ul class="pagination">
                    <li {{ $users->links('pagination::bootstrap-5') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>

<!-- END CONTENT -->
<div class="row-fluid">
    <div id="footer" class="span12">2025 &copy; TDC - Lập trình web 1</div>
</div>
@include('DoAn_NhomF.admin.footer')
