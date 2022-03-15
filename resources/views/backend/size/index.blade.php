@extends('backend.layouts.main')

@section('content')
<section class="content-header">
    <h1>
        Danh sách <a href="{{route('admin.size.create')}}" class="btn bg-aqua"><i class="fa fa-plus"></i> Thêm Kích cỡ </a>
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
                                <th class="text-center">Kích cỡ</th>
                                <th class="text-center">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $key => $item)
                            <tr class="item-{{$item->id}}">
                                <td class="text-center">{{$key+1}}</td>
                                <td class="text-center">{{$item->name}}</td>
                                <td class="text-center">
                                    <button onclick="deleteItem('size', {{$item->id}})" class="btn btn-danger"><i class="fa fa-trash"></i></button>
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