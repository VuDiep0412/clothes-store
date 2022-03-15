@extends('backend.layouts.main')
@section('content')
<style>
    tr td:first-child {
        max-width: 250px
    }

    .price {
        color: red
    }
</style>
<section class="content-header">
    <h1>
        Danh Sách Đơn Hàng
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Thông tin đơn hàng</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example1" class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">TT</th>
                                <th class="text-center">Mã đơn hàng</th>
                                <th class="text-center">Khách hàng</th>
                                <th class="text-center">Điện thoại</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                            @foreach($data as $key => $item)
                            <tr class="item-{{ $item->id }}">
                                <!-- Thêm Class Cho Dòng -->
                                <td class="text-center">{{ $key+1 }}</td>
                                <td class="text-center">{{ $item->code }}</td>
                                <td class="text-center">{{ $item->cus_name }}</td>
                                <td class="text-center">{{ $item->cus_phone }}</td>
                                <td class="text-center">{{ $item->cus_email }}</td>
                                <td class="text-center">
                                    @if ($item->order_status_id === 1)
                                    <span class="label label-info">Mới</span>
                                    @elseif ($item->order_status_id === 2)
                                    <span class="label label-primary">Đã Xác Nhận</span>
                                    @elseif ($item->order_status_id === 3)
                                    <span class="label label-warning">Đang Giao Hàng</span>
                                    @elseif ($item->order_status_id === 4)
                                    <span class="label label-success">Đã Giao Hàng</span>
                                    @else
                                    <span class="label label-danger">Đã Hủy</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{route('admin.order.edit', ['id'=> $item->id ])}}" class="btn btn-light bg-gray">
                                        <i class="fa fa-eye"></i> </a>
                                    <button onclick="deleteItem('order',{{$item->id}})" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </td>
                                @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->

            </div>
            <!-- /.box -->

        </div>
    </div>
    <!-- /.row -->
</section>
@endsection

@section('script')
<script>
    $(function() {
        $('#example1').DataTable();
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    })
</script>
@endsection