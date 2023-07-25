@extends('layouts.admin')
@section('title')
    Thêm sản phẩm
@endsection
@section('content')
    <section class="p-5">
        <form action="{{ route('quan-ly-san-pham.store') }}" method="post" enctype="multipart/form-data">
            <div class="col-lg-12">
                <div class="card">
                    @csrf
                    <div class="card-header">Quản lý sản phẩm</div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">THÊM SẢN PHẨM</h3>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="name" class="control-label mb-1">Tên sản phẩm</label>
                            <input name="name" type="text" class="form-control" value="{{ old('name') }}">
                            @error('name')
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
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="size" class="control-label mb-1">Kích thước</label>
                                    <input name="size" type="text" class="form-control"
                                        placeholder="Điền các size ngăn cách bởi dấu , | Ví dụ: S,M,N"
                                        value="{{ old('size') }}">
                                    @error('size')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="color" class="control-label mb-1">Màu</label>
                                    <input name="color" type="text" class="form-control"
                                        placeholder="Điền các màu ngăn cách bởi dấu , | Ví dụ: Xanh,Đen,Đỏ"
                                        value="{{ old('color') }}">
                                    @error('color')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="stock" class="control-label mb-1">Số lượng</label>
                                    <input name="stock" type="text" class="form-control" value="{{ old('stock') }}">
                                    @error('stock')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="price" class="control-label mb-1">Giá bán</label>
                                    <input name="price" type="text" class="form-control" value="{{ old('price') }}">
                                    @error('price')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="control-label mb-1">Chi tiết</label>
                            <textarea name="description" id="description">{{ old('description') }}</textarea>
                            <script>
                                CKEDITOR.replace('description');
                            </script>
                            @error('description')
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
                        <div class="mb-3">
                            <label for="cat_id" class="control-label mb-1">Danh mục</label>
                            <select name="cat_id" class="form-control form-select-control">
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="brand_id" class="control-label mb-1">Thương hiệu</label>
                            <select name="brand_id" class="form-control form-select-control">
                                @foreach ($brand as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-info btn-block mt-3 text-white">
                                <span>Thêm sản phẩm</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
