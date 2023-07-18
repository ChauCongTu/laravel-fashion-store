@extends('layouts.master')
@section('title')
    Mua ngay {{ $product->name }}
@endsection

@section('content')
    <!-- breadcrumb -->
    <div class="container mt-5 py-3">
        <div class="bread-crumb flex-w p-r-15 p-t-30">
            <a href="{{ route('home') }}" class="cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            @if ($product->category->is_parent == 0)
                <span class="cl4">
                    {{ $product->category->parent->name }}
                    <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
                </span>
            @endif
            <span class="cl4">
                {{ $product->category->name }}
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </span>
            <span class="cl4">
                {{ $product->name }}
            </span>
        </div>
    </div>
    <div class="bg6 flex-c-m flex-w size-302 p-tb-15">
        <span class="stext-107 fw-bold cl6 p-lr-25">
            CODE: <span id="code">{{ $product->code }}</span> <button id="clipboard"><i
                    class="fa fa-copy text-muted"></i></button>
        </span>
    </div>
    <!-- Product Detail -->
    <section class="sec-product-detail bg0 mt-3 p-b-60">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-7 p-b-30">
                    <div class="p-l-25 p-r-30 p-lr-0-lg">
                        <div class="wrap-slick3 flex-sb flex-w">
                            <div class="wrap-slick3-dots"></div>
                            <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                            <div class="slick3 gallery-lb">
                                {{-- Each photo --}}
                                <div class="item-slick3" data-thumb="{{ asset('storage/' . $product->photo) }}">
                                    <div class="wrap-pic-w pos-relative">
                                        <img src="{{ asset('storage/' . $product->photo) }}" alt="IMG-PRODUCT">

                                        <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                            href="{{ asset('storage/' . $product->photo) }}">
                                            <i class="fa fa-expand"></i>
                                        </a>
                                    </div>
                                </div>
                                @foreach ($product->photos as $photo)
                                    <div class="item-slick3" data-thumb="{{ asset('storage/' . $photo) }}">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="{{ asset('storage/' . $photo) }}" alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="{{ asset('storage/' . $photo) }}">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-5 p-b-30">
                    <div class="p-r-50 p-t-5 p-lr-0-lg">
                        <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                            {{ $product->name }}
                        </h4>
                        <div class="d-flex w-100 justify-content-between">
                            <span class="mtext-106 cl2">
                                <x-price :discount="$product->display_price" :price="$product->price" />
                            </span>
                            <span class="bg-danger px-3 text-white">-{{ ceil($product->percent_discount) }}%</span>
                        </div>
                        <p class="stext-102 cl3 p-t-23">
                            {{ $product->summary }}
                        </p>

                        <!--  -->
                        <div class="p-t-33">
                            <div class="flex-w flex-r-m p-b-10">
                                <div class="size-203 flex-c-m respon6">
                                    Kho:
                                </div>

                                <div class="size-204 respon6-next">
                                    <div class="rs1-select2 bg0">
                                        {{ $product->stock }}
                                    </div>
                                </div>
                            </div>
                            <form action="" method="post">
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Size
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" name="size">
                                                <option>Lựa chọn size</option>
                                                @foreach ($product->size as $size)
                                                    <option value="{{ $size }}">{{ $size }}</option>
                                                @endforeach
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Màu
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" name="color">
                                                <option>Lựa chọn màu</option>
                                                @foreach ($product->color as $color)
                                                    <option value="{{ $color }}">{{ $color }}</option>
                                                @endforeach
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                name="num-product" value="1">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>

                                        <button class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
                                            Đặt ngay
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!--  -->
                        <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                            <div class="flex-m bor9 p-r-10 m-r-11">
                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                    data-tooltip="Add to Wishlist">
                                    <i class="zmdi zmdi-favorite"></i>
                                </a>
                            </div>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Facebook">
                                <i class="fa fa-facebook"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Twitter">
                                <i class="fa fa-twitter"></i>
                            </a>

                            <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                data-tooltip="Google Plus">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="m-t-50 p-t-43 p-b-40">
                <!-- Tab01 -->
                {!! $product->description !!}
            </div>
            <div class="m-t-20 p-b-40">
                <div class="h3 fw-bold cl5">Đánh giá</div>
                <div class="rating-list py-3">
                    @foreach ($product->reviews as $review)
                        <div class="d-flex align-items-content border p-3 py-4">
                            <div class="img">
                                <img src="{{ asset('storage/' . $review->user->photo) }}" class="rounded-circle border"
                                    width="50px" height="50px" alt="ảnh đại diện">
                            </div>
                            <div class="ms-5">
                                <div class="fw-bold cl5">
                                    {{ $review->user->name }}
                                    <div class="text-warning small">
                                        @for ($i = 1; $i <= $review->rate; $i++)
                                            <i class="fa fa-star"></i>
                                        @endfor
                                    </div>
                                </div>
                                <div class="mt-1">
                                    {{ $review->review }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="m-t-20 p-b-40">
                <div class="h3 fw-bold cl5">Nhận xét</div>
                <div class="comment-list py-2">
                    @foreach ($product->comments as $comment)
                        @if ($comment->reply_id == null)
                            <div class="d-flex align-items-content p-3 py-4 mt-2">
                                <div class="img">
                                    <img src="{{ asset('storage/' . $comment->user->photo) }}"
                                        class="rounded-circle border" width="50px" height="50px" alt="ảnh đại diện">
                                </div>
                                <div class="content ms-4">
                                    <div class="fw-bold cl5">
                                        {{ $comment->user->name }}
                                        <div class="small">
                                            {{ date('d/m/Y', strtotime($comment->created_at)) }}
                                        </div>
                                    </div>
                                    <div class="mt-1">
                                        {{ $comment->content }}
                                    </div>
                                    <div class="mt-2"><a href="" data-bs-toggle="modal"
                                            data-bs-target="#reply_{{ $comment->id }}">Trả lời</a></div>
                                </div>
                            </div>
                            {{-- Comment level 2 --}}
                            @foreach ($comment->child as $child)
                                <div class="d-flex bg-light align-items-content p-3 py-4 ms-5">
                                    <div class="img">
                                        <img src="{{ asset('storage/' . $child->user->photo) }}"
                                            class="rounded-circle border" width="50px" height="50px"
                                            alt="ảnh đại diện">
                                    </div>
                                    <div class="ms-4">
                                        <div class="fw-bold cl5">
                                            {{ $child->user->name }} <span class="fw-normal"> Đã phản hồi
                                                {{ $comment->user->name }}</span>
                                            <div class="small">
                                                {{ date('d/m/Y', strtotime($child->created_at)) }}
                                            </div>
                                        </div>
                                        <div class="mt-1">
                                            {{ $child->content }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <!-- Modal -->
                            <div class="modal fade m-t-100" id="reply_{{ $comment->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('product.comment', ['reply_id' => $comment->id]) }}">
                                            <div class="modal-header">
                                                <h5>Phản hồi {{ $comment->user->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="border-start border-4 reply-content ps-2 mb-2">
                                                    {{ $comment->content }}</div>
                                                <textarea name="content" class="form-control" rows="4"></textarea>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-primary">Trả lời</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <hr />
    <!-- Related Products -->
    <section class="sec-relate-product bg0 p-t-45 p-b-105">
        <div class="container">
            <div class="p-b-45">
                <div class="h2 fw-bold cl5 txt-center">
                    Sản phẩm liên quan
                </div>
            </div>

            <!-- Slide2 -->
            <div class="wrap-slick2">
                <div class="slick2">
                    @foreach ($rel_prods as $product)
                        <div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
                            <!-- Block2 -->
                            <div class="block2">
                                <div class="block2-pic hov-img0">
                                    <img src="{{ asset('storage/' . $product->photo) }}" alt="IMG-PRODUCT">

                                    <a href="#"
                                        class="block2-btn flex-c-m cl2 w-75 py-2 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1">
                                        <i class="fa fa-cart-shopping"></i> Thêm vào giỏ hàng
                                    </a>
                                </div>

                                <div class="block2-txt flex-w flex-t p-t-14">
                                    <div class="block2-txt-child1 flex-col-l ">
                                        <a href="product-detail.html"
                                            class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                            {{ $product->name }}
                                        </a>

                                        <span class="stext-105 cl3">
                                            <x-price :discount="$product->display_price" :price="$product->price" />
                                        </span>
                                    </div>

                                    <div class="block2-txt-child2 flex-r p-t-3">
                                        <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                            <img class="icon-heart1 dis-block trans-04"
                                                src="images/icons/icon-heart-01.png" alt="ICON">
                                            <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                                src="images/icons/icon-heart-02.png" alt="ICON">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
