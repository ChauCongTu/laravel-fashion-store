<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->s == null)
            $posts = Post::paginate(10);
        else
            $posts = Post::where('title', 'LIKE', '%' . $request->s . '%')->paginate(10);
        $searchString = $request->s != null ? $request->s : null;
        return view('admin.posts.index', compact('searchString', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.posts.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        if ($request->hasFile('photo')) {
            if ($request->photo->getSize() > 1024 * 1024)
                return back()->with('error', 'Hình ảnh tải lên không được lớn hơn 1MB');
            $post = $request->except('_token');
            $post['slug'] = Str::slug($post['title']) . '-' . date('hisdmy');
            $fileName = $post['slug'] . '.' . $request->photo->extension();
            $post['photo'] = 'post/' . $fileName;
            Storage::putFileAs('public', $request->photo, $post['photo']);
            Post::create($post);
            return redirect(route('quan-ly-bai-viet.index'))->with('success', 'Thêm bài viết thành công');
        }
        return back()->with('error', 'Vui lòng tải lên hình ảnh');
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
        $post = Post::find($id);
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $post = $request->except('_token');
        $post['slug'] = Str::slug($post['title']) . '-' . date('hisdmy');
        if ($request->hasFile('photo')) {
            if ($request->photo->getSize() > 1024 * 1024)
                return back()->with('error', 'Hình ảnh tải lên không được lớn hơn 1MB');

            $fileName = $post['slug'] . '.' . $request->photo->extension();
            $post['photo'] = 'post/' . $fileName;
            Storage::putFileAs('public', $request->photo, $post['photo']);
        }
        Post::where('id', $id)->update($post);
        return redirect(route('quan-ly-bai-viet.index'))->with('success', 'Chỉnh sửa bài viết thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            Post::destroy($id);
        } catch (\Throwable $th) {
            return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
        return back()->with('success', 'Xóa bài viết thành công');
    }
}
