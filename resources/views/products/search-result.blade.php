@extends('layouts.master')
@section('title')
    Kết quả tìm kiếm cho: {{ $s }}
@endsection
@section('content')
    <!-- breadcrumb -->
    <div class="container mt-5 py-3">
        <div class="bread-crumb flex-w p-r-15 p-t-30">
            <a href="{{ route('home') }}" class="cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="cl4">
                Kết quả tìm kiếm
            </span>
        </div>
    </div>
    {{-- Filter Section --}}
    <div class="bg0 p-b-140">
        <div class="container">
            <div class="flex-w flex-sb-m p-b-52">
                <div class="flex-w flex-l-m filter-tope-group">
                    <h1 class="h1">Kết quả tìm kiếm cho: {{ $s }}</h1>
                </div>

                <div class="flex-w flex-c-m m-tb-10">
                    <div class="flex-c-m stext-106 cl6 size-104 bor4 pointer hov-btn3 trans-04 m-r-8 m-tb-4 js-show-filter">
                        <i class="icon-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-filter-list"></i>
                        <i class="icon-close-filter cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
                        Bộ lọc
                    </div>
                </div>

                <!-- Filter -->

                <div class="dis-none panel-filter w-full p-t-10">
                    <form action="" method="get">
                        <input type="hidden" name="s" value="{{ $s }}">
                        <div class="wrap-filter row bg6 w-full p-lr-40 p-t-27 p-lr-15-sm">
                            <div class="col-md-3 p-r-15 p-b-27">
                                <div class="fw-bold cl2 p-b-15">
                                    Sắp xếp
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="sortBy" value="default" checked />
                                    <label class="form-check-label" for="flexRadioDefault1"><span
                                            class="filter-link stext-106 trans-04">Mặc định</span></label>
                                    <input class="form-check-input" type="radio" name="sortBy" value="rating"
                                        {{ $sortBy == 'rating' ? 'checked' : false }} />
                                    <label class="form-check-label" for="flexRadioDefault1"><span
                                            class="filter-link stext-106 trans-04">Top đánh giá</span></label>
                                    <input class="form-check-input" type="radio" name="sortBy" value="newest"
                                        {{ $sortBy == 'newest' ? 'checked' : false }} />
                                    <label class="form-check-label" for="flexRadioDefault1"><span
                                            class="filter-link stext-106 trans-04">Mới nhất</span></label>
                                    <input class="form-check-input" type="radio" name="sortBy" value="highest"
                                        {{ $sortBy == 'highest' ? 'checked' : false }} />
                                    <label class="form-check-label" for="flexRadioDefault1"><span
                                            class="filter-link stext-106 trans-04">Giá: cao đến thấp</span></label>
                                    <input class="form-check-input" type="radio" name="sortBy" value="lowest"
                                        {{ $sortBy == 'lowest' ? 'checked' : false }} />
                                    <label class="form-check-label" for="flexRadioDefault1"><span
                                            class="filter-link stext-106 trans-04">Giá: thấp đến cao</span></label>
                                </div>
                            </div>

                            <div class="col-md-3 p-r-15 p-b-27">
                                <div class="fw-bold cl2 p-b-15">
                                    Lọc theo giá
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="price" value="0-250000"
                                        {{ $price == '0-250000' ? 'checked' : false }} />
                                    <label class="form-check-label" for="flexRadioDefault1"><span
                                            class="filter-link stext-106 trans-04">Dưới 250.000đ</span></label>
                                    <input class="form-check-input" type="radio" name="price" value="250000-499000"
                                        {{ $price == '250000-499000' ? 'checked' : false }} />
                                    <label class="form-check-label" for="flexRadioDefault1"><span
                                            class="filter-link stext-106 trans-04">250.000đ - 499.000đ</span></label>
                                    <input class="form-check-input" type="radio" name="price" value="500000-999000"
                                        {{ $price == '500000-999000' ? 'checked' : false }} />
                                    <label class="form-check-label" for="flexRadioDefault1"><span
                                            class="filter-link stext-106 trans-04">500.000đ - 999.000đ</span></label>
                                    <input class="form-check-input" type="radio" name="price" value="1000000-2490000"
                                        {{ $price == '1000000-2490000' ? 'checked' : false }} />
                                    <label class="form-check-label" for="flexRadioDefault1"><span
                                            class="filter-link stext-106 trans-04">1.000.000đ - 2.490.000đ</span></label>
                                    <input class="form-check-input" type="radio" name="price" value="2500000-4990000"
                                        {{ $price == '2500000-4990000' ? 'checked' : false }} />
                                    <label class="form-check-label" for="flexRadioDefault1"><span
                                            class="filter-link stext-106 trans-04">2.500.000đ - 4.990.000đ</span></label>
                                    <input class="form-check-input" type="radio" name="price" value="5000000"
                                        {{ $price == '5000000' ? 'checked' : false }} />
                                    <label class="form-check-label" for="flexRadioDefault1"><span
                                            class="filter-link stext-106 trans-04">Trên 5.000.000đ</span></label>
                                </div>
                            </div>

                            <div class="col-md-6 p-r-15 p-b-27">
                                <div class="fw-bold cl2 p-b-15">
                                    Tùy chỉnh giá
                                </div>
                                <p class="small text-muted"><i>Lưu ý: Lọc tùy chỉnh sẽ được ưu tiên hơn mặc định</i></p>
                                <div class="py-3 d-flex">
                                    <input type="number" name="priceMin" value="{{ $priceMin > 0 ? $priceMin : false }}"
                                        placeholder="Giá tối thiểu" class="form-control rounded-3 me-2">_
                                    <input type="number" name="priceMax" value="{{ $priceMax > 0 ? $priceMax : false }}"
                                        placeholder="Giá tối đa" class="form-control rounded-3 ms-2">
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div class="me-2">
                                        <a href="{{ route('search') }}"
                                            class="btn btn-outline-primary px-4 rounded-5">Mặc định</a>
                                    </div>
                                    <div class="ms-2">
                                        <button type="submit" class="btn btn-primary px-4 rounded-5">Xác nhận</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>


                <div class="row pt-3">
                    <input type="hidden" value="{{ $products->count() }}" id="numbProduct">
                    {{-- Each Product --}}
                    @foreach ($products as $product)
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic hov-img0  {{ $product->status != 'default' ? 'label-hot' : false }}"
                                    data-label="{{ strtoupper($product->status) }}">
                                    <img src="{{ asset('storage/' . $product->photo) }}" alt="IMG-PRODUCT">

                                    <form action="{{ route('cart.add', ['product_id' => $product->id]) }}"
                                        method="post">
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
                @if ($products->count() >= 16 && $products->count() == $totalProduct)
                    <div class="w-100 d-flex justify-content-center">
                        <button id="loadmore" class="btn btn-outline-primary px-4 py-2 rounded-5">Load more</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
