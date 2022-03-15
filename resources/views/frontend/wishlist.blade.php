@extends('frontend.layouts.main')

@section('content')
<div>
    <h4 class="text-center">Danh sách yêu thích</h4><br>
</div>

<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Tùy chọn</th>
            </tr>
        </thead>
        <tbody>
            @foreach($wishlist as $key => $item)
            <tr>
                <td>{{$key+1}}</td>
                <td>
                    <img src="{{asset($item->product->avatar)}}" width="60" height="80">
                </td>
                <td><a href="{{route('shop.productDetail', $item->product->slug)}}">{{$item->product->name}}</a></td>
                <td>
                    @if($item->product->best_sale==1)
                    {{number_format($item->product->sale)}}đ
                    @else
                    {{number_format($item->product->price)}}đ
                    @endif
                </td>
                <td>
                    <form action="{{route('wishlist.destroy',$item->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn btn-link text-danger"><i class="fa fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection