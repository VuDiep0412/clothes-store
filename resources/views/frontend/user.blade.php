@extends('frontend.layouts.main')

@section('content')
<div class="header" style="text-align: center;">
    <h3><b>Thông tin cá nhân</b></h3>
    <br>
</div>
<div class="container">
    <div class="">
        <form action="{{route('capnhat')}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="checkout__input">
                                <p>Họ Tên<span>*</span></p>
                                <input type="text" name="name" style="color: black;" id="name" value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="checkout__input">
                                <p>Địa chỉ<span>*</span></p>
                                <input type="text" style="color: black;" id="address" name="address" value="{{$user->address}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="checkout__input">
                                <p>Số điện thoại<span>*</span></p>
                                <input style="color: black;" type="text" id="phone" name="phone" value="{{$user->phone}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input type="text" style="color: black;" id="email" name="email" value="{{$user->email}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="checkout__input">
                                <p>Mật khẩu mới</p>
                                <input type="password" style="color: black;" id="new_password" name="new_password">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- <div class="checkout__input"> -->
                                <br><p></p>
                                <button type="submit" class="site-btn">Cập nhật thông tin</button>
                            <!-- </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection