@extends('frontend.layouts.main')

@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Thanh toán</h4>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="{{route('donhang')}}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 col-md-6">

                        <h6 class="checkout__title">Thông tin chi tiết</h6>
                        <!-- <div class="row"> -->
                        <!-- <div class="col-lg-6"> -->
                        <div class="checkout__input">
                            <p>Họ Tên<span>*</span></p>
                            <input type="text" style="color: black;" name="cus_name" id="cus_name"
                            @if(Auth::check()) value="{{Auth::user()->name}}" @endif>
                        </div>
                        <span class="form_message" style="color: orangered;">{{$errors->first('cus_name')}}</span>
                        <!-- </div> -->
                        <!-- <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Tên<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div> -->
                        <!-- </div> -->

                        <div class="checkout__input">
                            <p>Địa chỉ<span>*</span></p>
                            <input type="text" style="color: black;" id="cus_address" name="cus_address" class="checkout__input__add"
                            @if(Auth::check()) value="{{Auth::user()->address}}" @endif>
                        </div>
                        <span class="form-message" style="color: orangered;">{{$errors->first('cus_address')}}</span>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Số điện thoại<span>*</span></p>
                                    <input type="text" style="color: black;" id="cus_phone" name="cus_phone"
                                    @if(Auth::check()) value="{{Auth::user()->phone}}" @endif>
                                </div>
                                <span class="form-message" style="color: orangered;">{{$errors->first('cus_phone')}}</span>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Email<span>*</span></p>
                                    <input type="text" style="color: black;" id="cus_email" name="cus_email"
                                    @if(Auth::check()) value="{{Auth::user()->email}}" @endif>
                                </div>
                                <span class="form-message" style="color: orangered;">{{$errors->first('cus_email')}}</span>
                            </div>
                        </div>

                        <!-- <div class="checkout__input__checkbox">
                                <label for="diff-acc">
                                    Note about your order, e.g, special noe for delivery
                                    <input type="checkbox" id="diff-acc">
                                    <span class="checkmark"></span>
                                </label>
                            </div> -->
                        <div class="checkout__input">
                            <p>Ghi chú</p>
                            <input type="text" style="color: black;" name="note">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="checkout__order">
                            <h4 class="order__title">Hóa đơn</h4>
                            <div class="checkout__order__products">Sản phẩm <span>Tổng</span></div>
                            @foreach(Cart::content() as $item)
                           
                            <ul class="checkout__total__products">
                                <li> {{$item->name}} x {{$item->qty}}<span> {{number_format(($item->price)*($item->qty))}}đ</span></li>
                                <span>{{$item->options['color']}} - {{$item->options['size']}}</span>
                            
                            </ul>

                            @endforeach
                            <ul class="checkout__total__all">
                                <li>Tổng tiền <span>{{number_format($totalPrice)}}đ</span></li>
                            </ul>
                            <span style="color: red;">Thanh toán khi nhận hàng</span>
                            <br></br>
                            <button type="submit" class="site-btn">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->
@endsection