@extends('layouts.master')
@section('title')
    Thiết lập tài khoản của tôi
@endsection
@section('content')
    <div class="container mt-5 py-3">
        <div class="bread-crumb flex-w p-r-15 p-t-30">
            <a href="{{ route('home') }}" class="cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="cl4">
                Tài khoản của tôi
            </span>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <div class="col-md-8 border p-4 border-primary rounded-3">
                <div class="title h4 cl2 border-bottom pb-2">
                    Hồ sơ của tôi
                </div>
                <div class="main row py-3">
                    <div class="col-md-4">
                        <div class="img text-center border-start">
                            <img src="{{ asset('storage/' . $user->photo) }}" width="100px" height="100px"
                                class="border rounded-circle" />
                            <!-- Button trigger modal -->
                            <div class="mt-3 mb-3">
                                <button type="button" class="btn rounded-0 btn-outline-primary px-4" data-bs-toggle="modal"
                                    data-bs-target="#changeAvatar">
                                    <i class="fa-solid fa-camera-retro me-3"></i>Thay đổi
                                </button>
                            </div>

                            <!-- Modal -->
                            <div class="modal fade m-t-120" id="changeAvatar" tabindex="-1" role="dialog"
                                aria-labelledby="modalTitleId" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="py-4">
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('users.change_avatar') }}" enctype="multipart/form-data" method="post">
                                                <div class="container-fluid">
                                                    @csrf
                                                    <input type="file" class="form-control" name="photo" accept="jpeg,jpg,png">
                                                    <div class="mt-3">
                                                        <p>Kích thước tối đa 1MB</p>
                                                        <p>Định dạng ảnh: JPEG, PNG</p>
                                                        <div class="py-4">
                                                            <button type="button" class="btn btn-outline-primary px-4"
                                                                data-bs-dismiss="modal">Hủy</button>
                                                            <button type="submit"
                                                                class="btn btn-primary px-4">Upload</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <form action="{{ route('users.info') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="h5 cl2">Họ tên:</label>
                                <input type="text" name="name" value="{{ $user->name }}" class="form-control" />
                                @error('name')
                                    <div class="text-danger">
                                        * {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="h5 cl2">Số điện thoại:</label>
                                <input type="text" name="phone" value="{{ $user->phone }}" class="form-control" />
                                @error('phone')
                                    <div class="text-danger">
                                        * {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="h5 cl2">Email:</label>
                                <input type="text" name="email" value="{{ $user->email }}" class="form-control" />
                                @error('email')
                                    <div class="text-danger">
                                        * {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address" class="h5 cl2">Địa chỉ:</label>
                                <textarea name="address" rows="4" class="form-control">{{ $user->address }}</textarea>
                                @error('address')
                                    <div class="text-danger">
                                        * {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-primary rounded-0 px-4">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
