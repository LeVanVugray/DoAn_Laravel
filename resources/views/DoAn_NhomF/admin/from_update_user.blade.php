@include('DoAn_NhomF.admin.header')
@include('DoAn_NhomF.admin.sidebar')
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="#" title="Go to Home" class="tip-bottom current">
                <i class="icon-home"></i> Home
            </a>
        </div>
        <h1>Update User</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon"><i class="icon-align-justify"></i></span>
                        <h5>Item info</h5>
                    </div>
                    <div class="widget-content nopadding">
                    @if ($errors->any())
                    <div class="alert alert-danger" style="margin: 15px 20px;">
                        <strong>Đã xảy ra lỗi:</strong>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                        
                        <!-- BEGIN FORM -->
                        <form action="{{route('post_from_update_user')}}" method="post" class="form-horizontal"
                            enctype="multipart/form-data">

                            @csrf
                            <input type="hidden" name="updated_at" value="{{ $user->updated_at }}">
                            <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                            <div class="control-group">
                                <label class="control-label">Username </label>
                                <div class="controls">
                                    <input type="text" class="span11" name="name" value="{{ $user->name }}" required
                                        autofocus /> *<br>
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email
                                </label>
                                <div class="controls">
                                    <input type="text" class="span11" name="email" value="{{ $user->email }}" required
                                        autofocus /> *<br>
                                    @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Password
                                </label>
                                <div class="controls">
                                    <input type="text" class="span11" value="{{ $user->password }}" name="password"
                                        required autofocus /> *<br>
                                    @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Phone
                                </label>
                                <div class="controls">
                                    <input type="text" class="span11" value="{{ $user->phone }}" name="phone" required
                                        autofocus /> *<br>
                                    @if ($errors->has('phone'))
                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Address
                                </label>
                                <div class="controls">
                                    <input type="text" class="span11" name="address" value="{{ $user->address }}"
                                        required autofocus /> *<br>
                                    @if ($errors->has('address'))
                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Role</label>
                                <div class="controls">
                                    <select class="span11" name="role" required autofocus>
                                        <option value="">-- Chọn quyền --</option>
                                        <option value="0" {{ $user->role == 0 ? 'selected' : '' }}>Admin</option>
                                        <option value="1" {{ $user->role == 1 ? 'selected' : '' }}>Customer</option>
                                    </select> *<br>
                                    @if ($errors->has('role'))
                                    <span class="text-danger">{{ $errors->first('role') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END FORM -->
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
@include('DoAn_NhomF.admin.footer')