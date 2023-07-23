<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function getCheckout()
    {
        $cart = session()->get('cart');
        $cart['code'] = 'U' . Auth::id() . 'T' . date('hidmy') . 'CRT';
        if ($cart == null || count($cart['products']) == 0) {
            return redirect()->back()->with('error', 'Bạn có mua gì đâu mà đòi thanh toán');
        }
        session()->put('cart', $cart);
        session()->save();
        return view('cart.checkout', compact('cart'));
    }
    public function postCheckout(OrderRequest $request)
    {
        // Lưu toàn bộ thông tin đơn đặt hàng vào session('order')
        $cart = session()->get('cart');
        $order = new Order();
        $order->code = $cart['code'];
        $order->user_id = Auth::id();
        $order->sub_total = $cart['total'];
        $order->total = $cart['final_price'];
        $order->coupon = $cart['coupon'];
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address1 = $request->ward . ' - ' . $request->district . ' - ' . $request->city;
        $order->address2 = $request->address2;
        $details = [];
        foreach ($cart['products'] as $item) {
            $details[] = [
                'product_id' => $item['id'],
                'order_id' => ''
                /** Lây Last insert id của Order vừa insert: $order->id */
                ,
                'size' => $item['size'],
                'color' => $item['color'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'total_price' => $item['total_price']
            ];
        }

        session()->put('order', $order->toArray());
        session()->put('details', $details);

        if ($request->payment_method == 'cod') {
            // Thanh toán khi nhận hàng
            $order->save();
            foreach ($details as $item) {
                $item['order_id'] = $order->id;
                OrderDetail::create($item);
            }
            session()->forget('cart');
            session()->forget('order');
            session()->forget('details');
            // dd($order);
            // Sau khi đặt hàng thành công trả về trang quản lý đơn hàng với thông báo đặt hàng thành công
            return redirect(route('home'))->with('msg', 'Đặt hàng thành công! Hãy theo dõi đơn hàng của bạn để nhận được sản phẩm sớm nhất nhé bạn ^^');
        } else {
            // Chuyển hướng sang trang thanh toán online
            return redirect()->back()->with('error', 'Tính năng thanh toán trực tuyến hiện đang bảo trì. Chúng tôi sẽ mở lại sớm nhất có thể');
            // Sau khi thanh toán xong gọi controller post finishCheckout
            // Controller finishCheckout sẽ lấy thông tin trong session('order') để lưu vào csdl
            // Sau đó hủy session order và cart
            // session()->forget('cart');
            // session()->forget('order');
            // session()->forget('details');
        }
    }
    public function updateStatus(string $code, Request $request)
    {
        try {
            Order::findByCode($code)->update(['status' => $request->status, 'cancel_reason' => $request->reason]);
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại!<br /><br />Nếu tình trạng vẫn xảy ra, hãy báo cáo cho chúng tôi với mã lỗi: ' . $th->getCode());
        }
        return redirect()->back()->with('msg', $request->status . ' đơn hàng thành công');
    }
    public function payment()
    {
    }
}
