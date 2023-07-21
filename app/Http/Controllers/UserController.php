<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function myOrder(Request $request){
        if ($request->status == 'dang-giao-hang') {
            $status = 'Đang giao hàng';
            $orders = Order::where('user_id', Auth::id())->where('status', 'Đang giao hàng')->orderBy('id', 'DESC')->paginate(8);
        }
        elseif ($request->status == 'da-nhan-hang') {
            $status = 'Đang giao hàng';
            $orders = Order::where('user_id', Auth::id())->where('status', 'Hoàn thành')->orderBy('id', 'DESC')->paginate(8);
        }
        elseif ($request->status == 'da-huy') {
            $status = 'Đã hủy';
            $orders = Order::where('user_id', Auth::id())->where('status', 'Đã hủy')->orderBy('id', 'DESC')->paginate(8);
        }
        elseif ($request->status == 'dang-xu-ly') {
            $status = 'Đã nhận hàng';
            $orders = Order::where('user_id', Auth::id())->where('status', 'Đang xử lý')->orderBy('id', 'DESC')->paginate(8);
        }
        else {
            $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->paginate(8);
        }
        // dd($orders);
        return view('users.orders', compact('orders'));
    }
    public function orderDetail(string $code) {
        $order = Order::findByCode($code);
        return view('users.order-detail', compact('order'));
    }
}
