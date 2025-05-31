{{-- resources/views/admin/dashboard.blade.php --}}

@include('DoAn_NhomF.admin.header')

@include('DoAn_NhomF.admin.sidebar')



<!-- BEGIN CONTENT -->
<div id="content">
    <div class="container mt-5">
        <!-- Tiêu đề trang với 2 nút -->
        <div class="d-flex align-items-center mb-4">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary ml-2">Quản lý đơn hàng</a>
            <button type="button" class="btn btn-primary">Đã giao</button>
        </div>

        @foreach($orders as $order)
        <!-- Thông tin đơn hàng -->
        <div class="card mb-4 ">
            <div class="card-body">
                <!-- Dòng đầu: Mã đơn hàng và Mã người dùng -->

                <p class="mb-0"><strong>Mã đơn hàng:</strong> {{ $order->order_id }}</p>

                <p class="mb-0"><strong>Mã người dùng:</strong> {{ $order->user->user_id }}</p>

                <!-- Dòng thứ 2: Tổng tiền và Ngày giao hàng -->

                <p class="mb-0"><strong>Tổng tiền:</strong> {{ number_format($order->total_amount, 0) }} VND</p>

                <p class="mb-0"><strong>Ngày giao hàng:</strong> {{ $order->shipped_at ?? 'Chưa giao hàng' }}</p>

                <p class="mb-0"><strong>Kiểu thanh toántoán:</strong> {{ $order->payment }}</p>
            </div>
        </div>

        <!-- Danh sách sản phẩm -->
        <div class="card mb-4">
            <div class="card-header">
                Danh sách Sản phẩm
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Mã Size</th>
                            <th>Mã Color</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product->product_id }}</td>
                            <td>{{ $item->size ? $item->size->size_value : 'N/A' }}</td>
                            <td>{{ $item->color ? $item->color->color_name : 'N/A' }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->unit_price, 0) }} VND</td>
                            <td>{{ number_format($item->unit_price * $item->quantity, 0) }} VND</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        @endforeach
        <div class="d-flex justify-content-center">
            {{ $orders->links("pagination::bootstrap-4") }}
        </div>

    </div>

</div>
<!-- END CONTENT -->

@include('DoAn_NhomF.admin.footer')