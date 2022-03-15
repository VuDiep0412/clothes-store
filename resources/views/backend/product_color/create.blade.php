@extends('backend.layouts.main')
@section('content')
<section class="content-header">
    <h1>
        Thêm màu
        <a href="{{route('admin.productColor.index')}}" class="btn bg-aqua"><i class="fa fa-list"></i> Danh sách</a>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Thông tin chung</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" method="POST" enctype="multipart/form-data" action="{{ route('admin.productColor.store') }}">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label>Sản phẩm</label>
                            <select class="form-control" name="product_id">
                                <option value="">-- Chọn --</option>

                                @foreach ($proDetail as $productDetail)
                                <option value="{{ $productDetail->id }}">{{ $productDetail->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Màu</label>
                            <select class="form-control" name="size_id">
                                <option value="">-- Chọn --</option>

                                @foreach ($color as $colors)
                                <option value="{{ $colors->id }}">{{ $colors->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Tạo</button>
                    </div>
                </form>
            </div>
        </div>
</section>

@endsection

@section('js')
<!-- Select2 -->
<script type="text/javascript">
    $(function() {
        // $('.select2').select2();

        // setup textarea sử dụng plugin CKeditor
        var _ckeditor = CKEDITOR.replace('summary');
        _ckeditor.config.height = 200; // thiết lập chiều cao
        var _ckeditor = CKEDITOR.replace('description');
        _ckeditor.config.height = 500; // thiết lập chiều cao
    });
</script>
@endsection