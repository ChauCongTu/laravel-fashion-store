<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $wishlist = Wishlist::paginate(10);
        return view('wishlist.index', compact('wishlist'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(int $product_id)
    {
        if (Wishlist::where('product_id', $product_id)->where('user_id', Auth::id())->count() > 0) {
            return redirect()->back()->with('error', 'Sản phẩm đã có trong wishlist');
        }
        $wishlistItem = new Wishlist();
        $wishlistItem->user_id = Auth::id();
        $wishlistItem->product_id = $product_id;
        $wishlistItem->save();
        return redirect()->back()->with('msg', 'Thêm sản phẩm vào wishlist thành công');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $product_id)
    {
        $wishlist = Wishlist::where('product_id', $product_id)->where('user_id', Auth::id())->first();

        if ($wishlist) {
            $wishlist->delete();
            return redirect()->back()->with('msg', 'Xóa sản phẩm khỏi wishlist thành công');
        } else {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại trong wishlist');
        }
    }
}
