
{{-- resources/views/admin/dashboard.blade.php --}}

@include('DoAn_NhomF.admin.header')
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
@include('DoAn_NhomF.admin.sidebar')

<!-- BEGIN CONTENT -->
<div id="content">
    <h1>Dashboard</h1>
</div>
<!-- END CONTENT -->

@include('DoAn_NhomF.admin.footer')
