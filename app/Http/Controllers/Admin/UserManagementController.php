<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->s == null)
            $users = User::paginate(10);
        else
            $users = User::where('title', 'LIKE', '%' . $request->s . '%')->paginate(10);
        $searchString = $request->s != null ? $request->s : null;
        return view('admin.users.index', compact('searchString', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }
    public function changeRole(int $id, Request $request)
    {
        try {
            User::where('id', $id)->update(['role' => $request->role]);
        } catch (\Throwable $th) {
            return back()->with('error', 'Có lỗi xảy ra! Vui lòng thử lại');
        }
        return back()->with('success', 'Phân quyền thành công!');
    }


    public function banUser(int $id, Request $request)
    {
        $user = User::find($id);
        $time = $request->time;
        if ($time >= 0) {
            $current_time = time();
            $ban_time = $current_time + ($time * 60);
            try {
                $user->ban_time = $ban_time;
                $user->save();
            } catch (\Throwable $th) {
                return back()->with('error', 'Có lỗi xảy ra! Vui lòng thử lại');
            }
            return back()->with('success', 'Đã khóa tài khoản ' . $user->name . ' trong ' . $time . ' phút.');
        }
        return back()->with('error', 'Có lỗi xảy ra! Vui lòng thử lại');
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            User::destroy($id);
        } catch (\Throwable $th) {
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
        return back()->with('success', 'Xóa bài viết thành công');
    }
}
