@extends('layouts.admin')
@section('title')
    Quản lý đơn hàng
@endsection
@section('content')
    <section class="manage p-5">
        <div class="row">
            <div class="col-md-12">
                <h3 class="title-3 m-b-35">Quản lý đơn hàng</h3>
                <div class="row pb-4">
                    <div class="col-md-6">
                        <div class="d-flex">
                            <form action="{{ route('admin.order') }}" method="get" class="d-flex">
                                <input type="search" name="MaDonHang" value="{{ $MaDonHang }}" class="form-control"
                                    placeholder="Mã đơn hàng" />
                                <button class="btn btn-danger rounded-0"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="filter d-flex justify-content-end">
                            <form action="{{ route('admin.order') }}" method="get" class="d-flex align-items-center">
                                <select name="status" class="form-control pe-5">
                                    <option value="all">Tất Cả Đơn Hàng</option>
                                    <option {{ $status == 'Đang Xử Lý' ? 'selected' : false }}>Đang Xử Lý</option>
                                    <option {{ $status == 'Đang Giao Hàng' ? 'selected' : false }}>Đang Giao Hàng</option>
                                    <option {{ $status == 'Đã Giao Hàng' ? 'selected' : false }}>Đã Giao Hàng</option>
                                    <option {{ $status == 'Hoàn Thành' ? 'selected' : false }}>Hoàn Thành</option>
                                    <option {{ $status == 'Đã Hủy' ? 'selected' : false }}>Đã Hủy</option>
                                </select>
                                <button class="btn btn-danger rounded-0">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>Mã Đơn Hàng</th>
                                <th>Khách hàng</th>
                                <th>Số tiền</th>
                                <th>Hình thức thanh toán</th>
                                <th></th>
                                <th>Trạng thái</th>
                                <th>Ngày đặt hàng</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="spacer"></tr>
                            @foreach ($orders as $order)
                                <tr class="tr-shadow">
                                    <td>
                                        <span>
                                            {{ $order->code }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $order->user->name }}
                                    </td>
                                    <td>
                                        <span>{{ number_format($order->total) }}đ</span>
                                    </td>
                                    <td>{{ $order->payment_method == 'cod' ? 'Thanh toán khi nhận hàng' : 'Thanh toán trực tuyến' }}
                                    </td>
                                    <td>
                                        {!! $order->payment_status == 'Đã thanh toán'
                                            ? '<span class="fw-bold text-success">Đã thanh toán</span>'
                                            : '<span class="fw-bold text-danger">Chưa thanh toán</span>' !!}
                                    </td>
                                    <td>
                                        @if ($order->status == 'Đang Xử Lý' || $order->status == 'Đang Giao Hàng' || $order->status == 'Đã Giao Hàng')
                                            <div class="cl2 text-primary fw-bold">{{ $order->status }}</div>
                                        @endif
                                        @if ($order->status == 'Hoàn Thành')
                                            <div class="cl2 text-success fw-bold">{{ $order->status }}</div>
                                        @endif
                                        @if ($order->status == 'Đã Hủy')
                                            <div class="cl2 text-danger fw-bold">{{ $order->status }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        {{ date('H:i d/m/Y', strtotime($order->created_at)) }}
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            @if ($order->status != 'Hoàn thành' && $order->status != 'Đã hủy')
                                                <button class="item" data-toggle="tooltip" data-placement="top"
                                                    data-bs-toggle="modal" data-bs-target="#update_{{ $order->id }}"
                                                    title="Cập nhật tình trạng đơn hàng">
                                                    <i class="zmdi zmdi-swap"></i>
                                                </button>
                                            @endif
                                            <a href="{{ route('admin.order.export', ['id' => $order->id]) }}"
                                                target="_blank" class="item" data-toggle="tooltip" data-placement="top"
                                                title="Xuất hóa đơn">
                                                <i class="zmdi zmdi-print"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                {{-- Modal --}}
                                <div class="modal fade" id="update_{{ $order->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.order.changStatus', ['id' => $order->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Cập nhật trạng thái đơn hàng</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="d-flex mb-3">
                                                        <div class="col-md-6">Mã đơn hàng:</div>
                                                        <div class="col-md-6">#{{ $order->code }}</div>
                                                    </div>
                                                    <div class="d-flex mb-3">
                                                        <div class="col-md-6">Trạng thái hiện tại:</div>
                                                        <div class="col-md-6">{{ $order->status }}</div>
                                                    </div>
                                                    <div class="d-flex mb-3 flex-wrap">
                                                        <div class="col-md-6">Trạng thái tiếp theo:</div>
                                                        @if ($order->status == 'Đang xử lý')
                                                            <div class="col-md-6"><i class="zmdi zmdi-long-arrow-right"></i>
                                                                Vận chuyển</div>
                                                        @endif
                                                        @if ($order->status == 'Đang giao hàng')
                                                            <div class="col-md-6"><i class="zmdi zmdi-long-arrow-right"></i>
                                                                Chờ nhận hàng</div>
                                                        @endif
                                                        @if ($order->status == 'Chờ lấy hàng')
                                                            <div class="col-md-6">
                                                                <div>
                                                                    <i class="zmdi zmdi-long-arrow-right"></i>
                                                                    Hoàn thành giao hàng
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 small mt-2">
                                                                Lưu ý: trạng thái hoàn thành đồng nghĩa
                                                                với việc
                                                                khách hàng đã thanh toán. Bạn sẽ không thể thay đổi đơn
                                                                hàng
                                                                sau khi
                                                                đã cập nhật trạng thái hoàn thành.
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Hủy</button>
                                                    <button type="submit" class="btn btn-danger">Xác
                                                        nhận</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <tr class="spacer"></tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
