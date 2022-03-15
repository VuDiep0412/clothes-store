@extends('backend.layouts.main')

@section('content')
<section class="content-header">
    <h1>
        Sửa thông tin danh mục <a href="{{route('admin.category.index')}}" class="btn bg-aqua"><i class="fa fa-list"></i> Danh sách</a>
    </h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"> Thông tin </h3>
                </div>
                <form action="{{route('admin.category.update', ['id' => $category->id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="box-body">
                        <div class="form-group">
                            <label for="categoryOption">Danh mục cha</label>
                            <select name="parent_id" id="parent_id" class="form-control">
                                <option value="0">--- Chọn ---</option>
                                @foreach($cates as $item)
                                    <option {{($category->parent_id == $item->id) ? 'selected' : ''}} value="{{$item->id}}">{{$item -> name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" value="{{$category->name}}" name="name" id="name" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ảnh</label>
                                    <input type="file" id="new_image" name="new_image" class="form-control">
                                </div>
                                <br>
                                <img src="{{asset($category->image)}}" width="200" alt="">
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Vị trí</label>
                                    <input type="number" class="form-control" name="position" id="position" value="{{$category->position}}">
                                </div>
                            </div>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="status" id="status" value="1" {{($category->status == 1) ? 'checked' : ''}}> <strong>Trạng thái hiển thị</strong>
                            </label>
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