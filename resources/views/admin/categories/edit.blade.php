@extends('layouts.admin')
@section('title')
    Chỉnh sửa danh mục {{ $category->name }}
@endsection
@section('content')
    <section class="p-5">
        <form action="{{ route('quan-ly-danh-muc.update', ['quan_ly_danh_muc' => $category]) }}" method="post" enctype="multipart/form-data">
            <div class="col-lg-6">
                <div class="card">
                    @csrf
                    @method('PUT')
                    <div class="card-header">Quản lý danh mục sản phẩm</div>
                    <div class="card-body">
                        <div class="card-title">
                            <h3 class="text-center title-2">CHỈNH SỬA DANH MỤC</h3>
                        </div>
                        <hr>
                        <div class="mb-3">
                            <label for="name" class="control-label mb-1">Tên danh mục</label>
                            <input name="name" type="text" class="form-control" value="{{ $category->name }}">
                            @error('name')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="summary" class="control-label mb-1">Mô tả</label>
                            <input name="summary" type="text" class="form-control" value="{{ $category->summary }}">
                            @error('summary')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="control-label mb-1">Hình ảnh</label>
                            <input name="photo" type="file" class="form-control" aria-required="true"
                                aria-invalid="false" value="">
                            @error('photo')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        @if ($category->is_parent == 0)
                            <div class="mb-3">
                                <label for="parent_id" class="control-label mb-1">Danh mục cha</label>
                                <select name="parent_id" class="form-control form-select-control">
                                    <option value="0" {{ $category->parent_id == null ? 'selected' : false }}>Không
                                    </option>
                                    @foreach ($rootCategories as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $category->parent_id == $item->id ? 'selected' : false }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div>
                            <button type="submit" class="btn btn-info btn-block mt-3 text-white">
                                <span>Thêm danh mục</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
