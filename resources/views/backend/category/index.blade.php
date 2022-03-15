@extends('backend.layouts.main')

@section('content')
<section class="content-header">
    <h1>
        Danh sách <a href="{{route('admin.category.create')}}" class="btn bg-aqua"><i class="fa fa-plus"></i> Thêm danh mục </a>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-body table-responsive no-padding">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">STT</th>
                                <th class="text-center">Tên danh mục</th>
                                <th class="text-center">Ảnh</th>
                                <th class="text-center">Danh mục cha</th>
                                <th class="text-center">Vị trí</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $item)
                            <tr class="item-{{$item->id}}">
                                <td class="text-center">{{$key+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>
                                    @if($item->image)
                                    <img src="{{asset($item->image)}}" alt="Image" width="200" height="120">
                                    @endif
                                </td>
                                <td>{{$item->parent->name or ''}}</td>
                                <td class="text-center">{{$item->position}}</td>
                                <td>
                                    @if($item->status == 1)
                                        <span class="label label-success">Hiển thị</span>
                                    @else
                                        <span class="label label-default">Không hiển thị</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{route('admin.category.edit', ['id' => $item->id])}}" class="btn bg-purple"><i class="fa fa-pencil-square"></i></a>
                                    <button onclick="deleteItem('category', {{$item->id}})" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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
    $(function(){
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