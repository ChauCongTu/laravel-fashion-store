<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BannerManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->s == null)
            $banners = Banner::paginate(10);
        else
            $banners = Banner::where('title', 'LIKE', '%' . $request->s . '%')->paginate(10);
        $searchString = $request->s != null ? $request->s : null;
        return view('admin.banners.index', compact('searchString', 'banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banners.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        if ($request->hasFile('photo')) {
            if ($request->photo->getSize() > 1024 * 1024)
                return back()->with('error', 'Hình ảnh tải lên không được lớn hơn 1MB');
            $banner = $request->except('_token');
            $fileName = Str::random(14) . '.' . $request->photo->extension();
            $banner['photo'] = 'banner/' . $fileName;
            Storage::putFileAs('public', $request->photo, $banner['photo']);
            Banner::create($banner);
            return redirect(route('quan-ly-banner.index'))->with('success', 'Thêm banner thành công');
        }
        return back()->with('error', 'Vui lòng chọn ảnh để tải lên');
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
        $banner = Banner::find($id);
        return view('admin.banners.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $banner = $request->except('_token');
        if ($request->hasFile('photo')) {
            if ($request->photo->getSize() > 1024 * 1024)
                return back()->with('error', 'Hình ảnh tải lên không được lớn hơn 1MB');
            $fileName = Str::random(14) . '.' . $request->photo->extension();
            $banner['photo'] = 'banner/' . $fileName;
            Storage::putFileAs('public', $request->photo, $banner['photo']);
        }
        Banner::where('id', $id)->update($banner);
        return redirect(route('quan-ly-banner.index'))->with('success', 'Thêm banner thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            Banner::destroy($id);
        } catch (\Throwable $th) {
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
        return back()->with('success', 'Xóa banner thành công');
    }
}
