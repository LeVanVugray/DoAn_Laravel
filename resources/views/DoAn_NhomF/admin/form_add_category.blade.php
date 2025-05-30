@include('DoAn_NhomF.admin.header')
@include('DoAn_NhomF.admin.sidebar')
<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="#" title="Go to Home" class="tip-bottom current"><i class="icon-home"></i>
                Home</a></div>
        <h1>Add New Category</h1>
    </div>
    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
                        <h5>Item info</h5>
                    </div>
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
                    @if ($errors->has('msg'))
                    <div class="alert alert-danger" style="margin: 10px;">
                        {{ $errors->first('msg') }}
                    </div>
                    @endif
                    <div class="widget-content nopadding">
                        <!-- BEGIN FORM -->
                        <form action="{{route('admin.post_from_add_category')}}" method="post" class="form-horizontal"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="control-group">
                                <label class="control-label">Category name </label>
                                <div class="controls">
                                    <input type="text" class="span11" name="category_name" value="{{ old('category_name') }}" required autofocus /> * <br>
                                    @if ($errors->has('category_name'))
                                    <span  style="color: red;"  class="text-danger">{{ $errors->first('category_name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Desrciption
                                </label>
                                <div class="controls">
                                    <input type="text" class="span11" name="description" value="{{ old('description') }}" required autofocus /> * <br>
                                    @if ($errors->has('description'))
                                    <span  style="color: red;"  class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-success">Add</button>
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