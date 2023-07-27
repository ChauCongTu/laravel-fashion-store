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
                <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
                    <div class="bor10 p-lr-40 p-t-30 p-b-30 m-r-50 m-lr-0-xl p-lr-15-sm">
                        <h4 class="cl2 p-b-30">
                            Chi tiết đặt hàng
                        </h4>

                        @foreach ($cart['products'] as $item)
                            <div class="product d-flex border-bottom p-3">
                                <div class="img">
                                    <img src="{{ asset('storage/' . $item['photo']) }}" width="55px" alt="">
                                </div>
                                <div class="content ms-3">
                                    <span class="fw-bold h5">{{ $item['name'] }}</span>
                                    <p class="">Số lượng: {{ $item['quantity'] }}</p>
                                    <p class="text-danger fw-bold">{{ number_format($item['total_price']) }}đ</p>
                                </div>
                            </div>
                        @endforeach
                        <div class="flex-w flex-t mt-2">
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

                        <div class="flex-w flex-t">
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

                        <div class="flex-w flex-t">
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
                        <div class="mt-3">
                            <a href="{{ route('cart') }}"><i class="fa-solid fa-arrow-left me-2"></i> Quay lại giỏ hàng</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                    <div class="bg0 border p-4">
                        <h4 class="cl2 p-b-30">
                            Thông tin người mua
                        </h4>
                        <form action="{{ route('cart.checkout') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="code" class="fw-bold cl2 mb-1">Mã đơn hàng: </label>
                                <input type="text" name="code" class="form-control" value="{{ $cart['code'] }}"
                                    disabled>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="fw-bold cl2 mb-1">Họ tên người mua hàng: </label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name') == null ? Auth::user()->name : old('name') }}">
                                @error('name')
                                    <div class="text-danger">
                                        * {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="fw-bold cl2 mb-1">Số điện thoại: </label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone') == null ? Auth::user()->phone : old('phone') }}">
                                @error('phone')
                                    <div class="text-danger">
                                        * {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="fw-bold cl2 mb-1">Địa chỉ email: </label>
                                <input type="text" name="email" class="form-control"
                                    value="{{ old('email') == null ? Auth::user()->email : old('email') }}">
                                @error('phone')
                                    <div class="text-danger">
                                        * {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address1" class="fw-bold cl2 mb-1">Địa chỉ: </label>
                                <div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <select class="form-select mb-3" name="city" id="city"
                                                aria-label=".form-select">
                                                <option value="" selected>Chọn tỉnh thành</option>
                                            </select>
                                            @error('city')
                                                <div class="text-danger">
                                                    * {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-select mb-3" name="district" id="district"
                                                aria-label=".form-select">
                                                <option value="" selected>Chọn quận huyện</option>
                                            </select>
                                            @error('district')
                                                <div class="text-danger">
                                                    * {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <select class="form-select mb-3" name="ward" id="ward"
                                                aria-label=".form-select">
                                                <option value="" selected>Chọn phường xã</option>
                                            </select>
                                            @error('ward')
                                                <div class="text-danger">
                                                    * {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="address2" class="form-control"
                                    placeholder="Số nhà, đường | VD: 18 Trần Bình Trọng" value="{{ old('address1') }}">
                                @error('address2')
                                    <div class="text-danger">
                                        * {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="payment" class="fw-bold cl2 h5 text-center mb-3">Hình thức thành toán:
                                </label>
                                <div class="d-flex justify-content-center">
                                    <input type="radio" class="btn-check" name="payment_method" id="cod"
                                        autocomplete="off" value="cod" checked>
                                    <label class="btn btn-outline-success rounded-0 py-3 px-4" for="cod">Tiền
                                        mặt</label>

                                    <input type="radio" class="btn-check" name="payment_method" id="atm"
                                        value="atm" autocomplete="off">
                                    <label class="btn btn-outline-success rounded-0 py-3 px-4" for="atm">Thanh toán VNPAY</label>

                                    <input type="radio" class="btn-check" name="payment_method" id="momo"
                                        value="momo" autocomplete="off">
                                    <label class="btn btn-outline-success rounded-0 py-3 px-4" for="momo">Momo</label>
                                </div>
                            </div>
                            <div class="mt-3 py-5 d-flex justify-content-center">
                                <button type="submit"
                                    class="cl0 p-3 px-5 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">Xác
                                    nhận đặt hàng</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    @else
        <p class="text-center py-5 h5">Giỏ hàng chưa được khởi tạo, hãy bắt đầu mua sắm để khởi tạo giỏ hàng</p>
    @endif
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        var citis = document.getElementById("city");
        var districts = document.getElementById("district");
        var wards = document.getElementById("ward");
        var Parameter = {
            url: "https://raw.githubusercontent.com/kenzouno1/DiaGioiHanhChinhVN/master/data.json",
            method: "GET",
            responseType: "application/json",
        };
        var promise = axios(Parameter);
        promise.then(function(result) {
            renderCity(result.data);
        });

        function renderCity(data) {
            for (const x of data) {
                citis.options[citis.options.length] = new Option(x.Name, x.Name);
            }
            citis.onchange = function() {
                district.length = 1;
                ward.length = 1;
                if (this.value != "") {
                    const result = data.filter(n => n.Name === this.value);

                    for (const k of result[0].Districts) {
                        district.options[district.options.length] = new Option(k.Name, k.Name);
                    }
                }
            };
            district.onchange = function() {
                ward.length = 1;
                const dataCity = data.filter((n) => n.Name === citis.value);
                if (this.value != "") {
                    const dataWards = dataCity[0].Districts.filter(n => n.Name === this.value)[0].Wards;

                    for (const w of dataWards) {
                        wards.options[wards.options.length] = new Option(w.Name, w.Name);
                    }
                }
            };
        }
    </script>
@endsection
