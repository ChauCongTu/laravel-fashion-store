@extends('layouts.master')
@section('title')
    Tin tức
@endsection
@section('content')
    <!-- Title page -->
    <section class="bg-img1 txt-center p-lr-15 p-tb-92 m-t-75" style="background-image: url({{ asset('images/bg-02.jpg') }})">
        <h2 class="ltext-105 cl0 txt-center">
            Blog
        </h2>
    </section>


    <!-- Content page -->
    <section class="bg0 p-t-62 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">

                        @foreach ($posts as $post)
                            <div class="p-b-63">
                                <a href="{{ route('post.show', ['slug' => $post->slug, 'id' => $post->id]) }}"
                                    class="hov-img0 how-pos5-parent">
                                    <img src="{{ asset('storage/' . $post->photo) }}" alt="IMG-BLOG">

                                    <div class="flex-col-c-m size-123 bg9 how-pos5">
                                        <span class="ltext-107 cl2 txt-center">
                                            {{ date('d', strtotime($post->created_at)) }}
                                        </span>

                                        <span class="stext-109 cl3 txt-center">
                                            {{ date('M Y', strtotime($post->created_at)) }}
                                        </span>
                                    </div>
                                </a>

                                <div class="p-t-32">
                                    <h4 class="p-b-15">
                                        <a href="{{ route('post.show', ['slug' => $post->slug, 'id' => $post->id]) }}"
                                            class=" cl2 hov-cl1 trans-04">
                                            {{ $post->title }}
                                        </a>
                                    </h4>

                                    <p class="cl6 n-content">
                                        {{ $post->content }}
                                    </p>

                                    <div class="flex-w flex-sb-m p-t-18">
                                        <span class="flex-w flex-m cl2 p-r-30 m-tb-10">
                                            <span>
                                                <span class="cl4">By</span> {{ $post->user->name }}
                                            </span>
                                        </span>

                                        <a href="{{ route('post.show', ['slug' => $post->slug, 'id' => $post->id]) }}"
                                            class="stext-101 cl2 hov-cl1 trans-04 m-tb-10">
                                            Continue Reading

                                            <i class="fa fa-long-arrow-right m-l-9"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- Pagination -->
                        <div class="flex-l-m flex-w w-full p-t-10 m-lr--7">

                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 p-b-80">
                    <div class="side-menu">
                        <div class="p-t-65">
                            <h4 class="mtext-112 cl2 p-b-33">
                                Featured Products
                            </h4>

                            <ul>
                                @foreach ($featured_products as $product)
                                    <li class="flex-w flex-t p-b-30">
                                        <a href="#" class="wrao-pic-w size-214 hov-ovelay1 m-r-20">
                                            <img src="{{ asset('storage/' . $product->photo) }}" width="100%"
                                                alt="PRODUCT">
                                        </a>

                                        <div class="size-215 flex-col-t p-t-8">
                                            <a href="{{ route('product.show', ['slug' => $product->slug, 'id' => $product->id]) }}"
                                                class="stext-116 cl8 hov-cl1 trans-04">
                                                {{ $product->name }}
                                            </a>

                                            <span class="stext-116 cl6 p-t-20">
                                                {{ number_format($product->price, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
