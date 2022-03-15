@extends('backend.layouts.main')

@section('content')
<section class="content-header">
    <h1>
        Thêm Màu <a href="{{route('admin.color.index')}}" class="btn bg-aqua"><i class="fa fa-list"></i> Danh sách </a>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Thông tin </h3>
                </div>

                <form action="{{route('admin.color.store')}}" role="form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Màu sắc</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Nhập màu...">
                        </div>
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Tạo</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection