@extends('backend.layouts.main')

@section('content')
<section class="content-header">
    <h1>
        Danh Sách <a href="{{route('admin.manager.create')}}" class="btn bg-aqua "><i class="fa fa-plus"></i> Thêm </a>
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
                                <!-- <th class="text-center">STT</th> -->
                                <th class="text-center">Họ tên</th>
                                <th class="text-center">Email</th>
                                <!-- <th class="text-center">Password</th> -->
                                <th class="text-center">Avatar</th>
                                <th class="text-center">Phân quyền</th>
                                <th class="text-center">Trạng thái</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $item)
                            <tr class="item-{{$item->id}}">
                                <!-- <td>{{$key+1}}</td> -->
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <!-- <td>{{$item->password}}</td> -->
                                <td>
                                    @if($item->avatar)
                                    <img src="{{asset($item->avatar)}}" alt="Image" width="80">
                                    @endif
                                </td>
                                <td>{{($item->role_id == 1) ? 'Admin' : 'Manager'}}</td>
                                <td>
                                    @if($item->status == 1)
                                    <span class="label label-success">Kích hoạt</span>
                                    @else
                                    <span class="label label-default">Chưa kích hoạt</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{route('admin.manager.edit', ['id'=>$item->id])}}" class="btn bg-purple">
                                        <i class="fa fa-pencil-square"></i>
                                    </a>
                                    <!-- <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteItem('manager',{{$item->id}})" >Xóa</a> -->

                                    <button onclick="deleteItem('manager',{{$item->id}})" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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