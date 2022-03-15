@extends('backend.layouts.main')

@section('content')
<section class="content-header">
    <h1>
        Danh Sách <a href="{{route('admin.product.create')}}" class="btn bg-aqua"><i class="fa fa-plus"></i> Thêm sản phẩm</a>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table class="table table-bordered table-stripped" id="example1">
                        <thead>
                            <tr>
                                <th style="width: 30px;" class="text-center">STT</th>
                                <th class="text-center">Tên sản phẩm</th>
                                <th class="text-center">Ảnh</th>
                                <!-- <th class="text-center">Danh mục</th> -->
                                <th class="text-center">SP nổi bật</th>
                                <th class="text-center">SP giảm giá</th>
                                <th class="text-center">Đơn giá</th>
                                <th style="width: 30px;" class="text-center">Số lượng</th>
                                <th class="text-center">Trạng thái</th>
                                <!-- <th class="text-center">Chi tiết</th> -->
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($product as $key => $item)
                            <tr class="item-{{$item->id}}">
                                <td style="">{{$key + 1}}</td>
                                <td>{{$item->name}}</td>

                                <td>
                                    <img src="{{asset($item->avatar)}}" width="40">
                                </td>
                                <!-- <td>{{$item->category->name}}</td> -->
                                <td>
                                    @if($item->featured == 1)
                                    <span class="label label-success">Hiển thị</span>
                                    @else
                                    <span class="label label-default">Ẩn</span>
                                    @endif
                                </td>
                                <td>
                                    @if($item->best_sale == 1)
                                    <span class="label label-success">Hiển thị</span>
                                    @else
                                    <span class="label label-default">Ẩn</span>
                                    @endif
                                </td>
                                <td>{{number_format($item->price)}}</td>
                                <td>{{$item->quantity}}</td>
                                <td>
                                    @if($item->status == 1)
                                    <span class="label label-success">Hiển thị</span>
                                    @else
                                    <span class="label label-default">Ẩn</span>
                                    @endif
                                </td>
                                
                                <td class="text-center">
                                    <a href="{{route('admin.product_image.create', ['id' =>$item->id])}}" class="btn bg-green"><i class="fa fa-file-image-o"></i></a>

                                    <a href="{{route('admin.product.edit', ['id' => $item->id])}}" class="btn bg-purple"><i class="fa fa-pencil-square"></i></a>
                                    <button onclick="deleteItem('product', {{$item->id}})" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    $(function() {
        $('#example1').DataTable()
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