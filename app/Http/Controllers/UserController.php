<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function myInfo($id = null)
    {
        if ($id == null)
            $id = Auth::id();
        $user = User::find($id);
        return view('users.my-account', compact('user'));
    }
    public function editInfo(UserRequest $request, $id = null)
    {
        if ($id == null)
            $id = Auth::id();
        $user = $request->except('_token');
        User::where('id', $id)->update($user);
        return redirect()->back()->with('msg', 'Lưu thay đổi thành công');
    }
    public function changeAvatar(Request $request, $id = null)
    {
        if ($id == null) {
            $id = Auth::id();
        }
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');

            if ($image->getSize() > 1024*1024) {
                return back()->with('error', 'Kích thước tối đa của hình ảnh là 1 MB');
            }
            $validExtensions = ['jpeg', 'jpg', 'png'];
            $extension = $image->getClientOriginalExtension();
            if (!in_array($extension, $validExtensions)) {
                return back()->with('error', 'Định dạng ảnh không được hỗ trợ');
            }
            $fileName = $id . '.' . $extension;
            Storage::putFileAs('public/users', $image, $fileName);
            User::where('id', $id)->update(['photo' => 'users/' . $fileName]);

            return back()->with('msg', 'Thay đổi avatar thành công');
        }

        return back()->with('error', 'Không tìm thấy ảnh để cập nhật');
    }
    public function myOrder(Request $request)
    {
        if ($request->status == 'dang-giao-hang') {
            $orders = Order::where('user_id', Auth::id())->where('status', 'Đang giao hàng')->orderBy('id', 'DESC')->paginate(8);
        } elseif ($request->status == 'da-nhan-hang') {
            $orders = Order::where('user_id', Auth::id())->where('status', 'Hoàn thành')->orderBy('id', 'DESC')->paginate(8);
        } elseif ($request->status == 'da-huy') {
            $orders = Order::where('user_id', Auth::id())->where('status', 'Đã hủy')->orderBy('id', 'DESC')->paginate(8);
        } elseif ($request->status == 'dang-xu-ly') {
            $orders = Order::where('user_id', Auth::id())->where('status', 'Đang xử lý')->orderBy('id', 'DESC')->paginate(8);
        } else {
            $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->paginate(8);
        }
        // dd($orders);
        return view('users.orders', compact('orders'));
    }
    public function orderDetail(string $code)
    {
        $order = Order::findByCode($code);
        return view('users.order-detail', compact('order'));
    }
}
