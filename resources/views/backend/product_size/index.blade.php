@extends('backend.layouts.main')
<!-- @section('css')
<link rel="stylesheet" href="backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection -->
@section('content')
<section class="content-header">
    <h1>
        Danh Sách <a href="{{route('admin.productSize.create')}}" class="btn bg-aqua"><i class="fa fa-plus"></i> Thêm mới</a>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">STT</th>
                                <th class="text-center">Tên sản phẩm</th>
                                <th class="text-center">Tên size</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <!-- Lặp một mảng dữ liệu pass sang view để hiển thị -->
                        <tbody>
                            @foreach($proSize as $key => $productSize)
                            <tr class="item-{{ $productSize->id }}">
                                <td class="text-center">{{ $key + 1}}</td>
                                <td class="text-center">{{ @$productSize->product->name }}</td>
                                <td class="text-center">{{ $productSize->size->name }}</td>
                                <td class="text-center">{{ $productSize->number }}</td>
                                <td class="text-center">
                                <a href="{{route('admin.productSize.edit', ['id'=>$productSize->id])}}" class="btn bg-purple">
                                        <i class="fa fa-pencil-square"></i>
                                    </a>
                                    <button onclick="deleteItem('product_size', {{$productSize->id}})" class="btn btn-danger"><i class="fa fa-trash"></i></button>

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
                        {{-- {{ $banners->links() }} --}}
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