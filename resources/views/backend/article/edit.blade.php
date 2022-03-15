@extends('backend.layouts.main');

@section('content')
<section class="content-header">
    <h1>
        Chỉnh sửa tin tức <a href="{{route('admin.article.index')}}" class="btn bg-aqua"><i class="fa fa-list"></i> Danh sách</a>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Thông tin </h3>
                </div>

                <form action="{{route('admin.article.update', ['id' => $article->id])}}" role="form" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tiêu đề tin tức</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{$article -> title}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Ảnh</label>
                            <input type="file" name="new_image" id="new_image" class="form-control">
                            <br>
                            <img src="{{asset($article->image)}}" alt="" width="200">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="option">Loại</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="0">--- Chọn ---</option>
                                        <option value="1" {{($article->type == '1') ? 'selected' : ''}}>Trong nước</option>
                                        <option value="2" {{($article->type == '2') ? 'selected' : ''}}>Quốc tế</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Vị trí</label>
                                    <input type="number" name="position" id="position" class="form-control" value="{{$article->position}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả ngắn</label>
                            <input type="text" name="description" id="description" class="form-control" value="{{$article->description}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả chi tiết</label>
                            <textarea name="content" id="editor1" class="form-control" rows="10">{{$article->content}}</textarea>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="status" id="status" value="1" {{($article->status == 1) ? 'checked' : ''}}><strong>Trạng thái hiển thị</strong>
                            </label>
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