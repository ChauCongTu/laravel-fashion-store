@extends('layouts.master')
@section('title')
    Chi tiết đơn hàng {{ $order->code }}
@endsection
@section('content')
    <div class="container mt-5 py-3">
        <div class="bread-crumb flex-w p-r-15 p-t-30">
            <a href="{{ route('home') }}" class="cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="cl4">
                Đơn hàng của tôi
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </span>
            <span class="cl4">
                Chi tiết đơn hàng
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </span>
            <span class="cl4">
                {{ $order->code }}
            </span>
        </div>
    </div>
    <div class="container p-b-50">
        <div class="h3 py-4 cl2 text-primary">{{ $order->status }}</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-6 p-2">
                <div class="border p-3 rounded-3">
                    <h2 class="py-3 cl2">Danh sách sản phẩm</h2>
                    <div class="list">
                        @foreach ($order->detail as $detail)
                            <div class="item d-flex mb-3">
                                <div class="img">
                                    <img src="{{ asset('storage/' . $detail->product->photo) }}" width="100px"
                                        alt="">
                                </div>
                                <div class="content ms-3">
                                    <div class="fw-bold h5 cl2">
                                        <a href="{{ route('product.show', ['slug' => $detail->product->slug, 'id' => $detail->product_id]) }}"
                                            class="cl2 hov-cl1 trans-04">{{ $detail->product->name }}</a>
                                    </div>
                                    <div>{{ $detail->quantity }} x {{ number_format($detail->price, 0, ',', '.') }}đ</div>
                                    <div>
                                        <span class="me-3"> Màu: {{ $detail->color }}</span>|
                                        <span class="ms-3">Size: {{ $detail->size }}</span>
                                    </div>
                                </div>
                                <div class="price text-danger fw-bold ms-5">
                                    <div class="border border-danger px-3">
                                        {{ number_format($detail->total_price, 0, ',', '.') }}đ
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="h5 cl2 border-top py-3">
                            <div>
                                <div class="flex-w flex-t p-b-13 p-t-13">
                                    <div class="size-208">
                                        <span class="fw-bold cl2">
                                            Tổng tiền:
                                        </span>
                                    </div>

                                    <div class="size-209">
                                        <span class="mtext-110 cl2">
                                            {{ number_format($order->sub_total, 0, ',', '.') }}đ
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-w flex-t bor12 p-b-13 p-t-13">
                                    <div class="size-208">
                                        <span class="fw-bold cl2">
                                            Tiết kiệm:
                                        </span>
                                    </div>

                                    <div class="size-209">
                                        <span class="mtext-110 cl2">
                                            {{ number_format($order->coupon, 0, ',', '.') }}đ
                                        </span>
                                    </div>
                                </div>

                                <div class="flex-w flex-t p-b-13 p-t-13">
                                    <div class="size-208">
                                        <span class="fw-bold cl2">
                                            Thành tiền:
                                        </span>
                                    </div>

                                    <div class="size-209">
                                        <span class="mtext-110 cl2">
                                            {{ number_format($order->total, 0, ',', '.') }}đ
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-2">
                <div class="border p-3 rounded-3">
                    <h2 class="py-3 cl2">Thông tin đơn hàng</h2>
                    <div class="detail">
                        <div class="mb-3">
                            <label for="name" class="h6">Tên người đặt hàng:</label>
                            <input type="text" value="{{ $order->name }}" class="form-control bg-white" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="h6">Số điện thoại:</label>
                            <input type="text" value="{{ $order->phone }}" class="form-control bg-white" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="h6">Địa chỉ nhận hàng:</label>
                            <textarea class="form-control bg-white" rows="4" disabled>{{ $order->address2 }}, {{ $order->address1 }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="h6">Thời gian đặt hàng:</label>
                            <input type="text" value="{{ date('H:i d/m/Y', strtotime($order->created_at)) }}"
                                class="form-control bg-white" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="h6">Thời gian nhận hàng:</label>
                            <input type="text"
                                value="{{ $order->received_at == null ? 'Dự kiến nhận vào: ' . date('d/m/Y', strtotime($order->created_at . '+3 days')) . ' - ' . date('d/m/Y', strtotime($order->created_at . '+7 days')) : date('H:i d/m/Y', strtotime($order->received_at)) }}"
                                class="form-control bg-white" disabled>
                        </div>
                        <div class="mb-3">
                            <form action="" method="post" class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-outline-danger px-4 mt-2">Hủy đơn hàng</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
