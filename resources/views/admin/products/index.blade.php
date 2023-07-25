@extends('layouts.admin')
@section('title')
    Quản lý sản phẩm
@endsection
@section('content')
    <section class="manage p-5">
        <div class="row">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <h3 class="title-3 m-b-35">Quản lý sản phẩm</h3>
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <form action="{{ route('quan-ly-san-pham.index') }}" method="get" class="d-flex">
                            <input type="search" name="MaSanPham" value="{{ $searchString }}" class="form-control"
                                placeholder="Nhập mã sản phẩm" />
                            <button class="btn btn-danger rounded-0"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('quan-ly-san-pham.create') }}"
                            class="au-btn au-btn-icon au-btn--green au-btn--small">
                            <i class="zmdi zmdi-plus"></i>THÊM</a>
                        <div class="rs-select2--dark rs-select2--sm rs-select2--dark2">
                            <select class="js-select2" name="type">
                                <option selected="selected">Export</option>
                                <option value="">Excel</option>
                                <option value="">PDF</option>
                            </select>
                            <div class="dropDownSelect2"></div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive table-responsive-data2">
                    <table class="table table-data2">
                        <thead>
                            <tr>
                                <th>CODE</th>
                                <th>Ảnh</th>
                                <th>Tên</th>
                                <th>Số lượng</th>
                                <th>Giá tiền</th>
                                <th>Thương hiệu</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="spacer"></tr>
                            @foreach ($products as $product)
                                <tr class="tr-shadow">
                                    <td>
                                        <span>
                                            {{ $product->code }}
                                        </span>
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/' . $product->photo) }}" width="80px" alt="">
                                    </td>
                                    <td>
                                        <span>{{ $product->name }}</span>
                                    </td>
                                    <td class="desc">{{ $product->stock }}</td>
                                    <td>
                                        <x-price :discount='$product->display_price' :price='$product->price' />
                                    </td>
                                    <td>
                                        <span>{{ $product->brand->name }}</span>
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                data-bs-toggle="modal" data-bs-target="#discount_{{ $product->id }}"
                                                title="Xóa">
                                                <i class="zmdi zmdi-plus"></i>
                                            </button>
                                            <a href="{{ route('quan-ly-san-pham.edit', ['quan_ly_san_pham' => $product]) }}"
                                                class="item" data-toggle="tooltip" data-placement="top"
                                                title="Chỉnh sửa hình ảnh">
                                                <i class="zmdi zmdi-collection-image"></i>
                                            </a>
                                            <a href="{{ route('quan-ly-san-pham.edit', ['quan_ly_san_pham' => $product]) }}"
                                                class="item" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                data-bs-toggle="modal" data-bs-target="#del_{{ $product->id }}"
                                                title="Xóa">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="discount_{{ $product->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form
                                                action="{{ route('product.changeDiscount', ['id' => $product->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Cập nhật khuyến mãi</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="discount" class="control-label mb-1">Nhập số tiền được giảm</label>
                                                    <input type="text" name="discount" class="form-control" value="{{ $product->discount }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Hủy</button>
                                                    <button type="submit" class="btn btn-danger" id="delete">Xác
                                                        nhận</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="del_{{ $product->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form
                                                action="{{ route('quan-ly-san-pham.destroy', ['quan_ly_san_pham' => $product]) }}"
                                                method="post">
                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Xác nhận xóa</h4>
                                                </div>
                                                <div class="modal-body">
                                                    Bạn có chắc chắn muốn xóa không?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Hủy</button>
                                                    <button type="submit" class="btn btn-danger" id="delete">Xác
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
                        {{ $products->links() }}
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </section>
@endsection
