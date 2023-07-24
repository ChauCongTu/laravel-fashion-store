@extends('layouts.master')

@section('title')
    Mua sắm trực tuyến quần, áo, giày, dép, phụ kiện với mức giá tốt nhất
@endsection

@section('content')
    <!-- Slider -->
    <section class="section-slide">
        <div class="wrap-slick1">
            <div class="slick1">
                {{-- Foreach Slide Banner --}}
                @foreach ($slideBanners as $banner)
                    <div class="item-slick1" style="background-image: url({{ asset('storage/' . $banner->photo) }});">
                        <div class="container h-full">
                            <div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
                                <div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
                                    <span class="ltext-101 cl2 respon2">
                                        {{ $banner->title }}
                                    </span>
                                </div>

                                <div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
                                    <h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
                                        {{ $banner->summary }}
                                    </h2>
                                </div>

                                <div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
                                    <a href="{{ $banner->path }}"
                                        class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                        Xem ngay
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- Banner -->
    <div class="sec-banner bg0 p-t-80 p-b-50">
        <div class="container">
            <div class="row">
                {{-- Foreach block banner --}}
                @foreach ($blockBanners as $banner)
                    <div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
                        <div class="block1 wrap-pic-w">
                            <img src="{{ asset('storage/' . $banner->photo) }}" alt="IMG-BANNER">

                            <a href="{{ $banner->path }}"
                                class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                                <div class="block1-txt-child1 flex-col-l">
                                    <span class="block1-name ltext-102 trans-04 p-b-8">
                                        {{ $banner->summary }}
                                    </span>

                                    <span class="block1-info stext-102 trans-04 w-50 text-center">
                                        {{ $banner->title }}
                                    </span>
                                </div>

                                <div class="block1-txt-child2 p-b-4 trans-05">
                                    <div class="block1-link stext-101 cl0 trans-09">
                                        Xem ngay
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <section class="flashsale pb-5" style="background-color: red">
        <div class="container">
            <div class="h3 text-light text-center py-5 fw-bold">GIÁ TỐT NHẤT NGÀY {{ date('d/m/Y') }}</div>
            <div class="slick-product">
                {{-- Each Product --}}
                @foreach ($topSale as $product)
                    <div class="product-item p-2">
                        <!-- Block2 -->
                        <div class="block2 bg-white p-2">
                            <div class="block2-pic hov-img0 label-new"
                                data-label="-{{ ceil($product->percent_discount) }}%">
                                <img src="{{ asset('storage/' . $product->photo) }}"
                                    alt="ảnh của sản phẩm {{ $product->name }}">
                                <form action="{{ route('cart.add', ['product_id' => $product->id]) }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="block2-btn flex-c-m cl2 w-75 py-2 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                        <i class="fa fa-cart-shopping me-2"></i> Thêm vào giỏ hàng
                                    </button>
                                </form>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="{{ route('product.show', ['slug' => $product->slug, 'id' => $product->id]) }}"
                                        class="fw-bold cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{ $product->name }}
                                    </a>

                                    <x-price :discount="$product->display_price" :price="$product->price" />
                                </div>

                                <div class="block2-txt-child2 flex-r p-t-3">
                                    @if (isset($wishlist[$product->id]))
                                        <form action="{{ route('wishlist.destroy', ['product_id' => $product->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="cl13 hov-cl1 trans-04"><i
                                                    class="fa-solid fa-heart"></i></button>
                                        </form>
                                    @else
                                        <form action="{{ route('wishlist.add', ['product_id' => $product->id]) }}"
                                            method="post">
                                            @csrf
                                            <button type="submit" class="cl13 hov-cl1 trans-04"><i
                                                    class="fa-regular fa-heart"></i></button>

                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Product -->
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="h1 mt-3 text-dark">Sản phẩm mới nhất</div>
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group m-tb-10">
                    <button class="cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
                        Tất cả sản phẩm
                    </button>
                    {{-- Forearch category --}}
                    @foreach ($categories as $category)
                        <button class="cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".{{ $category->slug }}">
                            {{ $category->name }}
                        </button>
                    @endforeach

                </div>
            </div>

            <div class="row isotope-grid" id="product-list">
                {{-- Each Product --}}
                @foreach ($products as $product)
                    <div
                        class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{ !empty($product->category->parent) ? $product->category->parent->slug : $product->category->slug }}">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0  {{ $product->status != 'default' ? 'label-hot' : false }}"
                                data-label="{{ strtoupper($product->status) }}">
                                <img src="{{ asset('storage/' . $product->photo) }}" alt="IMG-PRODUCT">

                                <form action="{{ route('cart.add', ['product_id' => $product->id]) }}" method="post">
                                    @csrf
                                    <button type="submit"
                                        class="block2-btn flex-c-m cl2 w-75 py-2 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                        <i class="fa fa-cart-shopping me-2"></i> Thêm vào giỏ hàng
                                    </button>
                                </form>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="{{ route('product.show', ['slug' => $product->slug, 'id' => $product->id]) }}"
                                        class="cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{ $product->name }}
                                    </a>

                                    <x-price :discount="$product->display_price" :price="$product->price" />
                                </div>

                                <div class="block2-txt-child2 flex-r p-t-3 pe-2">
                                    @if (isset($wishlist[$product->id]))
                                        <form action="{{ route('wishlist.destroy', ['product_id' => $product->id]) }}"
                                            method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="cl13 hov-cl1 trans-04"><i
                                                    class="fa-solid fa-heart"></i></button>
                                        </form>
                                    @else
                                        <form action="{{ route('wishlist.add', ['product_id' => $product->id]) }}"
                                            method="post">
                                            @csrf
                                            <button type="submit" class="cl13 hov-cl1 trans-04"><i
                                                    class="fa-regular fa-heart"></i></button>

                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                <button id="btnLoadmore" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                    Load More
                </button>
            </div>
        </div>
    </section>
@endsection
