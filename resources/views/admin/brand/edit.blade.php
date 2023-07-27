@extends('layouts.admin')
@section('title')
    Chỉnh sửa thương hiệu
@endsection
@section('content')
    <section class="p-5">
        <form action="{{ route('quan-ly-thuong-hieu.update', ['quan_ly_thuong_hieu' => $brand]) }}" method="post" enctype="multipart/form-data">
            <div class="col-lg-6">
                <div class="card">
                    @csrf
                    @method('PUT')
                    <div class="card-header">Quản lý thương hiệu thời trang</div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">CHỈNH SỬA THƯƠNG HIỆU</h3>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="name" class="control-label mb-1">Tên thương hiệu</label>
                            <input name="name" type="text" class="form-control" value="{{ $brand->name }}">
                            @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="control-label mb-1">Hình ảnh</label>
                            <input name="photo" type="file" class="form-control" aria-required="true"
                                aria-invalid="false" value="{{ old('photo') }}">
                                @error('photo')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div>
                            <button type="submit" class="btn btn-info btn-block mt-3 text-white">
                                <span>Cập nhật</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
