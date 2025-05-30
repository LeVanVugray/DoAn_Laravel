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
        <h1>Update Category</h1>
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
                    <div class="widget-content nopadding">
                        <!-- BEGIN FORM -->
                        <form action="{{route('admin.post_from_update_category')}}" method="post" class="form-horizontal" enctype="multipart/form-data">

                            @csrf
                            <input type="hidden" name="updated_at" value="{{ $cate->updated_at ??  '' }}">
                            <input type="hidden" name="category_id" value="{{ $cate->category_id ??  '' }}">
                            <div class="control-group">
                                <label class="control-label">category_name </label>
                                <div class="controls">
                                    <input type="text" class="span11" name="category_name" id="category_name" value="{{ $cate->category_name ??  '' }}" required autofocus /> *
                                    @if ($errors->has('category_name'))
                                    <span class="text-danger">{{ $errors->first('category_name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">description
                                </label>
                                <div class="controls">
                                    <input type="text" class="span11" name="description" id="description" value="{{ $cate->description ??  '' }}" required autofocus /> *
                                    @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
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