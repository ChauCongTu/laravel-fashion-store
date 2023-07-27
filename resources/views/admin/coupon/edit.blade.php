@extends('layouts.admin')
@section('title')
    Chỉnh sửa mã khuyến mãi
@endsection
@section('content')
    <section class="p-5">
        <form action="{{ route('ma-giam-gia.update', ['ma_giam_gium' => $coupon]) }}" method="post" enctype="multipart/form-data">
            <div class="col-lg-12">
                <div class="card">
                    @csrf
                    @method('PUT')
                    <div class="card-header">Quản lý mã khuyến mãi</div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">CHỈNH SỬA MÃ KHUYẾN MÃI</h3>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="code" class="control-label mb-1">Mã khuyến mãi</label>
                            <input name="code" type="text" class="form-control bg-white" value="{{ $coupon->code }}"
                                disabled>
                            @error('code')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="type" class="control-label mb-1">Loại</label>
                            <select name="type" class="form-control">
                                <option value="percent" {{ $coupon->type == 'percent' ? 'selected' : false }}>Phần trăm
                                </option>
                                <option value="price" {{ $coupon->type == 'price' ? 'selected' : false }}>Tiền</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="value" class="control-label mb-1">Giá trị</label>
                            <input name="value" type="text" class="form-control" value="{{ $coupon->value }}">
                            @error('value')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="usage_limit" class="control-label mb-1">Số lượt sử dụng</label>
                            <input name="usage_limit" type="text" class="form-control" value="{{ $coupon->value }}">
                            @error('usage_limit')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="expired" class="control-label mb-1">Hạn sử dụng</label>
                            <span class="text-muted small">(Không chọn mục này thì mã này sẽ không bị giới hạn thời
                                gian)</span>
                            <input name="expired" type="date" class="form-control" value="{{ $coupon->expired }}">
                            @error('expired')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary btn-block mt-3 text-white">
                                <span>Cập nhật</span>
                            </button>
                            <a href="{{ route('ma-giam-gia.index') }}" class="btn btn-outline-primary mt-3">Quay lại</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
