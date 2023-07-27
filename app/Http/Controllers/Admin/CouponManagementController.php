<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->s == null)
            $coupon = Coupon::paginate(10);
        else
            $coupon = Coupon::where('code', 'LIKE', '%' . $request->s . '%')->paginate(10);
        $searchString = $request->s != null ? $request->s : null;
        return view('admin.coupon.index', compact('searchString', 'coupon'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.coupon.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CouponRequest $request)
    {
        $coupon = $request->except('_token');
        Coupon::create($coupon);
        return redirect(route('ma-giam-gia.index'))->with('success', 'Tạo mã khuyến mãi thành công');
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
        $coupon = Coupon::find($id);
        return view('admin.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CouponRequest $request, int $id)
    {
        $coupon = $request->except('_token', '_method', 'code');
        Coupon::where('id', $id)->update($coupon);
        return redirect(route('ma-giam-gia.index'))->with('success', 'Cập nhật mã khuyến mãi thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Coupon::destroy($id);
        return redirect(route('ma-giam-gia.index'))->with('success', 'Xóa mã khuyến mãi thành công');
    }
}
