@extends('backend.layouts.main')

@section('content')
<section class="content-header">
    <h1>
        Thêm Banner <a href="{{route('admin.banner.index')}}" class="btn bg-aqua"><i class="fa fa-list"> Danh sách </i></a>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Thông tin </h3>
                </div>

                <form role="form" action="{{route('admin.banner.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Nhập tiêu đề...">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ảnh</label>
                                    <input type="file" id="image" name="image" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Vị trí</label>
                                    <input type="number" class="form-control" name="position" id="position" value="{{$pos + 1}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tùy chỉnh liên kết URL</label>
                            <input type="text" class="form-control" id="url" name="url" placeholder="Url...">
                        </div>
                        
                            

                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="description" id="editor1" class="form-group" rows="10" placeholder="Enter..."></textarea>
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

@section('script')
    <script type="text/javascript">
        $(function(){
            var _ckeditor = CKEDITOR.replace('editor1', {
                filebrowserBrowseUrl: '{{asset('/backend/plugins/ckfinder/ckfinder.html')}}',
                filebrowserImageBrowseUrl: '{{asset('/backend/plugins/ckfinder/ckfinder.html?type=Images')}}',
                filebrowserFlashBrowseUrl: '{{asset('/backend/plugins/ckfinder/ckfinder.html?type=Flash')}}',
                filebrowserUploadUrl: '{{asset('/backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files')}}',
                filebrowserImageUploadUrl: '{{asset('/backend/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images')}}',
                filebrowserFlashUploadUrl: '{{asset('/backend/plugins/ckfinder/core/connector/php.connector.php?command=QuickUpload&type=Flash')}}'
            });
            _ckeditor.config.height = 200; 
        })
    </script>
@endsection