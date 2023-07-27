@extends('layouts.admin')
@section('title')
    Thêm banner quảng cáo
@endsection
@section('content')
    <section class="p-5">
        <form action="{{ route('quan-ly-banner.store') }}" method="post" enctype="multipart/form-data">
            <div class="col-lg-6">
                <div class="card">
                    @csrf
                    <div class="card-header">Quản lý BANNER</div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">THÊM BANNERS</h3>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="title" class="control-label mb-1">Tiêu đề</label>
                            <input name="title" type="text" class="form-control" value="{{ old('title') }}">
                            @error('title')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="summary" class="control-label mb-1">Mô tả</label>
                            <input name="summary" type="text" class="form-control" value="{{ old('summary') }}">
                            @error('summary')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="path" class="control-label mb-1">Liên kết</label>
                            <input name="path" type="text" class="form-control" value="{{ old('path') }}">
                            @error('path')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="type" class="control-label mb-1">Loại</label>
                            <select name="type" class="form-control">
                                <option value="slide">Banner trượt</option>
                                <option value="block">Banner khối</option>
                            </select>
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
                                <span>Thêm</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
