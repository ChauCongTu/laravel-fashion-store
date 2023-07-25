<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->MaSanPham == null)
            $products = Product::select('*', DB::raw('((discount/price)*100) as percent_discount, (price - discount) as display_price'))->paginate(10);
        else
            $products = Product::select('*', DB::raw('((discount/price)*100) as percent_discount, (price - discount) as display_price'))->where('code', $request->MaSanPham)->paginate(10);
        $searchString = $request->MaSanPham != null ? $request->MaSanPham : null;
        return view('admin.products.index', compact('products', 'searchString'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brand = Brand::all();
        return view('admin.products.add', compact('categories', 'brand'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        if (!$request->hasFile('photo')) {
            return back()->with('error', 'Vui lòng tải lên hình ảnh đại diện cho sản phẩm');
        }
        $product = $request->except('_token');
        $product['code'] = 'P' . date('hisdmy');
        $product['slug'] = Str::slug($product['name']) . '-' . date('hisdmy');
        $fileName = $product['slug'] . '.' . $request->photo->extension();
        $product['photo'] = 'product/' . $fileName;
        Storage::putFileAs('public/product', $request->photo, $fileName);
        // dd($product);
        Product::create($product);
        return redirect(route('quan-ly-san-pham.index'))->with('success', 'Thêm sản phẩm thành công');
    }
    public function updateDiscount(Request $request, int $id)
    {
        $discount = ($request->discount == null || $request->discount < 0) ? 0 : $request->discount;
        try {
            Product::where('id', $id)->update(['discount' => $discount]);
        } catch (\Throwable $th) {
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
        return back()->with('success', 'Cập nhật khuyến mãi thành công');
    }
    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        $brand = Brand::all();
        return view('admin.products.edit', compact('product', 'categories', 'brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $product = $request->except('_token', '_method');
        $product['slug'] = Str::slug($product['name']) . '-' . date('hisdmy');
        if ($request->hasFile('photo')) {
            $fileName = $product['slug'] . '.' . $request->photo->extension();
            $product['photo'] = 'product/' . $fileName;
            Storage::putFileAs('public/product', $request->photo, $fileName);
        }
        // dd($product);
        Product::where('id', $id)->update($product);
        return redirect(route('quan-ly-san-pham.index'))->with('success', 'Thêm sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            Product::destroy($id);
        } catch (\Throwable $th) {
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
        return back()->with('success', 'Xóa sản phẩm thành công');
    }
}
