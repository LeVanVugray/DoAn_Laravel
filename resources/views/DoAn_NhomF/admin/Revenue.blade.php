{{-- resources/views/DoAn_NhomF/admin/categories.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    /* Container hiển thị các thẻ theo hàng ngang */
    .card-container {
        display: flex;
        flex-wrap: wrap;
        /* Không xuống hàng */
        overflow-x: auto;
        /* Cuộn ngang khi tràn */
        gap: 20px;
        padding-bottom: 10px;
    }

    /* Ẩn scrollbar (nếu muốn) */
    .card-container::-webkit-scrollbar {
        height: 10px;
    }

    .card-container::-webkit-scrollbar-thumb {
        background: #555;
        border-radius: 4px;
    }

    .card-container::-webkit-scrollbar-track {
        background: transparent;
    }

    /* Card người dùng */
    .card {
        background-color: #2c2c3e;
        color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        width: 200px;
        flex-shrink: 0;
    }

    /* Nút Sửa */
    .btn-green {
        background-color: transparent;
        border: 2px solid #28a745;
        color: #28a745;
        padding: 6px 15px;
        border-radius: 6px;
        cursor: pointer;
    }

    .btn-green:hover {
        background-color: #28a745;
        color: white;
    }

    /* Nút Xóa */
    .btn-red {
        background-color: transparent;
        border: 2px solid #dc3545;
        color: #dc3545;
        padding: 6px 15px;
        border-radius: 6px;
        cursor: pointer;
    }

    .btn-red:hover {
        background-color: #dc3545;
        color: white;
    }
    </style>

</head>

<body>


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
        <div id="content-header">
            <div id="breadcrumb">
                <a href="" title="Go to Home" class="tip-bottom current">
                    <i class="icon-home"></i> Home
                </a>
            </div>
            <h1>Manage Revenue</h1>
        </div>
    <div class="container mt-4">
    <h3 class="mb-4">DANH SÁCH LOẠI GIÀY</h3>

    <div class="card-container">
        @foreach($users as $user)
            <div class="card">
                <h5 class="card-title font-weight-bold">{{$user->name}}</h5>
                <p class="card-text text-muted">{{$user->email}}</p>
                <small class="text-secondary">Tạo lúc: {{$user->created_at}}</small>
                <div class="mt-3 d-flex justify-content-between">
                    <a href="" class="btn btn-green">Sửa</a>
                    <form action="" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-red" type="submit">Xóa</button>
                    </form>
                </div>
            </div>
        @endforeach
        {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-4">
    </div>
</div>



       

        @include('DoAn_NhomF.admin.footer')

</body>

</html>