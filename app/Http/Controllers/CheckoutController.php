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
            return redirect(route('vnpay'));
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
        $order = Order::findByCode($code);
        if ($order->status == 'Đang xử lý') {
            $order->status = 'Đã hủy';
            $order->save();
            return redirect()->back()->with('msg', $request->status . ' đơn hàng thành công');
        }
        return back()->with('error', 'Không thể hủy đơn hàng khi đã bắt đầu vận chuyển. Nếu cần hỗ trợ, hãy liên hệ chúng tôi qua email: <b>cskh@nzfashion.com</b> hoặc hotline: <b>19001990</b>');
    }
    public function vnpay_payment()
    {
        if (session()->has('order')) {
            $orders = session()->get('order');
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://127.0.0.1:8000/thanh-toan-thanh-cong";
            $vnp_TmnCode = "E7F2DNY5"; //Mã website tại VNPAY
            $vnp_HashSecret = "IAQGTNGGRNSINNTBUYMSHQFYGDUSKCSJ"; //Chuỗi bí mật

            $vnp_TxnRef = $orders['code']; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Thanh toán đơn hàng ' . $orders['code'];
            $vnp_OrderType = 'Thanh toán VN PAY';
            $vnp_Amount = $orders['total'] * 100;
            $vnp_Locale = 'vn';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            //Add Params of 2.0.1 Version
            // $vnp_ExpireDate = '12/08/2023';
            //Billing
            // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
            // $vnp_Bill_Email = $_POST['txt_billing_email'];
            // $fullName = trim($_POST['txt_billing_fullname']);
            // if (isset($fullName) && trim($fullName) != '') {
            //     $name = explode(' ', $fullName);
            //     $vnp_Bill_FirstName = array_shift($name);
            //     $vnp_Bill_LastName = array_pop($name);
            // }
            // $vnp_Bill_Address = $_POST['txt_inv_addr1'];
            // $vnp_Bill_City = $_POST['txt_bill_city'];
            // $vnp_Bill_Country = $_POST['txt_bill_country'];
            // $vnp_Bill_State = $_POST['txt_bill_state'];
            // // Invoice
            $vnp_Inv_Phone = $orders['phone'];
            $vnp_Inv_Email = $orders['email'];
            $vnp_Inv_Customer = $orders['name'];
            $vnp_Inv_Address = $orders['address2'] . ' - ' . $orders['address1'];
            // $vnp_Inv_Company = $_POST['txt_inv_company'];
            // $vnp_Inv_Taxcode = $_POST['txt_inv_taxcode'];
            // $vnp_Inv_Type = $_POST['cbo_inv_type'];
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
                // "vnp_ExpireDate" => $vnp_ExpireDate,
                // "vnp_Bill_Mobile" => $vnp_Bill_Mobile,
                // "vnp_Bill_Email" => $vnp_Bill_Email,
                // "vnp_Bill_FirstName" => $vnp_Bill_FirstName,
                // "vnp_Bill_LastName" => $vnp_Bill_LastName,
                // "vnp_Bill_Address" => $vnp_Bill_Address,
                // "vnp_Bill_City" => $vnp_Bill_City,
                // "vnp_Bill_Country" => $vnp_Bill_Country,
                "vnp_Inv_Phone" => $vnp_Inv_Phone,
                "vnp_Inv_Email" => $vnp_Inv_Email,
                "vnp_Inv_Customer" => $vnp_Inv_Customer,
                "vnp_Inv_Address" => $vnp_Inv_Address,
                // "vnp_Inv_Company" => $vnp_Inv_Company,
                // "vnp_Inv_Taxcode" => $vnp_Inv_Taxcode,
                // "vnp_Inv_Type" => $vnp_Inv_Type
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
                $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            }

            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00', 'message' => 'success', 'data' => $vnp_Url
            );
            header('Location: ' . $vnp_Url);
            die();
        } else {
            abort("404");
        }
    }
    public function finishPayment(Request $request)
    {
        $vnp_SecureHash = $_GET['vnp_SecureHash'];
        $inputData = array();
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }

        $secureHash = hash_hmac('sha512', $hashData, 'IAQGTNGGRNSINNTBUYMSHQFYGDUSKCSJ');
        if ($secureHash == $vnp_SecureHash) {
            if ($_GET['vnp_ResponseCode'] == '00') {
                $order = session()->get('order');
                $order['payment_method'] = 'vnpay';
                $order['payment_status'] = 'Đã thanh toán';
                $orders = Order::create($order);
                $details = session()->get('details');
                foreach ($details as $item) {
                    $item['order_id'] = $orders->id;
                    OrderDetail::create($item);
                }
                session()->forget('cart');
                session()->forget('order');
                session()->forget('details');
                return redirect(route('home'))->with('msg', 'Đặt hàng thành công! Hãy theo dõi đơn hàng của bạn để nhận được sản phẩm sớm nhất nhé bạn ^^');
            } else {
                return redirect(route('cart.checkout'))->with('msg', 'Lỗi giao dịch! Vui lòng thử lại');
            }
        } else {
            return redirect(route('cart.checkout'))->with('msg', 'Lỗi giao dịch! Vui lòng thử lại');
        }
    }
}
