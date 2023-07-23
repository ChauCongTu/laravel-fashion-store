<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $products = Product::findByName($request->s, 16);
        $wl = Wishlist::select('product_id')->where('user_id', Auth::id())->get();
        $wishlist = [];
        foreach ($wl as $item) {
            $wishlist[$item->product_id] = 0;
        }
        if ($request->priceMin != null && $request->priceMax != null) {
            $priceMin = $request->priceMin;
            $priceMax = $request->priceMax;
            $price = [$priceMin, $priceMax];
        } else {
            $price = explode("-", $request->price);
            $priceMin = $price[0];
            $priceMax = isset($price[1]) ? $price[1] : false;
        }
        if ($price[0] == '5000000') {
            $products = $products->where('display_price', '>', 5000000);
        } else if (count($price) == 2) {
            $products = $products->whereBetween('display_price', $price);
        }
        $price = implode("-", $price);
        $sortBy = $request->sortBy;
        if ($sortBy == 'rating') {
            $products = $products->sortBy('display_price');
        } else if ($sortBy == 'newest') {
            $products = $products->sortByDesc('id');
        } else if ($sortBy == 'highest') {
            $products = $products->sortByDesc('display_price');
        } else if ($sortBy == 'lowest') {
            $products = $products->sortBy('display_price')->values()->all();
        }
        $s = $request->s;
        return view('products.search-result', compact('s', 'products', 'price', 'sortBy', 'priceMin', 'priceMax', 'wishlist'));
    }
}
