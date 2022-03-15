@extends('backend.layouts.main')
@section('content')
<section class="content-header">
    <h1>
        Sửa màu
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
                <form role="form" action="{{route('admin.productColor.update', ['id' => $proSize->id ])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">

                        {{-- đổ dữ liệu danh mục sản phẩm --}}

                        <div class="form-group">
                            <label>Sản phẩm</label>
                            <select class="form-control" name="productDetail_id">
                                <option value="">-- Chọn --</option>

                                @foreach ($proDetail as $productDetail)
                                <option value="{{ $productDetail->id }}" {{ ($proSize->product_id == $productDetail->id) ? 'selected' : '' }}>
                                    {{ $productDetail->name }}
                                </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Màu</label>
                            <select class="form-control select2" name="size_id" multiple="multiple" data-placeholder="Chọn kích cỡ" style="width: 100%;">
                                @foreach ($color as $colors)
                                <option value="{{ $colors->id }}" {{ ($proSize->color_id == $colors->id) ? 'selected' : ''}}> {{$colors->name }}</option>
                                @endforeach
                            </select>
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
<script src="backend/bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('.select2').select2();
    });
</script>
@endsection