@extends('layouts.master')
@section('title')
    {{ $post->title }}
@endsection
@section('content')
    <!-- breadcrumb -->
    <div class="container m-t-55">
        <div class="bread-crumb flex-w p-r-15 p-t-30 p-lr-0-lg">
            <a href="index.html" class="cl8 hov-cl1 trans-04">
                Home
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <a href="/blog" class="cl8 hov-cl1 trans-04">
                Blog
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>

            <span class="cl4">
                {{ $post->title }}
            </span>
        </div>
    </div>
    <!-- Content page -->
    <section class="bg0 p-t-52 p-b-20">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-45 p-r-0-lg">
                        <!--  -->
                        <div class="wrap-pic-w how-pos5-parent">
                            <img src="{{ asset('storage/' . $post->photo) }}" width="100%" alt="IMG-BLOG">

                            <div class="flex-col-c-m size-123 bg9 how-pos5">
                                <span class="ltext-107 cl2 txt-center">
                                    {{ date('d', strtotime($post->created_at)) }}
                                </span>

                                <span class="stext-109 cl3 txt-center">
                                    {{ date('M Y', strtotime($post->created_at)) }}
                                </span>
                            </div>
                        </div>

                        <div class="p-t-32">
                            <span class="flex-w flex-m cl2 p-b-19">
                                <span>
                                    <span class="cl4">By</span> {{ $post->user->name }}
                                    <span class="cl12 m-l-4 m-r-6">|</span>
                                </span>

                                <span>
                                    {{ date('d/m/Y', strtotime($post->created_at)) }}
                                    <span class="cl12 m-l-4 m-r-6">|</span>
                                </span>
                            </span>

                            <h2 class="cl2 p-b-28">
                                {{ $post->title }}
                            </h2>

                            <div class="content-post">
                                {!! $post->content !!}
                            </div>
                        </div>

                        <div class="flex-w flex-t p-t-16">
                            <span class="size-216 stext-116 cl8 p-t-4">
                                Tags
                            </span>

                            <div class="flex-w size-217">
                                @foreach ($post->tag as $tag)
                                    <a href="#"
                                        class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                        {{ $tag }}
                                    </a>
                                @endforeach
                            </div>
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


                        <div class="p-t-50">
                            <h4 class="mtext-112 cl2 p-b-27">
                                Tags
                            </h4>

                            <div class="flex-w m-r--5">
                                @foreach ($post->tag as $tag)
                                    <a href="#"
                                        class="flex-c-m stext-107 cl6 size-301 bor7 p-lr-15 hov-tag1 trans-04 m-r-5 m-b-5">
                                        {{ $tag }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
