@extends('backend.layouts.main')

@section('content')
    <section class="content-header">
        <h1>
            Phân quyền  <a href="{{route('role.index')}}" class="btn btn-success align-right"> <i class="fa fa-list"></i> Danh Sách </a>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->

                <div class="box box-primary">
                    <form role="form" action="{{route('role.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Quyền</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="">
                            </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Tạo</button>
                        </div>
                    </form>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (right) -->
        </div>
        <!-- /.row -->
    </section>
@endsection
