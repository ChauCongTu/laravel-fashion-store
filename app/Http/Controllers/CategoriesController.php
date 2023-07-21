<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
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
    public function show(string $slug, int $id, Request $request)
    {
        $category = Category::find($id);
        $category_id = [$id];

        if ($category->child != null) {
            foreach ($category->child as $child) {
                $category_id[] = $child->id;
            }
        }
        $totalProduct = Product::whereIn('cat_id', $category_id)->count();
        $products = Product::select('*', DB::raw('((discount/price)*100) as percent_discount, (price - discount) as display_price'))
            ->whereIn('cat_id', $category_id)->limit(16)->get();
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

        return view('categories.show', compact('category', 'products', 'totalProduct', 'price', 'sortBy', 'priceMin', 'priceMax', 'wishlist'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
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
