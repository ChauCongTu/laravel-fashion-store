@extends('layouts.master')
@section('title')
    Đơn hàng của tôi
@endsection
@section('content')
    <div class="m-t-75 container pt-3 p-b-50">
        <div class="row d-flex justify-content-center">
            <div class="col-md-10">
                <div class="nav d-flex mb-3 justify-content-center">
                    <a href="{{ route('user.orders') }}" class="pe-5 pb-3 cl1 hov-cl13">Tất cả</a>
                    <a href="{{ route('user.orders') }}?status=dang-xu-ly" class="pe-5 pb-3 cl1 hov-cl13">Đang xử lý</a>
                    <a href="{{ route('user.orders') }}?status=dang-giao-hang" class="pe-5 pb-3 cl1 hov-cl13">Đang giao
                        hàng</a>
                    <a href="{{ route('user.orders') }}?status=da-nhan-hang" class="pe-5 pb-3 cl1 hov-cl13">Đã nhận hàng</a>
                    <a href="{{ route('user.orders') }}?status=da-huy" class="pe-5 pb-3 cl1 hov-cl13">Đã hủy</a>
                </div>
                <div class="list">
                    @forelse  ($orders as $order)
                        <div class="item mt-3 bg-light px-5">
                            <div class="status d-flex justify-content-end text-uppercase fw-bold p-3 text-primary">
                                {{ $order->status }}</div>
                            <div class="border-bottom border-top py-2">
                                <div class="content d-flex">
                                    <div class="fw-bold">Mã đơn hàng: <a
                                            href="{{ route('user.orders.detail', ['code' => $order->code]) }}"
                                            class="cl2 hov-cl1">{{ $order->code }}</a> </div>
                                    <a href="{{ route('user.orders.detail', ['code' => $order->code]) }}"
                                        class="cl13 hov-cl1 ms-3 fw-bold">Xem chi tiết</a>
                                </div>
                                <div class="content d-flex mt-2">
                                    <div class="infor col-md-6">
                                        <div class="title h5"><i class="fa-solid fa-user me-2"></i>Thông tin người mua</div>
                                        <div class="content ms-4">
                                            <p>Họ tên: {{ $order->name }}</p>
                                            <p>Số điện thoại: {{ $order->phone }}</p>
                                        </div>
                                    </div>
                                    <div class="infor col-md-6">
                                        <div class="title h5"><i class="fa-solid fa-clipboard me-2"></i>Thông tin đơn hàng
                                        </div>
                                        <div class="content ms-4">
                                            <p>Giá trị đơn hàng: {{ $order->total }}</p>
                                            <p>Thời gian đặt hàng: {{ $order->created_at }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center h5 p-3">
                            <img src="https://deo.shopeemobile.com/shopee/shopee-pcmall-live-sg/5fafbb923393b712b96488590b8f781f.png"
                                width="150px" alt="">
                            <p class="mt-3">Chưa có đơn hàng</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
