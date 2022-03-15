@extends('backend.layouts.main')
<!-- @section('css')
<link rel="stylesheet" href="backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection -->
@section('content')
<section class="content-header">
    <h1>
        Danh sách chi tiết sản phẩm
        <a href="{{route('product_detail.create')}}" class="btn bg-aqua"><i class="fa fa-plus"></i> Thêm sản phẩm</a>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header ">
                    <h3 class="box-title"></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">STT</th>
                                <th class="text-center">Sản phẩm (chi tiết)</th>
                                <th class="text-center">Màu sắc</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                        <tbody>
                            @foreach($proDetail as $key => $product_detail)
                            <tr class="item-{{ $product_detail->id }}">
                                <td class="text-center">{{ $key + 1}}</td>
                                <td class="text-center">{{ @$product_detail->name}}</td>
                                <td class="text-center">{{ @$product_detail->color->name }}</td>
                                <td class="text-center">
                                    <span
                                        class="label label-{{ ($product_detail->status == 1) ? 'success' : 'danger' }}">{{ ($product_detail->status == 1) ? 'Hiển thị' : 'Ẩn' }}</span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('product_detail.edit', ['id'=> $product_detail->id]) }}" class="btn  btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <button onclick="deleteItem('product_detail', {{$product_detail->id}})" class="btn btn-danger"><i class="fa fa-trash"></i></button>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <ul class="pagination pagination-sm no-margin">
                        {{--phân trang --}}
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>
@endsection
@section('js')
<script src="backend/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="backend/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
    $('#example1').DataTable();
</script>
@endsection
