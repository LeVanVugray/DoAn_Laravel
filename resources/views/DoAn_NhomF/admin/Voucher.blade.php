{{-- resources/views/admin/Vouchers.blade.php --}}
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
        <h1>Manage Voucher</h1>
    </div>

    <div class="container-fluid">
        <hr>
        <div class="row-fluid">
            <div class="span12">
                <div class="widget-box">
                    <div class="widget-title">
                        <span class="icon">
                            <a href="{{route('admin.from_add_voucher')}}">
                                <i class="icon-plus"></i>
                            </a>
                        </span>
                        <h5>Vouchers</h5>
                    </div>

                    <div class="widget-content nopadding">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>code</th>
                                    <th>description</th>
                                    <th>discount_type</th>
                                    <th>discount_value</th>
                                    <th>status</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vouchers as $voucher)
                                <tr>
                                    <td>{{ $voucher->id }}</td>
                                    <td>{{ $voucher->code }}</td>
                                    <td>{{ $voucher->description }}</td>
                                    <td>{{ $voucher->discount_type }}</td>
                                    <td>{{ $voucher->discount_value }}</td>
                                    <td>{{ $voucher->status ? 'Còn hiệu lực' : 'Hết hạn' }}</td>
                                    <td>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Phân trang -->
                <div class="row" style="margin-left: 18px;">
                    <ul class="pagination">
                        <li {{ $vouchers->links('pagination::bootstrap-4') }}</li>
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