@extends('backend.layouts.main')
@section('content')
<section class="content-header">
    <h1>
        Chi tiết đơn hàng <a href="{{route('admin.order.index')}}" class="btn bg-primary"><i class="fa fa-list"></i> Danh Sách</a>
    </h1>
</section>
@if (session('msg'))
<div class="pad margin no-print" style="margin-bottom: -20px;">
    <div class="alert alert-success alert-dismissible" style="" id="thongbao" style="margin-bottom: 5px;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ session('msg') }}
    </div>
</div>
@endif

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-12">
                    <div class="container123  col-md-6" style="">
                        <h4></h4>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="col-md-4">Thông tin khách hàng</th>
                                    <th class="col-md-6"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                    <td>Mã đơn hàng</td>
                                    <td><b>{{ $order->code }}</b></td>
                                </tr>
                                <tr>
                                    <td>Thông tin người đặt hàng</td>
                                    <td><b>{{ $order->cus_name }}</b></td>
                                </tr>
                                <tr>
                                    <td>Ngày đặt hàng</td>
                                    <td><b>{{ $order->created_at }}</b></td>
                                </tr>
                                <tr>
                                    <td>Số điện thoại</td>
                                    <td><b>{{ $order->cus_phone }}</b></td>
                                </tr>
                                <tr>
                                    <td>Địa chỉ</td>
                                    <td><b>{{ $order->cus_address }}</b></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><b>{{ $order->cus_email }}</b></td>
                                </tr>
                                <tr>
                                    <td>Ghi chú</td>
                                    <td><b>{{ $order->note }}</b></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <table id="myTable" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                        <thead>
                            <tr role="row">
                                <th class="sorting col-md-1">STT</th>
                                <th class="sorting col-md-4">Tên sản phẩm</th>
                                <th class="sorting col-md-1">Hình ảnh</th>
                                <th class="sorting col-md-1">Số lượng</th>
                                <th class="sorting col-md-1">Kích thước</th>
                                <th class="sorting col-md-1">Màu</th>
                                <th class="sorting col-md-1">Giá</th>
                                <th class="sorting col-md-1">Thành tiền</th>
                        </thead>
                        <tbody>
                            @foreach($order->detail as $key => $item)
                            <tr class="item-{{ $item->id }}">
                                <td>{{$key+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    @if ($item->avatar)
                                    <!-- Kiểm tra hình ảnh tồn tại -->
                                    <img src="{{asset($item->avatar)}}" width="50" height="60">
                                    @endif

                                </td>
                                <td>{{$item->quantity}}</td>
                                <td>{{$item->size}}</td>
                                <td>{{$item->color}}</td>
                                <td>{{ number_format($item->price,0,",",".") }} đ</td>
                                <td>{{ number_format($item->price * $item->quantity,0,",",".") }} đ</td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="6"><b></b></td>
                                <td colspan="1"><b>Tổng tiền</b></td>
                                <td colspan="1"><b class="text-red">{{ number_format(($order->total),0,",",".") }} đ</b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12">
                <form action="{{ route('admin.order.update', ['id' => $order->id]) }}" method="POST">
                    <input type="hidden" name="_method" value="PUT">
                    @csrf
                    @method('PUT')
                    <div class="col-md-7"></div>
                    <div class="col-md-5">
                        <div class="form-inline">
                            <label>Trạng thái đơn hàng: </label>
                            <td>
                                @if($order->order_status_id == 4 || $order->order_status_id == 5)
                                <select class="form-control " name="order_status_id" style="max-width: 150px;display: inline-block;" disabled>
                                    <option value="0">--- Chọn ---</option>
                                    @foreach($order_status as $status)
                                    <option {{ ($order->order_status_id == $status->id ? 'selected':'') }} value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                                @else
                                <select class="form-control " name="order_status_id" style="max-width: 150px;display: inline-block;">
                                    <option value="0">--- Chọn ---</option>
                                    @foreach($order_status as $status)
                                    <option {{ ($order->order_status_id == $status->id ? 'selected':'') }} value="{{ $status->id }}">{{ $status->name }}</option>
                                    @endforeach
                                </select>
                                @endif
                            </td>
                            <input type="submit" value="Xử lý" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection