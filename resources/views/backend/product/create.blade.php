@extends('backend.layouts.main')

@section('content')
<section class="content-header">
    <h1>
        Thêm sản phẩm <a href="{{route('admin.product.index')}}" class="btn bg-aqua"><i class="fa fa-list"></i> Danh sách</a>
    </h1>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Thông tin </h3>
                </div>

                <form action="{{route('admin.product.store')}}" role="form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label>Tên sản phẩm</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Tên sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="">Danh mục</label>
                            <select name="category_id" class="form-control">
                                <option value="select">-- Chọn danh mục --</option>
                                @foreach($category as $cate)
                                <option value="{{$cate -> id}}">{{$cate -> name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Ảnh sản phẩm</label>
                                    <input type="file" name="avatar" id="avatar">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Màu sắc</label>
                                    <select class="form-control select2" name="color_id[]" multiple="multiple" data-placeholder="Chọn màu sắc" style="width: 100%;">
                                        <!-- <option value="">-- Chọn --</option> -->
                                        @foreach ($color as $colors)
                                        <option value="{{ $colors->id }}">{{ $colors->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Kích cỡ</label>
                                    <select class="form-control select2" name="size_id[]" multiple="multiple" data-placeholder="Chọn kích cỡ" style="width: 100%;">
                                        @foreach ($size as $sizes)
                                        <option value="{{ $sizes->id }}">{{$sizes->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Đơn giá</label>
                                    <input type="text" name="price" id="price" class="form-control" placeholder="Đơn giá">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Giá KM</label>
                                    <input type="text" name="sale" id="sale" class="form-control" placeholder="Giá KM">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Số lượng</label>
                                    <input type="text" name="quantity" id="quantity" class="form-control" placeholder="Số lượng">
                                </div>
                            </div>
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Số lượng bán</label>
                                    <input type="text" name="quantity_sold" id="quantity_sold" class="form-control" placeholder="Số lượng bán">
                                </div>
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="featured">
                                        Sản phẩm nổi bật
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="best_sale">
                                        Sản phẩm giảm giá
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="content" id="editor1" class="form-group" rows="10" placeholder="Enter..."></textarea>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="status" id="status" value="1"><strong>Trạng thái hiển thị</strong>
                            </label>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Tạo</button>
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
@section('script')
<script type="text/javascript">
    $(function() {
        var _ckeditor = CKEDITOR.replace('editor1', {
            filebrowserBrowseUrl: '{{asset(' / backend / plugins / ckfinder / ckfinder.html ')}}',
            filebrowserImageBrowseUrl: '{{asset(' / backend / plugins / ckfinder / ckfinder.html ? type = Images ')}}',
            filebrowserFlashBrowseUrl: '{{asset(' / backend / plugins / ckfinder / ckfinder.html ? type = Flash ')}}',
            filebrowserUploadUrl: '{{asset(' / backend / plugins / ckfinder / core / connector / php / connector.php ? command = QuickUpload & type = Files ')}}',
            filebrowserImageUploadUrl: '{{asset(' / backend / plugins / ckfinder / core / connector / php / connector.php ? command = QuickUpload & type = Images ')}}',
            filebrowserFlashUploadUrl: '{{asset(' / backend / plugins / ckfinder / core / connector / php.connector.php ? command = QuickUpload & type = Flash ')}}'
        });
        _ckeditor.config.height = 200;
    })
</script>
@endsection