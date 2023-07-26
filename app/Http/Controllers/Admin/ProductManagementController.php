<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Photo;
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
    public function updateStock(Request $request, int $id)
    {
        if ($request->stock == null || $request->stock < 0) {
            return back()->with('error', 'Cập nhật số lượng thất bại, số lượng sản phẩm không được nhỏ hơn 1');
        }
        $stock = $request->stock;
        try {
            Product::where('id', $id)->update(['stock' => $stock]);
        } catch (\Throwable $th) {
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
        return back()->with('success', 'Cập nhật số lượng thành công');
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

    public function image(int $product_id)
    {
        $images = Photo::where('product_id', $product_id)->get();
        return view('admin.products.image', compact('images', 'product_id'));
    }

    public function addImage(Request $request, int $product_id)
    {
        if ($request->photo == null)
            return back()->with('error', 'Tải lên thất bại, vui lòng chọn hình ảnh');
        $numb = 0;
        foreach ($request->photo as $photo) {
            if ($photo->getSize() > 1024 * 1024) {
                continue;
            }
            $validExtensions = ['jpeg', 'jpg', 'png'];
            $extension = $photo->getClientOriginalExtension();
            if (!in_array($extension, $validExtensions)) {
                continue;
            }
            $path = "/product/extension/" . $photo->hashName();
            Storage::putFileAs('public', $photo, $path);
            $image = new Photo();
            $image->product_id = $product_id;
            $image->photo = $path;
            $image->save();
            $numb++;
        }
        return back()->with('success', 'Tải lên thành công ' . $numb . ' ảnh');
    }
    public function deleteImage(int $id)
    {
        try {
            Photo::destroy($id);
        } catch (\Throwable $th) {
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại #' . $th->getCode());
        }
        return back()->with('success', 'Xóa hình ảnh thành công');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            Product::destroy($id);
        } catch (\Throwable $th) {
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại #' . $th->getCode());
        }
        return back()->with('success', 'Xóa sản phẩm thành công');
    }
}
