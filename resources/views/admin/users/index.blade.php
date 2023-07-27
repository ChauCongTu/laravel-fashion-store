@extends('layouts.admin')
@section('title')
    Quản lý người dùng
@endsection
@section('content')
    <section class="manage p-5">
        <div class="row">
            <div class="col-md-12">
                <!-- DATA TABLE -->
                <h3 class="title-3 m-b-35">Quản lý người dùng</h3>
                <div class="table-data__tool">
                    <div class="table-data__tool-left">
                        <form action="{{ route('quan-ly-nguoi-dung.index') }}" method="get" class="d-flex">
                            <input type="search" name="s" value="{{ $searchString }}" class="form-control"
                                placeholder="Nhập từ khóa..." />
                            <button class="btn btn-danger rounded-0"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <div class="table-data__tool-right">
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
                                <th>Ảnh</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>Vai trò</th>
                                <th>Ngày tạo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="spacer"></tr>
                            @foreach ($users as $user)
                                <tr class="tr-shadow">
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/' . $user->photo) }}" width="80px" alt="">
                                    </td>
                                    <td>
                                        <span>{{ $user->name }}</span>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->role == 'admin' ? 'Quản trị viên' : 'Khách hàng' }}</td>
                                    <td>
                                        <span>{{ date('d/m/Y', strtotime($user->created_at)) }}</span>
                                    </td>
                                    <td>
                                        <div class="table-data-feature">
                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                data-bs-toggle="modal" data-bs-target="#update_{{ $user->id }}"
                                                title="Phân quyền">
                                                <i class="zmdi zmdi-swap"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                data-bs-toggle="modal" data-bs-target="#ban_{{ $user->id }}"
                                                title="Khóa">
                                                <i class="zmdi zmdi-block"></i>
                                            </button>
                                            <button class="item" data-toggle="tooltip" data-placement="top"
                                                data-bs-toggle="modal" data-bs-target="#del_{{ $user->id }}"
                                                title="Xóa">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="ban_{{ $user->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form action="{{ route('quan-ly-nguoi-dung.banUser', ['id' => $user->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Khóa người dùng</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <input type="number" placeholder="Nhập thời hạn khóa (tính theo phút)"
                                                        name="time" class="form-control">
                                                    @if ($user->ban_time > time())
                                                        <div class="my-3">
                                                            Người dùng này đang bị khóa, thời gian còn lại:
                                                            {{ ceil(($user->ban_time - time()) / 60) }} phút
                                                            <br>
                                                            Nhập 0 để mở khóa cho tài khoản này!
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Hủy</button>
                                                    <button type="submit" class="btn btn-danger" id="change">Xác
                                                        nhận</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="update_{{ $user->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form
                                                action="{{ route('quan-ly-nguoi-dung.changeRole', ['id' => $user->id]) }}"
                                                method="post">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Phân quyền</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <select name="role" class="form-control">
                                                        <option value="admin">Quản trị viên</option>
                                                        <option value="user">Khách hàng</option>
                                                    </select>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Hủy</button>
                                                    <button type="submit" class="btn btn-danger" id="change">Xác
                                                        nhận</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="del_{{ $user->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <form
                                                action="{{ route('quan-ly-nguoi-dung.destroy', ['quan_ly_nguoi_dung' => $user]) }}"
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
                        {{ $users->links() }}
                    </div>
                </div>
                <!-- END DATA TABLE -->
            </div>
        </div>
    </section>
@endsection
