<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
    }
    public function index()
    {
        $slideBanners = Banner::where('type', 'slide')->orderBy('id', 'DESC')->limit(5)->get();
        $blockBanners = Banner::where('type', 'block')->orderBy('id', 'DESC')->limit(3)->get();
        $categories = Category::where('is_parent', 1)->get();
        $products = Product::orderBy('id', 'DESC')->limit(16)->get();
        $topSale = Product::select('*', DB::raw('(((price - discount)/price)*100) as percent_discount'))
            ->where('discount', '!=', 0)
            ->orderBy('percent_discount', 'DESC')
            ->limit(10)
            ->get();
        return view('welcome', compact(
            'slideBanners',
            'blockBanners',
            'categories',
            'products',
            'topSale'
        ));
    }
}
