<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(string $slug, int $id) {
        $post = Post::find($id);
        $post->tag = explode('|', $post->tag);
        $featured_products = Product::where('is_featured', 1)->limit(6)->get();
        return view('post.show', compact('post', 'featured_products'));
    }
    public function list() {
        $posts = Post::orderBy('id', 'DESC')->paginate(6);
        $featured_products = Product::where('is_featured', 1)->limit(6)->get();
        return view('post.list', compact('posts', 'featured_products'));
    }
}
