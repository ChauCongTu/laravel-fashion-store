<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    public function index(Request $request)
    {
        $MaDonHang = $request->MaDonHang;
        $status = $request->status;

        $query = Order::orderBy('created_at', 'DESC');

        if ($status !== null) {
            $validStatuses = ['Đang xử lý', 'Đang giao hàng', 'Chờ lấy hàng', 'Hoàn thành', 'Đã hủy'];
            if (in_array($status, $validStatuses)) {
                $query->where('status', $status);
            }
        }

        if ($MaDonHang) {
            $query->where('code', $MaDonHang);
        }

        $orders = $query->paginate(8);

        return view('admin.orders.index', compact('orders', 'MaDonHang', 'status'));
    }


    public function updateStatus(int $id)
    {
        $order = Order::find($id);
        if ($order->status == 'Đang xử lý') {
            $order->status = 'Đang giao hàng';
            $order->load('detail.product');
            foreach ($order->detail as $detail) {
                $product = $detail->product;
                if ($product->stock < 1)
                    return back()->with('error', 'Không thành công! Vui lòng kiểm tra số lượng sản phẩm trong kho hàng.');
                $product->stock -= $detail->quantity;
                $product->save();
            }
            $order->save();
            return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công');
        } elseif ($order->status == 'Đang giao hàng') {
            $order->status = 'Chờ lấy hàng';
            $order->save();
            return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công');
        } elseif ($order->status == 'Chờ lấy hàng') {
            $order->status = 'Hoàn thành';
            $order->payment_status = 'Đã thanh toán';
            $order->save();
            return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công');
        }
        else {
            return back()->with('error', 'Không thành công! Vui lòng thử lại');
        }
    }
    public function detail(int $id)
    {
    }
}
// $status = $request->status;

// if ($status === 'Đang xử lý' || $status === 'Đang giao hàng' || $status === 'Chờ lấy hàng') {
//     $order = Order::find($id);
//     $order->status = $status;

//     if ($status === 'Đang giao hàng') {
//         $order->load('detail.product');

//         foreach ($order->detail as $detail) {
//             $product = $detail->product;
//             if ($product->stock < 1)
//                 return back()->with('error', 'Không thành công! Vui lòng kiểm tra số lượng sản phẩm trong kho hàng.');
//             $product->stock -= $detail->quantity;
//             $product->save();
//         }
//     }

//     $order->save();

//     return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công');
// } elseif ($status === 'Hoàn thành') {
//     $order = Order::find($id);
//     $order->payment_status = 'Đã thanh toán';
//     $order->status = 'Hoàn thành';
//     $order->save();
//     return back()->with('success', 'Cập nhật trạng thái đơn hàng thành công');
// } else {
//     return back()->with('error', 'Cập nhật trạng thái đơn hàng không thành công');
// }
