@extends('backend.layouts.main')

@section('content')
<section class="content-header">
    <h1>
        Sửa thông tin Banner <a href="{{route('admin.banner.index')}}" class="btn bg-aqua"><i class="fa fa-list"></i> Danh sách </a>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Thông tin </h3>
                </div>

                <form role="form" action="{{route('admin.banner.update', ['id' => $banner->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tiêu đề</label>
                            <input type="text" name="title" id="title" value="{{$banner->title}}" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ảnh</label>
                                    <input type="file" name="new_image" id="new_image" class="form-control">
                                    <br>
                                    <img src="{{asset($banner->image)}}" alt="Ảnh" width="200" height="120">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Vị trí</label>
                                    <input type="number" name="position" id="position" class="form-control" value="{{($banner->position)}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tùy chỉnh liên kết Url</label>
                            <input type="text" name="url" id="url" class="form-control" value="{{($banner->url)}}">
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="status" id="status" value="1" {{($banner->status == 1) ? 'checked' : ''}}> <strong>Trạng thái hiển thị</strong>
                            </label>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả</label>
                            <textarea name="description" id="editor1" rows="10" class="form-control">{{$banner->description}}</textarea>
                        </div>
                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
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