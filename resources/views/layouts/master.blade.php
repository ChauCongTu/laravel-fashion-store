<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title') - {{ $home->logo }}</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="ChauCongTu is a fashion store that sells high-quality clothes for men and women.">
    <meta name="keywords" content="fashion, clothes, men, women, high-quality">
    <meta name="author" content="ChauCongTu">
    <meta name="robots" content="index, follow">
    <link rel="icon" type="image/png" href="images/icons/favicon.png" />
    <!--========================== Style =====================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('fonts/linearicons-v1.0.0/icon-font.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animate/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/animsition/css/animsition.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/slick/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/MagnificPopup/magnific-popup.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="animsition">
    <header>
        <div class="container-menu-desktop">
            <div class="top-bar">
                <div class="content-topbar flex-sb-m h-full container">
                    <div class="left-top-bar">
                        {{ $home->address }}
                    </div>

                    <div class="right-top-bar flex-w h-full">
                        <a href="mailto:{{ $home->email }}" class="flex-c-m trans-04 p-lr-25">
                            {{ $home->email }}
                        </a>

                        <a href="tel:{{ $home->phone }}" class="flex-c-m trans-04 p-lr-25">
                            {{ $home->phone }}
                        </a>
                    </div>
                </div>
            </div>

            <div class="wrap-menu-desktop">
                <nav class="limiter-menu-desktop container">

                    <!-- Logo desktop -->
                    <a href="{{ route('home') }}" class="logo">
                        {{ $home->logo }}
                    </a>

                    <!-- Menu desktop -->
                    <div class="menu-desktop">
                        <ul class="main-menu">
                            <li class="active-menu">
                                <a href="index.html">Trang chủ</a>
                            </li>
                            @if ($categories->count() > 0)
                                <li>
                                    <a href="{{ route('category.show', ['slug' => 'danh-muc', 'id' => 1]) }}">Danh mục
                                        <span class="ms-1">
                                            <i class="fa fa-angle-down"></i>
                                        </span>
                                    </a>
                                    <ul class="sub-menu">
                                        @foreach ($categories as $category)
                                            @if ($category->child->count() > 0)
                                                <li>
                                                    <a
                                                        href="{{ route('category.show', ['slug' => $category->slug, 'id' => $category->id]) }}">{{ $category->name }}
                                                        <span class="float-end">
                                                            <i class="fa fa-angle-right"></i>
                                                        </span>
                                                    </a>
                                                    <ul class="sub-menu">
                                                        @foreach ($category->child as $child)
                                                            <li><a
                                                                    href="{{ route('category.show', ['slug' => $child->slug, 'id' => $child->id]) }}">{{ $child->name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li><a
                                                        href="{{ route('category.show', ['slug' => $category->slug, 'id' => $category->id]) }}">{{ $category->name }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('category.show', ['slug' => 'danh-muc', 'id' => 1]) }}">Danh
                                        mục</a>
                                </li>
                            @endif


                            <li class="label1" data-label1="hot">
                                <a href="shoping-cart.html">Nổi bật</a>
                            </li>

                            <li>
                                <a href="" class="flash-sale">Flash Sale</a>
                            </li>

                            <li>
                                <a href="">Blog</a>
                            </li>

                            <li>
                                <a href="">Liên hệ</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Icon header -->
                    <div class="wrap-icon-header flex-w flex-r-m">
                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                            <i class="zmdi zmdi-search"></i>
                        </div>

                        <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart"
                            data-notify="{{ Session::has('cart') ? count(Session::get('cart')['products']) : 0 }}">
                            <i class="zmdi zmdi-shopping-cart"></i>
                        </div>

                        @if (Auth::check())
                            <div class="dropdown">
                                <a href="" class="flex-c-m cl2 hov-cl1 trans-04 p-lr-25"
                                    data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }} <span class="ms-1">
                                        <i class="fa fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item py-2" href="#"><i
                                                class="fa-solid fa-user me-3"></i>Thông tin cá nhân</a></li>
                                    <li><a class="dropdown-item py-2" href="#"><i
                                                class="fa-solid fa-clipboard me-3"></i>Quản lý đơn hàng</a></li>
                                    <li><a class="dropdown-item py-2" href="{{ route('wishlist') }}"><i
                                                class="fa fa-heart me-3"></i>Wishlist</a></li>
                                    @if (Auth::user()->role == 'admin')
                                        <li><a class="dropdown-item py-2" href="#"><i
                                                    class="fa fa-gears me-3"></i>Bảng điều khiển</a></li>
                                    @endif
                                    <div class="border my-2"></div>
                                    <li><a class="dropdown-item py-2" href="{{ route('logout') }}"><i
                                                class="fa-solid fa-right-from-bracket me-3"></i>Đăng xuất</a></li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="flex-c-m cl2 hov-cl1 trans-04 p-lr-25">
                                Tài khoản
                            </a>
                        @endif
                    </div>
                </nav>
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap-header-mobile">
            <!-- Logo moblie -->
            <div class="logo-mobile">
                <a href="index.html"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
            </div>

            <!-- Icon header -->
            <div class="wrap-icon-header flex-w flex-r-m m-r-15">
                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                    <i class="zmdi zmdi-search"></i>
                </div>

                <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                    data-notify="2">
                    <i class="zmdi zmdi-shopping-cart"></i>
                </div>

                <a href="#"
                    class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti"
                    data-notify="0">
                    <i class="zmdi zmdi-favorite-outline"></i>
                </a>
            </div>

            <!-- Button show menu -->
            <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </div>
        </div>


        <!-- Menu Mobile -->
        <div class="menu-mobile">
            <ul class="topbar-mobile">
                <li>
                    <div class="left-top-bar">
                        Free shipping for standard order over $100
                    </div>
                </li>

                <li>
                    <div class="right-top-bar flex-w h-full">
                        <a href="#" class="flex-c-m p-lr-10 trans-04">
                            {{ $home->email }}
                        </a>

                        @if (Auth::check())
                            <div class="dropdown">
                                <a href="" class="flex-c-m cl2 hov-cl1 trans-04 p-lr-25"
                                    data-bs-toggle="dropdown">
                                    {{ Auth::user()->name }} <span class="ms-1">
                                        <i class="fa fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item py-2" href="#">Thông tin cá nhân</a></li>
                                    <li><a class="dropdown-item py-2" href="#">Quản lý đơn hàng</a></li>
                                    <li><a class="dropdown-item py-2" href="#">Wishlist</a></li>
                                    <div class="border my-2"></div>
                                    <li><a class="dropdown-item py-2" href="#">Đăng xuất</a></li>
                                </ul>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">
                                Tài khoản
                            </a>
                        @endif
                    </div>
                </li>
            </ul>

            <ul class="main-menu-m">
                <li class="active-menu">
                    <a href="index.html">Trang chủ</a>
                </li>

                <li>
                    <a href="{{ route('category.show', ['slug' => 'danh-muc', 'id' => 1]) }}">Danh mục<span
                            class="ms-1">
                            <i class="fa fa-angle-down"></i>
                        </span></a>
                </li>

                <li class="label1" data-label1="hot">
                    <a href="shoping-cart.html">Nổi bật</a>
                </li>

                <li>
                    <a href="" class="flash-sale">Flash Sale</a>
                </li>

                <li>
                    <a href="">Blog</a>
                </li>

                <li>
                    <a href="">Liên hệ</a>
                </li>
            </ul>
        </div>

        <!-- Modal Search -->
        <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
            <div class="container-search-header">
                <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                    <img src="images/icons/icon-close2.png" alt="CLOSE">
                </button>

                <form class="wrap-search-header flex-w p-l-15">
                    <button class="flex-c-m trans-04">
                        <i class="zmdi zmdi-search"></i>
                    </button>
                    <input class="plh3" type="text" name="search" placeholder="Search...">
                </form>
            </div>
        </div>
    </header>

    <!-- Cart -->
    <div class="wrap-header-cart js-panel-cart">
        <div class="s-full js-hide-cart"></div>

        <div class="header-cart flex-col-l p-l-65 p-r-25">
            <div class="header-cart-title flex-w flex-sb-m p-b-8">
                <span class="h4 fw-bold">
                    Giỏ hàng
                </span>

                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                    <i class="zmdi zmdi-close"></i>
                </div>
            </div>

            <div class="header-cart-content flex-w js-pscroll">
                <ul class="header-cart-wrapitem w-full">
                    {{-- Each product --}}
                    @if (Session::has('cart'))
                        @foreach (Session::get('cart')['products'] as $product)
                            <li class="header-cart-item flex-w flex-t m-b-12">
                                <div class="header-cart-item-img">
                                    <img src="{{ asset('storage/' . $product['photo']) }}" alt="ảnh sản phẩm">
                                </div>

                                <div class="header-cart-item-txt p-t-8">
                                    <a href="{{ route('product.show', ['slug' => $product['slug'], 'id' => $product['id']]) }}"
                                        class="mb-3 link-product hov-cl1 trans-04">
                                        {{ $product['name'] }}
                                    </a>

                                    <span class="header-cart-item-info">
                                        {{ $product['quantity'] }} x
                                        {{ number_format($product['price'], 0, ',', '.') }}đ
                                    </span>
                                </div>
                            </li>
                        @endforeach
                    @else
                        Bạn chưa có sản phẩm nào trong giỏ hàng
                    @endif
                </ul>

                <div class="w-full">
                    <div class="header-cart-total w-full p-tb-40">
                        Tạm tính:
                        {{ Session::has('cart') ? number_format(Session::get('cart')['total'], 0, ',', '.') : number_format(0, 0, ',', '.') }}đ
                    </div>

                    <div class="header-cart-buttons flex-w w-full">
                        <a href="{{ route('cart') }}"
                            class="flex-c-m  cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                            Giỏ hàng
                        </a>

                        <a href="{{ route('cart') }}"
                            class="flex-c-m cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                            Thanh toán
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (\Session::has('msg'))
        <div class="message-custom trans-04 shadow">
            <div class="card card-success" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="card-body py-4">
                    <div class="text-center">
                        <img src="{{ asset('images/check.gif') }}" class="w-25" width="100px">
                    </div>
                    <div class="text-center py-3">
                        {!! \Session::get('msg') !!}
                    </div>
                </div>
                <div class="p-3">
                    <button type="button" class="btn btn-success float-end" id="closeMsg">Xác nhận</button>
                </div>
            </div>
        </div>
    @endif
    @if (\Session::has('error'))
        <div class="message-custom trans-04 shadow">
            <div class="card card-success px-5" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset('images/error.gif') }}" class="w-50" width="100px">
                    </div>
                    <div class="text-center py-3">
                        {!! \Session::get('error') !!}
                    </div>
                </div>
                <div class="p-3 d-flex justify-content-center">
                    <button type="button" class="btn btn-danger" id="closeMsg">Xác nhận</button>
                </div>
            </div>
        </div>
    @endif

    {{-- =================================================
    ||
    ||
    ||                MAIN CONTENT SECTION
    ||
    ||====================================================   --}}
    @yield('content')

    {{-- =================================================
    ||
    ||
    ||              END MAIN CONTENT SECTION
    ||
    ||====================================================   --}}
    <footer class="bg3 p-t-75 p-b-32">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        Categories
                    </h4>

                    <ul>
                        @foreach ($categories as $category)
                            <li class="p-b-10">
                                <a href="#" class="cl7 hov-cl1 trans-04">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        Help
                    </h4>

                    <ul>
                        <li class="p-b-10">
                            <a href="#" class="cl7 hov-cl1 trans-04">
                                Hướng dẫn đặt hàng
                            </a>
                        </li>

                        <li class="p-b-10">
                            <a href="#" class="cl7 hov-cl1 trans-04">
                                Quy định đổi trả
                            </a>
                        </li>

                        <li class="p-b-10">
                            <a href="#" class="cl7 hov-cl1 trans-04">
                                Thông tin giao hàng
                            </a>
                        </li>

                        <li class="p-b-10">
                            <a href="#" class="cl7 hov-cl1 trans-04">
                                FAQs
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        GET IN TOUCH
                    </h4>

                    <p class="cl7 size-201">
                        Nếu có bất kỳ thắc mắc hoặc yêu cầu, liên hệ ngay với chúng tôi thông qua số điện thoại
                        {{ $home->phone }}
                        hoặc qua địa chỉ email {{ $home->email }}
                    </p>

                    <div class="p-t-27">
                        <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                            <i class="fa fa-facebook"></i>
                        </a>

                        <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                            <i class="fa fa-instagram"></i>
                        </a>

                        <a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                            <i class="fa fa-pinterest-p"></i>
                        </a>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 p-b-50">
                    <h4 class="stext-301 cl0 p-b-30">
                        Newsletter
                    </h4>

                    <form>
                        <div class="wrap-input1 w-full p-b-4">
                            <input class="input1 bg-none plh1 stext-107 cl7 form-control" type="text"
                                name="email" placeholder="email@example.com">
                            <div class="focus-input1 trans-04"></div>
                        </div>

                        <div class="p-t-18">
                            <button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
                                Subscribe
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="p-t-40">
                <div class="flex-c-m flex-w p-b-18">
                    <a href="#" class="m-all-1">
                        <img src="images/icons/icon-pay-01.png" alt="ICON-PAY">
                    </a>

                    <a href="#" class="m-all-1">
                        <img src="images/icons/icon-pay-02.png" alt="ICON-PAY">
                    </a>

                    <a href="#" class="m-all-1">
                        <img src="images/icons/icon-pay-03.png" alt="ICON-PAY">
                    </a>

                    <a href="#" class="m-all-1">
                        <img src="images/icons/icon-pay-04.png" alt="ICON-PAY">
                    </a>

                    <a href="#" class="m-all-1">
                        <img src="images/icons/icon-pay-05.png" alt="ICON-PAY">
                    </a>
                </div>

                <p class="stext-107 cl6 txt-center">
                    Copyright &copy; {{ date('Y') }} <a href="#" target="_blank">{{ $home->logo }}</a> |
                    Design & Developer by <a href="https://facebook.com/xoxvp">ChauCongTu</a>
                </p>
            </div>
        </div>
    </footer>


    <!-- Back to top -->
    <div class="btn-back-to-top" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="zmdi zmdi-chevron-up"></i>
        </span>
    </div>

    <!-- Modal1 -->
    <div class="wrap-modal1 js-modal1 p-t-60 p-b-20">
        <div class="overlay-modal1 js-hide-modal1"></div>

        <div class="container">
            <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                <button class="how-pos3 hov3 trans-04 js-hide-modal1">
                    <img src="images/icons/icon-close.png" alt="CLOSE">
                </button>

                <div class="row">
                    <div class="col-md-6 col-lg-7 p-b-30">
                        <div class="p-l-25 p-r-30 p-lr-0-lg">
                            <div class="wrap-slick3 flex-sb flex-w">
                                <div class="wrap-slick3-dots"></div>
                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                                <div class="slick3 gallery-lb">

                                    <div class="item-slick3" data-thumb="images/product-detail-01.jpg">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="images/product-detail-01.jpg" alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="images/product-detail-01.jpg">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="item-slick3" data-thumb="images/product-detail-02.jpg">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="images/product-detail-02.jpg" alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="images/product-detail-02.jpg">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="item-slick3" data-thumb="images/product-detail-03.jpg">
                                        <div class="wrap-pic-w pos-relative">
                                            <img src="images/product-detail-03.jpg" alt="IMG-PRODUCT">

                                            <a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04"
                                                href="images/product-detail-03.jpg">
                                                <i class="fa fa-expand"></i>
                                            </a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 p-b-30">
                        <div class="p-r-50 p-t-5 p-lr-0-lg">
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14">
                                Lightweight Jacket
                            </h4>

                            <span class="mtext-106 cl2">
                                $58.79
                            </span>

                            <p class="stext-102 cl3 p-t-23">
                                Nulla eget sem vitae eros pharetra viverra. Nam vitae luctus ligula. Mauris consequat
                                ornare feugiat.
                            </p>

                            <!--  -->
                            <div class="p-t-33">
                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Size
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" name="time">
                                                <option>Choose an option</option>
                                                <option>Size S</option>
                                                <option>Size M</option>
                                                <option>Size L</option>
                                                <option>Size XL</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-203 flex-c-m respon6">
                                        Color
                                    </div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <select class="js-select2" name="time">
                                                <option>Choose an option</option>
                                                <option>Red</option>
                                                <option>Blue</option>
                                                <option>White</option>
                                                <option>Grey</option>
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

                                        <button
                                            class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail">
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
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

                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>

                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>

                                <a href="#"
                                    class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                    data-tooltip="Google Plus">
                                    <i class="fa fa-google-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--========================== SCRIPTS ====================================-->
    <script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script>
        $(".js-select2").each(function() {
            $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
            });
        })
    </script>
    <script src="{{ asset('vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('vendor/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('vendor/parallax100/parallax100.js') }}"></script>
    <script src="{{ asset('vendor/parallax100/parallax100.js') }}"></script>
    <script>
        $('.parallax100').parallax100();
    </script>
    <script src="{{ asset('vendor/MagnificPopup/jquery.magnific-popup.min.js') }}"></script>
    <script>
        $('.gallery-lb').each(function() { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade'
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#closeMsg').click(function() {
                $('.message-custom').hide();
            });
        });
    </script>
    <script src="{{ asset('vendor/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $('.js-addwish-b2').on('click', function(e) {
            e.preventDefault();
        });

        $('.js-addwish-b2').each(function() {
            var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-b2');
                $(this).off('click');
            });
        });

        $('.js-addwish-detail').each(function() {
            var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

            $(this).on('click', function() {
                swal(nameProduct, "is added to wishlist !", "success");

                $(this).addClass('js-addedwish-detail');
                $(this).off('click');
            });
        });

        /*---------------------------------------------*/

        $('.js-addcart-detail').each(function() {
            var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
            $(this).on('click', function() {
                swal(nameProduct, "is added to cart !", "success");
            });
        });
    </script>
    <script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script>
        $('.js-pscroll').each(function() {
            $(this).css('position', 'relative');
            $(this).css('overflow', 'hidden');
            var ps = new PerfectScrollbar(this, {
                wheelSpeed: 1,
                scrollingThreshold: 1000,
                wheelPropagation: false,
            });

            $(window).on('resize', function() {
                ps.update();
            })
        });
    </script>
    @yield('script')
    <script src="{{ asset('js/slick-custom.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>
