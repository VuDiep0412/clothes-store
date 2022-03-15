@extends('backend.layouts.main')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Thống kê
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $numOrder }}</h3>
                    <p>Đơn Hàng</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{route('admin.order.index')}}" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>{{ $numProduct }}</h3>
                    <p>Sản phẩm</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('admin.product.index')}}" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{ $numUser }}</h3>
                    <p>Người dùng</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{route('admin.article.index')}}" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{ $numArticle }}</h3>
                    <p>Bài viết</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{route('admin.user.index')}}" class="small-box-footer">Chi tiết <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Đơn hàng mới</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>

                </div>
                <!-- /.box-header -->
                <div class="box-body" style="">
                    <div class="table-responsive">
                        <table class="table no-margin">
                            <thead>
                                <tr>
                                    <th class="text-center">TT</th>
                                    <th class="text-center">Ngày</th>
                                    <th class="text-center">Mã ĐH</th>
                                    <th style="max-with:200px">Trạng thái</th>
                                    <th>Họ tên</th>
                                    <th>ĐT</th>
                                    <!-- <th>Email</th> -->
                                    <th>Tổng tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $key => $item)
                                <tr class="item-{{$item->id}}">
                                    <!-- Thêm Class Cho Dòng -->
                                    <td class="text-center">{{$key+1}}</td>
                                    <td class="text-center">{{$item->created_at}}</td>
                                    <td class="text-center">
                                        <a href="{{route('admin.order.edit', ['id'=> $item->id ])}}">
                                            <span title="Edit" type="button">{{$item->code}}</span>
                                        </a>&nbsp;
                                    </td>
                                    <td>
                                        @if ($item->order_status_id == 1)
                                        <span class="label label-info">Mới</span>
                                        @elseif ($item->order_status_id == 2)
                                        <span class="label label-warning">Đang Xử Lý</span>
                                        @elseif ($item->order_status_id == 3)
                                        <span class="label label-success">Hoàn thành</span>
                                        @else
                                        <span class="label label-danger">Hủy</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{$item->cus_name}}
                                    </td>
                                    <td>{{$item->cus_phone}}</td>
                                    <!-- <td>{{$item->cus_email}}</td> -->
                                    <td class="price">{{number_format($item->total)}} đ</td>

                                </tr>


                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix" style="">
                    <a href="{{route('admin.order.index')}}" class="btn btn-sm btn-info btn-flat pull-right">Xem tất cả</a>
                </div>
                <!-- /.box-footer -->
            </div>

        </div>
        <div class="col-md-4">
            <p class="text-center">
                <strong>Đơn hàng tháng này</strong>
            </p>
            @if($od)
            <div class="progress-group">
                <span class="progress-text">Mới</span>
                <span class="progress-number"><b>{{$orderMonth['0']}}</b>/{{$od}}</span>

                <div class="progress sm">
                    <div class="progress-bar progress-bar-aqua" style="width: {{$orderMonth['0']/$od *100}}%"></div>
                </div>
            </div>
            <!-- /.progress-group -->
            <div class="progress-group">
                <span class="progress-text">Đã Xác Nhận</span>
                <span class="progress-number"><b>{{$orderMonth['1']}}</b>/{{$od}}</span>

                <div class="progress sm">
                    <div class="progress-bar progress-bar-primary" style="width:{{$orderMonth['1']/$od *100}}% "></div>
                </div>
            </div>
            <!-- /.progress-group -->
            <div class="progress-group">
                <span class="progress-text">Đang Giao Hàng</span>
                <span class="progress-number"><b>{{$orderMonth['2']}}</b>/{{$od}}</span>

                <div class="progress sm">
                    <div class="progress-bar progress-bar-yellow" style="width:{{$orderMonth['2']/$od *100}}% "></div>
                </div>
            </div>
            <!-- /.progress-group -->
            <div class="progress-group">
                <span class="progress-text">Đã Giao Hàng</span>
                <span class="progress-number"><b>{{$orderMonth['3']}}</b>/{{$od}}</span>

                <div class="progress sm">
                    <div class="progress-bar progress-bar-green" style="width: {{$orderMonth['3']/$od *100}}%"></div>
                </div>
            </div>
            <!-- /.progress-group -->
            <div class="progress-group">
                <span class="progress-text">Đã Huỷ</span>
                <span class="progress-number"><b>{{$orderMonth['4']}}</b>/{{$od}}</span>

                <div class="progress sm">
                    <div class="progress-bar progress-bar-red" style="width: {{$orderMonth['4']/$od *100}}%"></div>
                </div>
            </div>
            <div class="progress-group">
                <span class="progress-text">Doanh thu: </span>
                <span class="progress-number"><b>{{number_format($orderMonth['5'])}}đ</b></span>

            </div>
            @endif

        </div>

    </div>
</section>
<!-- /.content -->
@endsection