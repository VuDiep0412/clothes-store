@extends('backend.layouts.main')
@section('content')
    <section class="content-header">
        <h1>
        Danh Sách <a href="{{route('coupon.create')}}" class="btn bg-aqua "><i class="fa fa-plus"></i> Thêm </a>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">

                            <thead>
                            <tr>
                                <td>TT</td>
                                <th>Mã giảm giá</th>
                                <th>Số lượng giảm</th>
                                <th>Ngày hết hạn</th>
                                <th>Trạng thái</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($coupon as $key => $item)
                                <tr class="item-{{$item->id}}">
                                    <td>{{$key + 1}}</td>
                                    <td>{{$item->code}}</td>
                                    <td>{{$item->value}}</td>
                                    <td>{{$item->date_end}}</td>
                                    <td>
                                        @if($item->status == 1)
                                            <span class="label label-success">Hiển thị</span>
                                        @else
                                            <span class="label label-default">Không hiển thị</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{route('coupon.edit', ['id'=> $item->id])}}" class="btn btn-info"><i class="fa fa-pencil-square-o"></i></a>
                                        <button onclick="deleteItem('coupon',{{ $item->id }})" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
@endsection
