@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Danh Sách <a href="{{route('role.create')}}" class="btn bg-aqua"><i class="fa fa-plus"></i> Thêm </a>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
   <!--                       </tbody>

                            @foreach($data as $key => $item)
                                <tr class="item-{{$item->id}}">
                                    <td>{{$key+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td class="text-center">

                                        <a href="javascript:void(0)" class="btn btn-danger" onclick="deleteItem('role',{{$item->id}})" >Xóa</a>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>

                </div>-->
<!-- /.box -->
                <div class="box">
                    <div class="box-body table-responsive no-padding">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead >
                            <tr>
                                <!-- <th class="text-center">STT</th> -->
                                <th class="text-center">Quyền</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $item)
                            <tr class="item-{{$item->id}}">
                                <!-- <td>{{$key+1}}</td> -->
                                <td>{{$item->name}}</td>
                                <td class="text-center">
                                    <!-- Thêm sự kiện onlick cho nút xóa -->
                                    <a href="javascript:void(0)" class="btn btn-danger"
                                       onclick="deleteItem('role',{{$item->id}})">Xóa</a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
@endsection
@section('script')
    <script>
        $(function () {
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
