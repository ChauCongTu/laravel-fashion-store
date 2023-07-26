@extends('layouts.admin')
@section('title')
    Quản lý hình ảnh sản phẩm
@endsection
@section('content')
    <section class="p-5">
        <div class="bg-white p-3">
            <div class="title-4">Quản lý hình ảnh</div>
            <div class="add">
                <div class="py-3">
                    <form action="{{ route('product.image.add', ['product_id' => $product_id]) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex">
                            <input type="file" id="file-multiple-input" name="photo[]" multiple=""
                                class="form-control">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row p-1">
                @forelse ($images as $img)
                    <div class="col-sm-4 overflow-hidden mt-3">
                        <div class="a-images">
                            <img src="{{ asset('storage' . $img->photo) }}" class="w-100" alt="">
                            <div class="delete">
                                <form action="{{ route('product.image.delete', ['id' => $img->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm rounded-0 px-4">Xóa</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center">
                        Chưa có hình ảnh chi tiết cho sản phẩm này
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
