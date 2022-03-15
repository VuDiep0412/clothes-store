@extends('backend.layouts.main')
@section('content')
<section class="content-header">
    <h1>
        Sửa số lượng size
        <a href="{{route('admin.productSize.index')}}" class="btn bg-aqua"><i class="fa fa-list"></i> Danh sách</a>
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
                <form role="form" action="{{route('admin.productSize.update', ['id' => $proSize->id ])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">

                        {{-- đổ dữ liệu danh mục sản phẩm --}}

                        <div class="form-group">
                            <label>Sản phẩm</label>
                            <select class="form-control" name="product_id">
                                <option value="">-- Chọn --</option>

                                @foreach ($product as $prod)
                                <option value="{{ $prod->id }}" {{ ($proSize->product_id == $prod->id) ? 'selected' : '' }}>
                                    {{ $prod->name }}
                                </option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kích cỡ</label>
                            <select class="form-control select2" name="size_id" multiple="multiple" data-placeholder="Chọn kích cỡ" style="width: 100%;">
                                @foreach ($size as $sizes)
                                <option value="{{ $sizes->id }}" {{ ($proSize->size_id == $sizes->id) ? 'selected' : ''}}> {{$sizes->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Số lượng</label>
                            <input type="number" class="form-control" id="number" name="number" placeholder="Số lượng" value="{{ $proSize->number}}">
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Sửa</button>
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