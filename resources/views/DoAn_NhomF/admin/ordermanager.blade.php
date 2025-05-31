{{-- resources/views/admin/dashboard.blade.php --}}

@include('DoAn_NhomF.admin.header')

@include('DoAn_NhomF.admin.sidebar')



<!-- BEGIN CONTENT -->
<div id="content">
    <div class="container mt-5">
        <!-- Tiêu đề trang với 2 nút -->
        <div class="d-flex align-items-center mb-4">
            <button type="button" class="btn btn-primary">Quản lý đơn hàng</button>
            <a href="{{ route('admin.orders.showShippedOrder') }}" class="btn btn-secondary ml-2">Đã giao</a>
        </div>

        @foreach($orders as $order)

        <!-- Thông tin đơn hàng -->
        <div class="card mb-4">
            <div class="card-body border border-dark p-3">
                <!-- Dòng đầu: Mã đơn hàng và Mã người dùng -->

                <p class="mb-0"><strong>Mã đơn hàng:</strong> {{ $order->order_id }}</p>

                <p class="mb-0"><strong>Mã người dùng:</strong> {{ $order->user->user_id }}</p>

                <!-- Dòng thứ 2: Tổng tiền và Ngày giao hàng -->

                <p class="mb-0"><strong>Tổng tiền:</strong> {{ number_format($order->total_amount, 0) }} VND</p>

                <p class="mb-0"><strong>Ngày giao hàng:</strong> {{ $order->shipped_at ?? 'Chưa giao hàng' }}</p>

                <p class="mb-0"><strong>Kiểu thanh toán:</strong> {{ $order->payment }}</p>

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

        <!-- Trạng thái đơn hàng -->
        <div class="card">
            <div class="card-body">
                @if($order->status == 1)
                <div class="d-flex align-items-center">
                    <!-- Nút xác nhận -->
                    <form action="{{ route('admin.orders.confirm', $order->order_id) }}" method="POST" class="mr-2" onsubmit="return confirm('Bạn có chắc chắn muốn xác nhận đơn hàng này không?');">
                        @csrf
                        <button type="submit" class="btn btn-success">Xác nhận</button>
                    </form>
                    <!-- Nút hủy -->
                    <form action="{{ route('admin.orders.cancel', $order->order_id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này không?');">
                        @csrf
                        <button type="submit" class="btn btn-danger">Hủy</button>
                    </form>
                </div>


                @else
                <p class="mb-0"><strong>Trạng thái:</strong> Đang giao</p>
                @endif
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