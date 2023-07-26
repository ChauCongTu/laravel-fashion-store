<!doctype html>
<html lang="en">

<head>
    <title>Hóa đơn bán hàng</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .logo {
            font-weight: 700;
            font-size: 50px;
        }

        .first {
            color: #dc3545;
        }

        .last {
            color: blue;
        }
    </style>
</head>

<body>
    <div class="d-flex justify-content-between align-items-center border-bottom border-4 border-primary">
        <div class="logo col-md-4 text-center">
            <span class="first">
                NZ
            </span>
            <span class="last">
                Fashion
            </span>
        </div>
        <div class="text-center text-primary">
            ___________________________________________________________________________________________________________________
        </div>
        <div class="content col-md-4 mt-5 text-end">
            <div class="fw-bold">CHAUCONGTU LLC</div>
            <div>26-27 Đường Phạm Ngũ Lão, P. Bình Thọ, TP Thủ Đức, TP. Hồ Chí Minh</div>
            <div>Hotline: 19001990</div>
            <div>email: support@nzfashion.com</div>
        </div>
    </div>
    <div class="text-center">
        ________________________________________________________________________
    </div>
    <div class="mt-3">
        <div class="h3 fw-bold">KHÁCH HÀNG</div>
        <div class="d-flex justify-content-between">
            <div class="col-md-5">
                <div class="fw-bold">{{ $order->name }}</div>
                <div>{{ $order->phone }}</div>
                <div>{{ $order->email }}</div>
                <div>{{ $order->address2 }}, {{ $order->address1 }}</div>
            </div>
            <div class="col-md-5">
                <div class="">Đặt hàng: {{ date('H:i d/m/Y', strtotime($order->created_at)) }}</div>
                <div class="">Nhận hàng: {{ date('H:i d/m/Y') }}</div>
            </div>
        </div>
    </div>
    <div class="text-center">
        ________________________________________________________________________
    </div>
    <div class="mt-3">
        <table class="table">
            <tr>
                <th>#</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>
            @foreach ($order->detail as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->product->name }}</td>
                <td>{{ number_format($detail->price, 0, ',', '.') }}đ</td>
                <td>x{{ $detail->quantity }}</td>
                <td>{{ number_format($detail->total_price, 0, ',', '.') }}đ</td>
            </tr>
            @endforeach
            <tfoot>
                <tr>
                    <td class="fw-bold">Tổng</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{ number_format($order->total, 0, ',', '.') }}đ</td>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="d-flex mt-5 justify-content-between align-content-center">
        <div class="sign mb-5 pb-5">
            <div class="pe-5 pb-5">
                <div class="text-end fw-bold">
                    Nhân viên bán hàng
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        ________________________________________________________________________
    </div>
    <div class="small mt-3">
        <p>&#8226; Kiểm tra mã đơn hàng trùng khớp với đơn hàng trên web của bạn trước khi nhận hàng </p>
        <p>&#8226; Thanh toán cho đơn vị vận chuyển để hoàn thành đơn hàng</p>
        <p>&#8226; Bạn có thể kiểm tra và đổi trả trong vòng 30 ngày kể từ ngày nhận hàng</p>
    </div>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>
