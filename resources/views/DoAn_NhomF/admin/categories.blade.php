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
        <h1>Manage Items</h1>
    </div>

    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <a href="#"> <i class="icon-plus"></i></a>
                        </span>
                        <h5>Items</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Featured</th>
                                    <th>Quantity</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Author</th>
                                    <th>Created at</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td width="250">
                                            <img src="" width="100" alt="">
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <a href="" class="btn btn-success btn-mini">Edit</a>
                                            <a href="" class="btn btn-danger btn-mini" onclick="return confirm('Are you sure?')">Delete</a>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>

                        {{-- Pagination --}}
                        <div class="row" style="margin-left: 18px;">
                            <ul class="pagination">
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
