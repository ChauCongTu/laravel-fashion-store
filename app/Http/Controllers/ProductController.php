<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug, int $id)
    {
        $product = Product::with('photos', 'reviews', 'comments')
            ->select('*', DB::raw('((discount/price)*100) as percent_discount, (price - discount) as display_price'))
            ->where('id', $id)
            ->first();

        $product->size = explode(', ', $product->size);
        $product->color = explode(', ', $product->color);
        session()->put('product_id', $id);

        $rel_prods = Product::select('*', DB::raw('((discount/price)*100) as percent_discount, (price - discount) as display_price'))
            ->where('id', '!=', $id)
            ->where(function ($query) use ($product) {
                $query->where('brand_id', $product->brand_id)
                    ->orWhere('cat_id', $product->cat_id);
            })
            ->orderByRaw('(CASE WHEN brand_id = ? THEN 1 ELSE 2 END), (CASE WHEN cat_id = ? THEN 1 ELSE 2 END)', [$product->brand_id, $product->cat_id])
            ->get();

        return view('products.show', compact('product', 'rel_prods'));
    }
    public function featured(Request $request)
    {
        $products = Product::with('photos', 'reviews', 'comments')
            ->select('*', DB::raw('((discount/price)*100) as percent_discount, (price - discount) as display_price'))
            ->where('is_featured', 1)->limit(16)->get();
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
    public function flashsale(Request $request)
    {
        $products = Product::with('photos', 'reviews', 'comments')
            ->select('*', DB::raw('((discount/price)*100) as percent_discount, (price - discount) as display_price'))
            ->limit(16)->get();
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
    public function comment(CommentRequest $request, int $reply_id = null)
    {
        if ($reply_id == null) {
            $comment = new Comment();
            $comment->user_id = Auth::id();
            $comment->product_id = session()->get('product_id');
            $comment->content = $request->content;
            $comment->save();
            return back();
        } else {
            $comment = new Comment();
            $comment->user_id = Auth::id();
            $comment->product_id = session()->get('product_id');
            $comment->content = $request->content;
            $comment->reply_id = $reply_id;
            $comment->save();
            return back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
