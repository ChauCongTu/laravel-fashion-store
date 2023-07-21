@extends('layouts.master')
@section('title')
    Danh sách yêu thích
@endsection
@section('content')
    <div class="container mt-5 py-3">
        <div class="bread-crumb flex-w p-r-15 p-t-30">
            <a href="{{ route('home') }}" class="cl8 hov-cl1 trans-04">
                Trang chủ
                <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
            </a>
            <span class="cl4">
                Sản phẩm yêu thích
            </span>
        </div>
    </div>
    {{--  --}}
    <div class="container">
        <div class="wrap-table-shopping-cart">
            <table class="table-shopping-cart">
                <tr class="table_head">
                    <th class="column-1">Product</th>
                    <th class="column-2">Tên</th>
                    <th class="column-3">Giá</th>
                    <th class="column-4"></th>
                    <th class="column-5"></th>
                </tr>
                @forelse($wishlist as $item)
                    <tr class="table_row">
                        <td class="column-1">
                            <div class="how-itemcart1">
                                <img src="{{ asset('storage/' . $item->product->photo) }}" alt="IMG">
                            </div>
                        </td>
                        <td class="column-2">
                            <a href="{{ route('product.show', ['slug' => $item->product->slug, 'id' => $item->product->id]) }}"
                                class="cl2 hov-cl1 trans-04">{{ $item->product->name }}</a>
                        </td>
                        <td class="column-3">{{ number_format($item->product->price, 0, ',', '.') }}đ
                        </td>
                        <td class="column-4">
                            <a href="{{ route('product.show', ['slug' => $item->product->slug, 'id' => $item->product->slug]) }}"
                                class="cl2 hov-cl1">Xem chi tiết</a>
                        </td>
                        <td class="column-5">
                            <form action="{{ route('wishlist.destroy', ['product_id' => $item->product->id]) }}"
                                method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="cl13 hov-cl1 trans-04">Xóa</button>
                            </form>
                        </td>

                    </tr>

                @empty
                    <p>Không có sản phẩm nào</p>
                @endforelse
            </table>
        </div>
        <div class="d-flex">
            {{ $wishlist->links() }}
        </div>
    </div>
@endsection
