{{-- resources/views/DoAn_NhomF/admin/items.blade.php --}}
@include('DoAn_NhomF/admin.header')
<!-- start-top-search-->
<div id="search">
    <form action="" method="get">
        <input type="text" name="keyword" id="cate" placeholder="Search here..." />
        <button type="submit" class="tip-bottom" title="Search">
            <i class="icon-search icon-white"></i>
        </button>
    </form>
</div>
<!--close-top-search -->
@include('DoAn_NhomF/admin.sidebar')

<!-- BEGIN CONTENT -->
<div id="content">
    <div id="content-header">
        <div id="breadcrumb">
            <a href="" title="Go to Home" class="tip-bottom current">
                <i class="icon-home"></i> Home
            </a>
        </div>
        <h1>Manage Categorys</h1>
    </div>

    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <a href="{{route('admin.from_add_category')}}">
                                <i class="icon-plus"></i>
                            </a>
                        </span>
                        <h5>Items</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>category_id</th>
                                    <th>category_name</th>
                                    <th>description</th>
                                    <th>created_at</th>
                                    <th>updated_at</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cate as $category )


                                <tr>
                                    <td>{{ $category->category_id }}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->created_at }}</td>
                                    <td>{{ $category->updated_at }}</td>
                                    <td>
                                        <a href="{{route('admin.from_update_category',['category_id'=>$category->category_id])}}" class="btn btn-success btn-mini">Edit</a>
                                        <!-- Form để xóa category -->
                                        <a class="btn btn-danger btn-mini" href="" class="btn btn-success btn-mini">Delete</a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        <div class="row" style="margin-left: 18px;">
                            <ul class="pagination">
                                <li {{ $cate->links('pagination::bootstrap-4') }}</li>
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