@extends('layouts.master')
@section('title')
    Giỏ hàng của tôi
@endsection
@section('content')
    <div class="container mt-5 py-3">
        <div class="bread-crumb flex-w p-r-15 p-t-30">
            <a href="{{ route('home') }}" class="cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="cl4">
                Quản lý giỏ hàng
            </span>
        </div>
    </div>
    @if (\Session::has('cart'))
        <!-- Shoping Cart -->
        <div class="container">
            <div class="row">
                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="bg0">
                        <div class="m-r--38 m-lr-0-xl">
                            <div class="wrap-table-shopping-cart">
                                <table class="table-shopping-cart">
                                    <tr class="table_head">
                                        <th class="column-1">Product</th>
                                        <th class="column-2"></th>
                                        <th class="column-3">Price</th>
                                        <th class="column-4">Quantity</th>
                                        <th class="column-5"></th>
                                        <th class="column-6">Total</th>
                                    </tr>
                                    @forelse($cart['products'] as $product)
                                        <form action="{{ route('cart.update') }}" method="post">
                                            <tr class="table_row">
                                                <td class="column-1">
                                                    <div class="how-itemcart1">
                                                        <img src="{{ asset('storage/' . $product['photo']) }}"
                                                            alt="IMG">
                                                    </div>
                                                </td>
                                                <td class="column-2">
                                                    <a href="{{ route('product.show', ['slug' => $product['slug'], 'id' => $product['id']]) }}"
                                                        class="cl2 hov-cl1 trans-04">{{ $product['name'] }}</a>
                                                </td>
                                                <td class="column-3">{{ number_format($product['price'], 0, ',', '.') }}đ
                                                </td>
                                                <td class="column-4">
                                                    <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                        <input type="hidden" name="id" value="{{ $product['id'] }}">
                                                        @csrf
                                                        <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                            <i class="fs-16 zmdi zmdi-minus"></i>
                                                        </div>
                                                        <input class="mtext-104 cl3 txt-center num-product" type="number"
                                                            name="quantity" value="{{ $product['quantity'] }}">

                                                        <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                            <i class="fs-16 zmdi zmdi-plus"></i>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="column-5">
                                                    <p>
                                                        <button type="submit"
                                                            class="btn btn-outline-secondary btn-sm">Update</button>
                                                    </p>
                                                </td>
                                                <td class="column-6">
                                                    {{ number_format($product['total_price'], 0, ',', '.') }}đ
                                                </td>
                                            </tr>
                                        </form>
                                    @empty
                                        <p>Không có sản phẩm nào</p>
                                    @endforelse
                                </table>
                            </div>
                        </div>
                    </div>
                    <form class="bg0" action="{{ route('cart.coupon') }}" method="post">
                        <div class="m-r--38 m-lr-0-xl border">
                            <div class="d-flex justify-content-end px-3 m-tb-5">
                                @csrf
                                <input class="cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5 w-100" type="text"
                                    name="coupon" placeholder="Mã giảm giá">

                                <button type="submit"
                                    class="flex-c-m fw-bold cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
                                    Áp dụng
                                </button>
                            </div>
                        </div>
                    </form>

                </div>

                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
                        <h4 class="cl2 p-b-30">
                            Chi tiết đặt hàng
                        </h4>

                        <div class="flex-w flex-t bor12 p-b-13 p-t-13">
                            <div class="size-208">
                                <span class="fw-bold cl2">
                                    Tạm tính:
                                </span>
                            </div>

                            <div class="size-209">
                                <span class="mtext-110 cl2">
                                    {{ number_format($cart['total'], 0, ',', '.') }}đ
                                </span>
                            </div>
                        </div>

                        <div class="flex-w flex-t bor12 p-b-13 p-t-13">
                            <div class="size-208">
                                <span class="fw-bold cl2">
                                    Coupon:
                                </span>
                            </div>

                            <div class="size-209">
                                <span class="mtext-110 cl2">
                                    {{ number_format($cart['coupon'], 0, ',', '.') }}đ
                                </span>
                            </div>
                        </div>

                        <div class="flex-w flex-t p-t-27 p-b-33">
                            <div class="size-208">
                                <span class="fw-bold cl2">
                                    Thành tiền:
                                </span>
                            </div>

                            <div class="size-209 p-t-1">
                                <span class="mtext-110 cl2">
                                    {{ number_format($cart['final_price'], 0, ',', '.') }}đ
                                </span>
                            </div>
                        </div>

                        <a href="{{ route('cart.checkout') }}"
                            class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                            Thanh toán
                        </a>
                        <div class="border-top p-2 mt-3">
                            <a href="{{ route('cart.destroy') }}" class="w-100 btn btn-outline-danger rounded-5">Hủy giỏ
                                hàng</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <p class="text-center py-5 h5">Giỏ hàng chưa được khởi tạo, hãy bắt đầu mua sắm để khởi tạo giỏ hàng</p>
    @endif

@endsection
