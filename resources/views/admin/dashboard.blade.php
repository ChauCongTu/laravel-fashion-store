@extends('layouts.admin')
@section('title')
    Dashboard
@endsection
@section('content')
    <!-- STATISTIC-->
    <section class="statistic">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">{{ number_format($stats['guests'], 0, ',', ',') }}</h2>
                            <span class="desc">khách hàng</span>
                            <div class="icon">
                                <i class="zmdi zmdi-account-o"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">{{ number_format($stats['productSold'], 0, ',', ',') }}</h2>
                            <span class="desc">sản phẩm bán ra</span>
                            <div class="icon">
                                <i class="zmdi zmdi-shopping-cart"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">{{ number_format($stats['orders'], 0, ',', ',') }}</h2>
                            <span class="desc">đơn hàng</span>
                            <div class="icon">
                                <i class="zmdi zmdi-calendar-note"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="statistic__item">
                            <h2 class="number">{{ number_format($stats['totalEarning'], 0, ',', ',') }}đ</h2>
                            <span class="desc">tổng thu nhập</span>
                            <div class="icon">
                                <i class="zmdi zmdi-money"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END STATISTIC-->

    <section>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <!-- RECENT REPORT 2-->
                        <div class="recent-report2">
                            <h2 class="title-3">Thống kê doanh thu</h2>
                            <div class="py-3">
                                <div class="d-block">
                                    <div class="d-flex justify-content-end">
                                        <div class="">
                                            <form action="{{ route('admin') }}" method="get">
                                                <input type="hidden" name="startDate"
                                                    value="{{ date('Y-m-d', strtotime('-90 days')) }}">
                                                <input type="hidden" name="endDate" value="{{ date('Y-m-d') }}">
                                                <button class="btn btn-outline-primary rounded-0 btn-sm" type="submit">90 Ngày
                                                    trước</button>
                                            </form>
                                        </div>
                                        <div class="">
                                            <form action="{{ route('admin') }}" method="get">
                                                <input type="hidden" name="startDate"
                                                    value="{{ date('Y-m-d', strtotime('-30 days')) }}">
                                                <input type="hidden" name="endDate" value="{{ date('Y-m-d') }}">
                                                <button class="btn btn-outline-primary rounded-0 btn-sm" type="submit">1 tháng
                                                    trước</button>
                                            </form>
                                        </div>
                                        <div class="">
                                            <form action="{{ route('admin') }}" method="get">
                                                <input type="hidden" name="startDate"
                                                    value="{{ date('Y-m-d', strtotime('-7 days')) }}">
                                                <input type="hidden" name="endDate" value="{{ date('Y-m-d') }}">
                                                <button class="btn btn-outline-primary rounded-0 btn-sm" type="submit">1 tuần
                                                    trước</button>
                                            </form>
                                        </div>
                                        <div class="">
                                            <button class="btn btn-outline-primary rounded-0 btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#customFilt">Tùy chỉnh</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="collapse" id="customFilt">
                                    <form action="{{ route('admin') }}" method="get" class="border p-3 bg-light">
                                        <div class="d-flex">
                                            <input type="date" name="startDate" class="form-control me-2">
                                            <input type="date" name="endDate" class="form-control me-2 format_date"
                                                value="">
                                            <button type="submit"
                                                class="btn btn-primary px-4 rounded-0">Lọc</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <script>
                                var time = @json($timeRevenue);
                                var revenue = @json($valueRevenue);
                            </script>
                            <div class="recent-report__chart">
                                <canvas id="earningChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- MAP DATA-->
                        <div class="map-data m-b-40">
                            <h3 class="title-3 m-b-30">
                                <i class="zmdi zmdi-map"></i>top sản phẩm bán chạy nhất
                            </h3>
                            <script>
                                var product = @json($hotProduct['product']);
                                var quantity = @json($hotProduct['quantity']);
                            </script>
                            <div class="map-wrap m-t-45 mb-3">
                                <canvas id="topProduct"></canvas>
                            </div>
                        </div>
                        <!-- END MAP DATA-->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 pb-3">
                        <div class="user-data m-b-60">
                            <h3 class="title-3 m-b-30">
                                <i class="zmdi zmdi-account-calendar"></i>Top mua hàng
                            </h3>
                            @php
                                $i = 1;
                            @endphp
                            <div class="table-responsive px-3">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td></td>
                                            <td>Khách hàng</td>
                                            <td>Số đơn hàng</td>
                                            <td>Tổng</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($topCustomers as $cus)
                                            <tr>
                                                <td>
                                                    {{ $i++ }}
                                                </td>
                                                <td>
                                                    <div class="table-data__info">
                                                        <h6>{{ $cus->name }}</h6>
                                                        <span>
                                                            <a href="mailto:{{ $cus->email }}">{{ $cus->email }}</a>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span>{{ $cus->numbOrder }}</span>
                                                </td>
                                                <td>
                                                    <div class="rs-select2--trans rs-select2--sm">
                                                        {{ number_format($cus->price, 0, ',', '.') }}đ
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <!-- MAP DATA-->
                        <div class="map-data">
                            <h3 class="title-3">
                                <i class="zmdi zmdi-map"></i>tình trạng đơn hàng
                            </h3>
                            <script>
                                var order_count = @json($orderStatus);
                            </script>
                            <div class="map-wrap m-t-45 m-b-80">
                                <canvas id="orderStatus"></canvas>
                            </div>
                        </div>
                        <!-- END MAP DATA-->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
