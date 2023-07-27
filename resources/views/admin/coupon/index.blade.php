@extends('layouts.admin')
@section('title')
    Quản lý mã khuyến mãi
@endsection
@section('content')
    <section class="manage p-5">
        <div class="row">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <h3 class="title-3 m-b-35">Danh mục mã khuyến mãi</h3>
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <form action="{{ route('quan-ly-danh-muc.index') }}" method="get" class="d-flex">
                            <input type="search" name="s" value="{{ $searchString }}" class="form-control"
                                placeholder="Nhập từ khóa..." />
                            <button class="btn btn-danger rounded-0"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div class="table-data__tool-right">
                        <a href="{{ route('ma-giam-gia.create') }}" class="au-btn au-btn-icon au-btn--green au-btn--small">
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
                                <th>ID</th>
                                <th>Mã khuyến mãi</th>
                                <th>Loại</th>
                                <th>Giá trị</th>
                                <th>Số lượng</th>
                                <th>Đã sử dụng</th>
                                <th>Thời hạn</th>
                                <th>Ngày tạo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="spacer"></tr>
                            @foreach ($coupon as $cp)
                                <tr class="tr-shadow">
                                    <td>
                                        {{ $cp->id }}
                                    </td>
                                    <td>
                                        {{ $cp->code }}
                                    </td>
                                    <td>
                                        <span>{{ $cp->type == 'price' ? 'Tiền' : 'Phần trăm' }}</span>
                                    </td>
                                    <td>{{ $cp->type == 'price' ? number_format($cp->value) . 'đ' : $cp->value . '%' }}</td>
                                    <td>{{ $cp->usage_limit }}</td>
                                    <td>{{ $cp->usage_used }}</td>
                                    <td>{{ ($cp->expired == null )?'Không thời hạn':date('d/m/Y', strtotime($cp->expired)) }}</td>
                                    <td>{{ date('d/m/Y', strtotime($cp->created_at)) }}</td>
                                    <td>
                                        <div class="table-data-feature">
                                            <a href="{{ route('ma-giam-gia.edit', ['ma_giam_gium' => $cp]) }}"
                                                class="item" data-toggle="tooltip" data-placement="top" title="Chỉnh sửa">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                data-bs-toggle="modal" data-bs-target="#del_{{ $cp->id }}"
                                                title="Xóa">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="del_{{ $cp->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('ma-giam-gia.destroy', ['ma_giam_gium' => $cp]) }}"
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
                        {{ $coupon->links() }}
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </section>
@endsection
