<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="admin panel">
    <meta name="author" content="Chau Cong Tu">
    <meta name="keywords" content="au theme template">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Title Page-->
    <title>@yield('title') | Bảng điều khiển</title>

    <!-- Fontfaces CSS-->
    <link href="{{ asset('css/font-face.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/font-awesome-5/css/fontawesome-all.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/mdi-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" media="all">

    <!-- Vendor CSS-->
    <link href="{{ asset('vendor/animsition/css/animsition.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet"
        media="all">
    <link href="{{ asset('vendor/wow/animate.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/css-hamburgers/hamburgers.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/slick/slick.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/select2/select2.min.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" media="all">
    <link href="{{ asset('vendor/vector-map/jqvmap.min.css') }}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet" media="all">
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- MENU SIDEBAR-->
        <aside class="menu-sidebar2">
            <div class="logo">
                <a href="{{ route('admin') }}" class="h3 fw-bold text-white">
                    Admin Panel
                </a>
            </div>
            <div class="menu-sidebar2__content js-scrollbar1">
                <div class="account2">
                    <div class="image img-cir img-120">
                        <img src="{{ asset('storage/' . Auth::user()->photo) }}" alt="{{ Auth::user()->name }}" />
                    </div>
                    <h4 class="name">{{ Auth::user()->name }}</h4>
                    <a href="{{ route('logout') }}">Đăng xuất</a>
                </div>
                <nav class="navbar-sidebar2">
                    <ul class="list-unstyled navbar__list">
                        <li class="active has-sub">
                            <a class="js-arrow" href="{{ route('admin') }}">
                                <i class="fas fa-tachometer-alt"></i>Dashboard
                            </a>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="fas fa-folder-open"></i>Danh mục
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{ route('quan-ly-danh-muc.create') }}">
                                        Thêm danh mục
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('quan-ly-danh-muc.index') }}">
                                        Quản lý danh mục
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="zmdi zmdi-card-travel"></i>Sản phẩm
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{ route('quan-ly-san-pham.create') }}">
                                        Thêm sản phẩm
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('quan-ly-san-pham.index') }}">
                                        Quản lý sản phẩm
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="active">
                            <a class="" href="{{ route('admin.order') }}">
                                <i class="zmdi zmdi-assignment-o"></i>Đơn hàng
                            </a>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="zmdi zmdi-label"></i>Coupon
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{ route('ma-giam-gia.create') }}">
                                        Thêm mã giảm giá
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('ma-giam-gia.index') }}">
                                        Quản lý mã giảm giá
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="active">
                            <a class="" href="{{ route('quan-ly-banner.index') }}">
                                <i class="zmdi zmdi-card"></i>Banner
                            </a>
                        </li>
                        <li class="active has-sub">
                            <a class="js-arrow" href="#">
                                <i class="zmdi zmdi-view-compact"></i>Thương hiệu
                                <span class="arrow">
                                    <i class="fas fa-angle-down"></i>
                                </span>
                            </a>
                            <ul class="list-unstyled navbar__sub-list js-sub-list">
                                <li>
                                    <a href="{{ route('quan-ly-thuong-hieu.create') }}">
                                        Thêm thương hiệu mới
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('quan-ly-thuong-hieu.index') }}">
                                        Quản lý thương hiệu
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="active">
                            <a class="" href="{{ route('quan-ly-bai-viet.index') }}">
                                <i class="zmdi zmdi-file"></i>Bài viết
                            </a>
                        </li>
                        <li class="active">
                            <a class="" href="{{ route('quan-ly-nguoi-dung.index') }}">
                                <i class="fas fa-user"></i>Người dùng
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <!-- HEADER DESKTOP-->
            <header class="header-desktop2">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap2">
                            <div class="logo d-block d-lg-none">
                                <a href="{{ route('admin') }}" class="h3 fw-bold text-white">
                                    CQN Admin
                                </a>
                            </div>
                            <div class="header-button2">
                                <div class="header-button-item js-item-menu">
                                    <i class="zmdi zmdi-search"></i>
                                    <div class="search-dropdown js-dropdown">
                                        <form action="">
                                            <input class="au-input au-input--full au-input--h65" type="text"
                                                placeholder="Search for datas &amp; reports..." />
                                            <span class="search-dropdown__icon">
                                                <i class="zmdi zmdi-search"></i>
                                            </span>
                                        </form>
                                    </div>
                                </div>
                                <div class="header-button-item has-noti js-item-menu">
                                    <i class="zmdi zmdi-notifications"></i>
                                    <div class="notifi-dropdown js-dropdown">
                                        <div class="notifi__title">
                                            <p>Bạn chưa nhận được thông báo nào</p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
                <div class="logo">
                    <a href="{{ route('admin') }}" class="h3 fw-bold text-white">
                        CQN Admin
                    </a>
                </div>
                <div class="menu-sidebar2__content js-scrollbar2">
                    <div class="account2">
                        <div class="image img-cir img-120">
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                                alt="{{ Auth::user()->name }}" />
                        </div>
                        <h4 class="name">{{ Auth::user()->name }}</h4>
                        <a href="{{ route('logout') }}">Đăng xuất</a>
                    </div>
                    <nav class="navbar-sidebar2">
                        <ul class="list-unstyled navbar__list">
                            <li class="active has-sub">
                                <a class="js-arrow" href="{{ route('admin') }}">
                                    <i class="fas fa-tachometer-alt"></i>Dashboard
                                </a>
                            </li>
                            <li class="active has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="fas fa-folder-open"></i>Danh mục
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="{{ route('quan-ly-danh-muc.create') }}">
                                            Thêm danh mục
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('quan-ly-danh-muc.index') }}">
                                            Quản lý danh mục
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="active has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="zmdi zmdi-card-travel"></i>Sản phẩm
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="{{ route('quan-ly-san-pham.create') }}">
                                            Thêm sản phẩm
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('quan-ly-san-pham.index') }}">
                                            Quản lý sản phẩm
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="active">
                                <a class="" href="{{ route('admin.order') }}">
                                    <i class="zmdi zmdi-assignment-o"></i>Đơn hàng
                                </a>
                            </li>
                            <li class="active has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="zmdi zmdi-label"></i>Coupon
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="{{ route('ma-giam-gia.create') }}">
                                            Thêm mã giảm giá
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('ma-giam-gia.index') }}">
                                            Quản lý mã giảm giá
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="active">
                                <a class="" href="{{ route('quan-ly-banner.index') }}">
                                    <i class="zmdi zmdi-card"></i>Banner
                                </a>
                            </li>
                            <li class="active has-sub">
                                <a class="js-arrow" href="#">
                                    <i class="zmdi zmdi-view-compact"></i>Thương hiệu
                                    <span class="arrow">
                                        <i class="fas fa-angle-down"></i>
                                    </span>
                                </a>
                                <ul class="list-unstyled navbar__sub-list js-sub-list">
                                    <li>
                                        <a href="{{ route('quan-ly-thuong-hieu.create') }}">
                                            Thêm thương hiệu mới
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('quan-ly-thuong-hieu.index') }}">
                                            Quản lý thương hiệu
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="active">
                                <a class="" href="{{ route('quan-ly-bai-viet.index') }}">
                                    <i class="zmdi zmdi-file"></i>Bài viết
                                </a>
                            </li>
                            <li class="active">
                                <a class="" href="{{ route('quan-ly-nguoi-dung.index') }}">
                                    <i class="fas fa-user"></i>Người dùng
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>
            <!-- END HEADER DESKTOP-->

            <!-- BREADCRUMB-->
            <section class="au-breadcrumb m-t-75">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="au-breadcrumb-content">
                                    <div class="au-breadcrumb-left">
                                        <ul class="list-unstyled list-inline au-breadcrumb__list">
                                            <li class="list-inline-item active">
                                                <a href="#">Home</a>
                                            </li>
                                            <li class="list-inline-item seprate">
                                                <span>/</span>
                                            </li>
                                            <li class="list-inline-item"> @yield('title') </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->
            @if (\Session::has('error'))
                <div class="mt-3 mx-5">
                    <div class="alert alert-danger">
                        <span class="content">{{ Session::get('error') }}</span>
                    </div>
                </div>
            @endif
            @if (\Session::has('success'))
                <div class="mt-3 mx-5">
                    <div class="alert alert-success">
                        <span class="content">{{ Session::get('success') }}</span>
                    </div>
                </div>
            @endif

            @yield('content')

            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © {{ date('Y') }} ChauCongTu. All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{ asset('vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!-- Bootstrap JS-->
    <script src="{{ asset('vendor/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- Vendor JS       -->
    <script src="{{ asset('vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('vendor/wow/wow.min.js') }}"></script>
    <script src="{{ asset('vendor/animsition/js/animsition.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap-progressbar/bootstrap-progressbar.min.js') }}"></script>
    <script src="{{ asset('vendor/counter-up/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('vendor/counter-up/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('vendor/circle-progress/circle-progress.min.js') }}"></script>
    <script src="{{ asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('vendor/chartjs/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/vector-map/jquery.vmap.js') }}"></script>
    <script src="{{ asset('vendor/vector-map/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('vendor/vector-map/jquery.vmap.sampledata.js') }}"></script>
    <script src="{{ asset('vendor/vector-map/jquery.vmap.world.js') }}"></script>

    <!-- Main JS-->
    <script src="{{ asset('js/main-admin.js') }}"></script>
    <script src="{{ asset('js/chart.js') }}"></script>

</body>

</html>
<!-- end document-->
