<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->s == null)
            $categories = Category::paginate(10);
        else
            $categories = Category::where('name', 'LIKE', '%' . $request->s . '%')->paginate(10);
        $searchString = $request->s != null ? $request->s : null;
        return view('admin.categories.index', compact('searchString', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $rootCategories = Category::where('is_parent', 1)->get();
        return view('admin.categories.add', compact('rootCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->summary = $request->summary;
        if ($request->parent_id != 0) {
            $category->parent_id = $request->parent_id;
            $category->is_parent = 0;
        } else {
            $category->parent_id = null;
            $category->is_parent = 1;
        }
        $category->slug = Str::slug($category->name) . '-' . date('Hidmy');
        if ($request->hasFile('photo')) {
            $image = $request->photo;
            $fileName = $category->slug . '.' . $image->extension();
            Storage::putFileAs('public/categories', $image, $fileName);
            $category->photo = 'categories/'.$fileName;
        }
        else {
            return back()->with('error', 'Thêm danh mục không thành công! Bạn chưa chọn hình ảnh');
        }
        $category->user_id = Auth::id();
        $category->save();
        return redirect(route('quan-ly-danh-muc.index'))->with('success', 'Thêm danh mục sản phẩm thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $category = Category::find($id);
        $rootCategories = Category::where('is_parent', 1)->get();
        return view('admin.categories.edit', compact('rootCategories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, int $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->summary = $request->summary;
        if ($request->parent_id != 0) {
            $category->parent_id = $request->parent_id;
            $category->is_parent = 0;
        } else {
            $category->parent_id = null;
            $category->is_parent = 1;
        }
        $category->slug = Str::slug($category->name) . '-' . date('Hidmy');
        if ($request->hasFile('photo')) {
            $image = $request->photo;
            $fileName = $category->slug . '.' . $image->extension();
            Storage::putFileAs('public/categories', $image, $fileName);
            $category->photo = 'categories/'.$fileName;
        }
        $category->save();
        return redirect(route('quan-ly-danh-muc.index'))->with('success', 'Chỉnh sửa danh mục sản phẩm thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {

            $categoryChild = Category::where('parent_id', $id)->get();
            foreach ($categoryChild as $child) {
                $child->is_parent = 1;
                $child->parent_id == null;
                $child->save();
            }
            Category::destroy($id);
        } catch (\Throwable $th) {
            return back()->with('error', 'Có lỗi xảy ra, hãy thử lại! Nếu vẫn xảy ra tình trạng này hãy liên hệ bên Admin với mã lỗi:'. $th->getCode());
        }
        return back()->with('success', 'Xóa danh mục thành công');
    }
}
