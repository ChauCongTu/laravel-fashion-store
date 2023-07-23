<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\CouponUsed;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart');
        return view('cart.index', compact('cart'));
    }
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart');
        $quantity = $request->quantity;
        if ($quantity > 0) {
            $cart['products'][$request->id]['quantity'] = $quantity;
            $cart['products'][$request->id]['total_price'] = $cart['products'][$request->id]['price'] * $cart['products'][$request->id]['quantity'];
            $cart['coupon'] = 0;
        } else {
            unset($cart['products'][$request->id]);
            $cart['coupon'] = 0;
        }
        $cart['total'] = 0;
        foreach ($cart['products'] as $item) {
            $cart['total'] = $cart['total'] + $item['total_price'];
        }
        $cart['final_price'] = $cart['total'];
        session()->put('cart', $cart);
        session()->save();
        return redirect()->back()->with('msg', 'Cập nhật giỏ hàng thành công');
    }
    public function applyCoupon(Request $request)
    {
        $cart = session()->get('cart');
        $request->coupon;
        if ($request->coupon == null)
            return redirect()->back()->with('error', 'Bạn chưa nhập mã giảm giá');
        $coupon = Coupon::where('code', $request->coupon)->first();
        if ($coupon == null)
            return redirect()->back()->with('error', 'Mã giảm giá không tồn tại');
        if ($coupon->usage_limit <= $coupon->usage_used)
            return redirect()->back()->with('error', 'Mã giảm giá đã hết lượt sử dụng');
        if (date('Y-m-d H:i:s') < date('Y-m-d H:i:s', strtotime($coupon->expired)) || $coupon->expired == null) {
            if (CouponUsed::where('user_id', Auth::id())->where('coupon', $request->coupon)->count() > 0) {
                return redirect()->back()->with('error', 'Bạn đã sử dụng mã giảm giá này rồi');
            }
            if ($coupon->type == 'price') {
                $discount = $coupon->value;
                $cart['coupon'] += $discount;
                $cart['final_price'] = $cart['final_price'] - $coupon->value;
            } else {
                $discount = $cart['final_price'] * ($coupon->value / 100);
                $cart['coupon'] += $discount;
                $cart['final_price'] = $cart['final_price'] - $discount;
            }
            $coupon->update([
                'usage_used' => $coupon->usage_used + 1,
            ]);
            $used = new CouponUsed();
            $used->user_id = Auth::id();
            $used->coupon = $request->coupon;
            $used->save();
            session()->put('cart', $cart);
            session()->save();
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Mã giảm giá đã hết hạn');
        }
    }
    public function order(Request $request)
    {
        dd($request);
    }
    public function checkout()
    {
    }
    public function addToCart(int $product_id, Request $request)
    {
        $quantity = $request->quantity != null ? $request->quantity : 1;
        $product = Product::select('*', DB::raw('(price - discount) as product_price'))->find($product_id);
        // dd($product);
        if (session()->has('cart')) {
            $cart = session()->get('cart');
            // dd($cart['products'][$product_id]);
            if (isset($cart['products'][$product_id])) {
                $cart['products'][$product_id]['quantity'] += $quantity;
                $cart['products'][$product_id]['total_price'] = $cart['products'][$product_id]['price'] * $cart['products'][$product_id]['quantity'];
            } else {
                $cart['products'][$product_id] = [
                    'id' => $product_id,
                    'name' => $product->name,
                    'photo' => $product->photo,
                    'slug' => $product->slug,
                    'quantity' => $quantity,
                    'size' => $request->size != null ? $request->size : 'M',
                    'color' => $request->color != null ? $request->color : 'Mặc định',
                    'price' => $product->product_price
                ];
                $cart['products'][$product_id]['total_price'] = $cart['products'][$product_id]['price'] * $cart['products'][$product_id]['quantity'];
            }
        } else {
            $cart = [
                'user_id' => Auth::id(),
                'code' => null,
                'coupon' => 0,
                'total' => 0,
                'products' => [
                    $product_id => [
                        'id' => $product_id,
                        'name' => $product->name,
                        'photo' => $product->photo,
                        'slug' => $product->slug,
                        'quantity' => $quantity,
                        'size' => $request->size != null ? $request->size : 'M',
                        'color' => $request->color != null ? $request->color : 'Mặc định',
                        'price' => $product->product_price
                    ]
                ],
            ];
            $cart['products'][$product_id]['total_price'] = $cart['products'][$product_id]['price'] * $cart['products'][$product_id]['quantity'];
        }
        $cart['total'] = 0;
        foreach ($cart['products'] as $item) {
            $cart['total'] = $cart['total'] + $item['total_price'];
        }
        $cart['final_price'] = $cart['total'];
        session()->put('cart', $cart);
        session()->save();
        return redirect()->back()->with('msg', 'Thêm vào giỏ hàng thành công');
    }
}
