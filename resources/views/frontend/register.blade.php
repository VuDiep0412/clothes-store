@extends('frontend.layouts.main')

@section('content')
<div class="header" style="text-align: center;">
    <h3><b>Đăng ký</b></h3>
    @if (session('msg'))
    <div class="form-group" style="font-size: 15px; padding-bottom: 10px; color: #9ad717">
        <div class="alert alert-success alert-dismissible" style="text-align: center; padding-left: 4rem;" id="thongbao">
            {{ session('msg') }}
        </div>
    </div>
    @endif
</div>
<div class="container">
    <form action="{{route('register')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-4 col-md-4" style="margin-left: 400px;">
                <div class="form-group">
                    <label for="name"><b>Họ tên *</b></label>
                    <input type="text" name="name" id="name" class="form-control">
                    <span class="form-message">{{$errors->first('name')}}</span>
                </div>
                <div class="form-group">
                    <label for="email"><b>Email *</b></label>
                    <input type="text" name="email" id="email" class="form-control">
                    <span class="form-message">{{$errors->first('email')}}</span>
                </div>
                <div class="form-group">
                    <label for="password"><b>Mật khẩu *</b></label>
                    <input type="password" name="password" id="password" class="form-control">
                    <span class="form-message">{{$errors->first('password')}}</span>
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="form-control btn btn-primary">Đăng ký</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection