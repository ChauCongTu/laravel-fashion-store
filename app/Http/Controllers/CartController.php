<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
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
                    'price' => $product->product_price
                ];
                $cart['products'][$product_id]['total_price'] = $cart['products'][$product_id]['price'] * $cart['products'][$product_id]['quantity'];
            }
        } else {
            $cart = [
                'user_id' => Auth::id(),
                'code' => 'CART-' . Auth::id() . '-' . date('Hisdmy'),
                'coupon' => null,
                'total' => 0,
                'products' => [
                    $product_id => [
                        'id' => $product_id,
                        'name' => $product->name,
                        'photo' => $product->photo,
                        'slug' => $product->slug,
                        'quantity' => $quantity,
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
        session()->put('cart', $cart);
        session()->save();
        return redirect()->back()->with('msg', 'Thêm vào giỏ hàng thành công');
    }
}
