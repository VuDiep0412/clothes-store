@extends('frontend.layouts.main')

@section('content')
<style>
    .scrolling_inner {
        position: relative;
        margin-top: -30px;
    }

    .box03 {
        margin-bottom: 10px;
    }

    .box03_item {
        border: 1px solid #e0e0e0;
        border-radius: 2px;
        color: #333;
        display: inline-block;
        font-size: 15px;
        min-width: 100px;
        padding: 0 15px;
        text-align: center;
        margin right: 2px;
        vertical-align: top;
        height: 36px;
        line-height: 36px;
        position: relative;
    }

    .box03_item.act {
        border-color: #2f80ed;
        color: #2f80ed;
    }

    .size {
        margin-top: -30px;
        margin-bottom: 10px;
        margin-left: 60px;
    }
</style>
<!-- Shop Details Section Begin -->
<section class="shop-details">
    <div class="product__details__pic">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <a href="./index.html">Trang chủ</a>
                        <a href="./shop.html">Sản phẩm</a>
                        <span>Chi tiết sản phẩm</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            @foreach($proDetail->product_image as $img)
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">
                                <div class="product__thumb__pic set-bg" data-setbg="{{asset($img->image)}}">
                                </div>
                            </a>
                            @endforeach
                        </li>
                    </ul>
                </div>
                <div class="col-lg-6 col-md-9">
                    <div class="tab-content">
                        @foreach($productAvt as $img)
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__pic__item">
                                <img src="{{asset($img->avatar)}}" alt="" style="width: 400px;">
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="product__details__content">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-8">
                    <div class="product__details__text">
                        <h4>{{$proDetail->name}}</h4>
                        <h3>
                            @if($proDetail->best_sale==1)
                            <del style="color: red;">{{number_format($proDetail->price)}}đ</del>
                            <br>
                            {{number_format($proDetail->sale)}}đ
                            @else
                            {{number_format($proDetail->price)}}đ
                            @endif<span></span>
                        </h3>
                        <form action="{{route('addToCart',['id' => $proDetail->id])}}" method="post">
                            @csrf
                            <input type="hidden" id="" name="id" value="{{$proDetail->id}}">
                            <div class="row justify-content-center">
                                <div class="col-lg-12">
                                    <p><b>Màu sắc:</b></p>
                                    <div class="scrolling_inner">
                                        @foreach($proColor as $key => $item)
                                        <label class="btn active border" style="font-weight: 600;">
                                            <input type="radio" name="color" id="option1" required value="{{$item->name}}"> {{$item->name}}
                                        </label>
                                        @endforeach
                                    </div>
                                    <!-- <div class="col-lg-12"> -->
                                    <p><b>Kích cỡ:</b></p>
                                    <div class="scrolling_inner">
                                        @foreach($proSize as $key => $item)
                                        <label class="btn active border" style="font-weight: 600;">
                                            <input type="radio" name="size" id="option2" required value="{{$item->name}}"> Size: {{$item->name}}
                                        </label>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{session('success')}}
                            </div>
                            @endif
                            @if(session('warning'))
                            <div class="alert alert-danger" role="alert">
                                {{session('warning')}}
                            </div>
                            @endif
                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" name="qty" value="1" max="{{$proDetail->quantity}}">
                                    </div>
                                </div>
                                @if(($proDetail->quantity) == 0)
                                <button class="primary-btn" type="submit" disabled>Thêm vào giỏ</button>
                                <span style="color: red;"><b>Sản phẩm hết hàng</b></span>
                                @else
                                <button class="primary-btn" type="submit">Thêm vào giỏ</button>
                                @endif
                            </div>
                        </form>
                        <div class="product__details__btns__option">
                            <form action="{{route('wishlist.store')}}" method="post">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <input type="hidden" name="product_id" value="{{$proDetail->id}}">
                                <button class="primary-btn" type="submit">Yêu thích</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab" style="color: black;">Mô tả sản phẩm</a>
                            </li>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                <div class="product__details__tab__content" style="text-align: center; padding-top:0%">
                                    <p class="note">{!!$proDetail->content!!}</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Details Section End -->

<!-- Related Section Begin -->
<!-- <section class="related spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="related-title">Sản phẩm tương tự</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item sale">
                    <a href="#">
                        <div class="product__item__pic set-bg" data-setbg="/frontend/img/productCopy/p3.jpg">
                            <span class="label">nổi bật</span>
                            <ul class="product__hover">
                                <li>><img src="/frontend/img/icon/heart.png" alt=""></li>
                            </ul>
                        </div>
                    </a>
                    <div class="product__item__text">
                        <h6>Áo Sơ Mi Nam Kẻ Sọc Có Túi</h6>
                        <a href="#" class="add-cart">+ Thêm vào giỏ hàng</a>

                        <h5>469000đ </h5>
                        <div class="product__color__select">
                            <label for="pc-1">
                                <input type="radio" id="pc-1">
                            </label>
                            <label class="active black" for="pc-2">
                                <input type="radio" id="pc-2">
                            </label>
                            <label class="grey" for="pc-3">
                                <input type="radio" id="pc-3">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item sale">
                    <a href="#">
                        <div class="product__item__pic set-bg" data-setbg="/frontend/img/productCopy/p10.jpg">
                            <span class="label">nổi bật</span>
                            <ul class="product__hover">
                                <li>><img src="/frontend/img/icon/heart.png" alt=""></li>
                            </ul>
                        </div>
                    </a>
                    <div class="product__item__text">
                        <h6>Quần Jean Nam Ống Suông Xước Nhẹ</h6>
                        <a href="#" class="add-cart">+ Thêm vào giỏ hàng</a>

                        <h5>499000đ </h5>
                        <div class="product__color__select">
                            <label for="pc-1">
                                <input type="radio" id="pc-1">
                            </label>
                            <label class="active black" for="pc-2">
                                <input type="radio" id="pc-2">
                            </label>
                            <label class="grey" for="pc-3">
                                <input type="radio" id="pc-3">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item sale">
                    <a href="#">
                        <div class="product__item__pic set-bg" data-setbg="/frontend/img/productCopy/p13.jpg">
                            <span class="label">nổi bật</span>
                            <ul class="product__hover">
                                <li>><img src="/frontend/img/icon/heart.png" alt=""></li>
                            </ul>
                        </div>
                    </a>
                    <div class="product__item__text">
                        <h6>Áo Sơ Mi Nữ Tay Dài Xoắn Ngực</h6>
                        <a href="#" class="add-cart">+ Thêm vào giỏ hàng</a>

                        <h5>389000đ </h5>
                        <div class="product__color__select">
                            <label for="pc-1">
                                <input type="radio" id="pc-1">
                            </label>
                            <label class="active black" for="pc-2">
                                <input type="radio" id="pc-2">
                            </label>
                            <label class="grey" for="pc-3">
                                <input type="radio" id="pc-3">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                <div class="product__item sale">
                    <a href="#">
                        <div class="product__item__pic set-bg" data-setbg="/frontend/img/productCopy/p15.jpg">
                            <span class="label">nổi bật</span>
                            <ul class="product__hover">
                                <li>><img src="/frontend/img/icon/heart.png" alt=""></li>
                            </ul>
                        </div>
                    </a>
                    <div class="product__item__text">
                        <h6>Quần Jean Nữ Dáng Skinny Trơn</h6>
                        <a href="#" class="add-cart">+ Thêm vào giỏ hàng</a>

                        <h5>429000đ </h5>
                        <div class="product__color__select">
                            <label for="pc-1">
                                <input type="radio" id="pc-1">
                            </label>
                            <label class="active black" for="pc-2">
                                <input type="radio" id="pc-2">
                            </label>
                            <label class="grey" for="pc-3">
                                <input type="radio" id="pc-3">
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- Related Section End -->
@endsection