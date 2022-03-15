@extends('backend.layouts.main')
@section('css')
<link rel="stylesheet" href="/backend/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endsection
@section('content')
<section class="content-header">
    <h1>
        Sửa chi tiết sản phẩm
        <a href="{{route('product_detail.index')}}" class="btn bg-aqua"><i class="fa fa-list"></i> Danh sách</a>
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
                <form role="form" method="post" enctype="multipart/form-data" action="{{ route('product_detail.update',['id'=>$product_detail->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group">
                            <label>Tên chi tiết sản phẩm</label>
                            <input type="text" class="form-control" value="{{$product_detail->name}}" id="name" name="name" placeholder="Nhập tên chi tiết">
                        </div>
                        <div class="form-group">
                            <label>Sản phẩm</label>
                            <select class="form-control" name="product_id">
                                <option value="">-- Chọn --</option>
                                @foreach ($product as $prod)
                                <option value="{{ $prod->id }}" {{ ($product_detail->product_id == $prod->id) ? 'selected' : '' }}>{{ $prod->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Màu sắc</label>
                            <select class="form-control select2" name="color_id">
                                <option value="">-- Chọn --</option>
                                @foreach ($color as $colors)
                                <option value="{{ $colors->id }}" {{ ($product_detail->color_id == $colors->id) ? 'selected' : '' }}>{{ $colors->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Kích cỡ</label>
                            <select class="form-control select2" name="size_id[]" multiple="multiple" data-placeholder="Chọn kích cỡ" style="width: 100%;">
                                @foreach ($size as $sizes)
                                    <option value="{{ $sizes->id }}" 
                                        @foreach ($product_detail->size as $item)
                                            {{ ($item->id == $sizes->id) ? 'selected' : ''}}
                                        @endforeach
                                        > {{$sizes->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Giá bán</label>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Giá bán" value="{{$product_detail->price}}">
                        </div>
                        <div class="form-group">
                            <label>Số lượng</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Số lượng" value="{{$product_detail->quantity}}">
                        </div>
                        <div class="form-group">
                            <label>Số lượng bán</label>
                            <input type="number" class="form-control" id="quantity_sold" name="quantity_sold" placeholder="Số lượng bán" value="{{$product_detail->quantity_sold}}">
                        </div>
                        <div class="form-group">
                            <label>Giảm giá</label>
                            <input type="number" class="form-control" id="sale" name="sale" placeholder="Giảm giá" value="{{$product_detail->sale}}">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"  name="status" {{ ($product_detail->status == 1) ? 'checked' : '' }}> Trạng thái hoạt động
                            </label>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
<!-- Select2 -->
<script src="/backend/bower_components/select2/dist/js/select2.full.min.js"></script>
<script type="text/javascript">
    $(function() {
        $('.select2').select2();
    });
</script>
@endsection