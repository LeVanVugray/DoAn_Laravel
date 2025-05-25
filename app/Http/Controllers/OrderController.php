<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Trả về danh sách toàn bộ đơn hàng cùng với các sản phẩm của từng đơn hàng.
     */
    public function index()
    {

        // Kiểm tra người dùng đã đăng nhập
        //if (!Auth::check()) {
        //return redirect()->route('login')
        //->with('error', 'Bạn cần đăng nhập để thực hiện thao tác này.');
        //}

        $user = Auth::user();

        // Lấy toàn bộ đơn hàng của user đang đăng nhập kèm theo các sản phẩm liên quan
        $orders = Order::whereIn('status', [1, 2])
            ->with(['orderItems.product', 'orderItems.size', 'orderItems.color'])
            ->orderBy('order_id', 'desc')
            ->paginate(1);
        // Trả về view với danh sách đơn hàng
        return view('DoAN_nhomF.admin.ordermanager', compact('orders'));
    }

    public function confirm($order_id)
    {
        // Tìm đơn hàng theo order_id.
        $order = Order::find($order_id);

        // Nếu không tìm thấy đơn hàng, chuyển hướng với thông báo lỗi.
        if (!$order) {
            return redirect()->back()->with('error', 'Đơn hàng không tồn tại.');
        }

        // Kiểm tra trạng thái đơn hàng, chỉ cập nhật nếu đang ở trạng thái "chờ xử lý" (1).
        if ($order->status != 1) {
            return redirect()->back()->with('error', 'Đơn hàng không ở trạng thái chờ xử lý.');
        }

        // Cập nhật trạng thái đơn hàng sang 2 và thiết lập thời gian giao hàng hiện tại.
        $order->status = 2;
        $order->shipped_at = now();
        $order->save();

        return redirect()->back()->with('success', 'Đơn hàng đã được chuyển sang trạng thái "Đã giao".');
    }

     public function cancel($order_id)
    {
        // Tìm đơn hàng theo order_id.
        $order = Order::find($order_id);

        // Nếu không tìm thấy, chuyển hướng với thông báo lỗi.
        if (!$order) {
            return redirect()->back()->with('error', 'Đơn hàng không tồn tại.');
        }

        // Chỉ cho phép xóa đơn hàng đang chờ xử lý (status = 1)
        if ($order->status != 1) {
            return redirect()->back()->with('error', 'Chỉ đơn hàng đang chờ xử lý mới có thể hủy và xóa.');
        }

        // Xóa đơn hàng (với cascade, các order items sẽ tự động bị xóa)
        $order->delete();

        return redirect()->back()->with('success', 'Đơn hàng đã được xóa thành công.');
    }

    public function showShippedOrder()
    {
        // Lấy tất cả các đơn hàng có status = 3 và eager load các quan hệ liên quan
        $orders = Order::where('status', 3)
            ->with(['orderItems.product', 'orderItems.size', 'orderItems.color'])
            ->orderBy('order_id', 'desc')
            ->paginate(1);

        // Trả về view 'orders.status3' với dữ liệu $orders
        return view('DoAN_nhomF.admin.shippedorder', compact('orders'));
    }
}
