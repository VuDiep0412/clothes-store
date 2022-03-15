@extends('frontend.layouts.main')

@section('content')
<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        @foreach($banner as $ban)
        <div class="hero__items set-bg" style="height: 590px; width:100%;" data-setbg="{{asset($ban->image)}}">
            <!-- <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>{{$ban->title}}</h6>

                            <h2>Fall - Winter Collections 2030</h2>
                            <p>A specialist label creating luxury essentials. Ethically crafted with an unwavering
                                commitment to exceptional quality.</p>
                            <a href="#" class="primary-btn">Shop now <span class="arrow_right"></span></a>

                        </div>
                    </div>
                </div>
            </div> -->
        </div>
        @endforeach
    </div>
</section>
<!-- Hero Section End -->

<!-- Banner Section Begin -->
<section class="banner spad">
    <div class="container">
        <div class="row">
            @foreach($category as $cate)
            <div class="col-lg-3">
                <div class="banner__item banner__item--middle">
                    <div class="banner__item__pic" style="width:500px; height:300px;">
                        <img src="{{asset($cate->image)}}" style="display: block; width:100%; height:100%;" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2 style="font-size: 30px;">{{$cate->name}}</h2>
                        <a href="{{route('cateProduct', $cate->slug)}}">Xem ngay</a>
                    </div>
                </div>
            </div>
            @endforeach
            <!-- <div class="col-lg-5">
                    <div class="banner__item banner__item--middle">
                        <div class="banner__item__pic">
                            <img src="frontend/img/banner/banner-2.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Accessories</h2>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7"> -->
            <!-- <div class="banner__item banner__item--last">
                        <div class="banner__item__pic">
                            <img src="frontend/img/banner/banner-3.jpg" alt="">
                        </div>
                        <div class="banner__item__text">
                            <h2>Shoes Spring 2030</h2>
                            <a href="#">Shop now</a>
                        </div>
                    </div>
                </div> -->
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">

            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter=".mix">Hôm nay có gì?</li>
                    <li data-filter=".featured-product">Nổi bật</li>
                    <li data-filter=".hot-sales">Giảm giá HOT</li>
                </ul>
            </div>

        </div>
        <div class="row product__filter">
            <!-- sp nổi bật-->
            @foreach($featuredPro as $prod)
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix featured-product">
                <div class="product__item sale">
                <a href="{{route('shop.productDetail',$prod['slug'])}}">
                    <div class="product__item__pic set-bg" data-setbg="{{asset($prod->avatar)}}">
                        
                        <span class="label">Nổi bật</span>
                        <!-- <ul class="product__hover">
                            <li><img src="/frontend/img/icon/heart.png" alt=""></li>
                        </ul> -->
                    </div>
                </a>
                    <div class="product__item__text">
                        <h6>{{$prod->name}}</h6>
                        <a href="{{route('shop.productDetail',$prod['slug'])}}" class="add-cart">{{$prod->name}}</a>
                        
                        <h5>{{number_format($prod->price)}}đ</h5>
                        
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Hot sales -->
            @foreach($salePro as $prod)
            <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales">
                <div class="product__item sale">
                <a href="{{route('shop.productDetail',$prod['slug'])}}">
                    <div class="product__item__pic set-bg" data-setbg="{{asset($prod->avatar)}}">
                        
                        <span class="label">Hot Sales</span>
                        <!-- <ul class="product__hover">
                            <li><img src="/frontend/img/icon/heart.png" alt=""></li>
                        </ul> -->
                    </div>
                </a>
                    <div class="product__item__text">
                        <h6>{{$prod->name}}</h6>
                        <a href="{{route('shop.productDetail',$prod['slug'])}}" class="add-cart">{{$prod->name}}</a>
                        
                        <h6><del>{{number_format($prod->price)}}</del>đ</h6>
                        <h5 style="color: red;">{{number_format($prod->sale)}}đ</h5>
                        
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Product Section End -->




<!-- Latest Blog Section Begin -->
<section class="latest spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <a href="{{route('shop.article')}}"><span>Tin tức hàng ngày</span></a>
                    <h2>Fashion In The World</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($article as $news)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{asset($news->image)}}"></div>
                    <div class="blog__item__text">
                        <span><img src="/frontend/img/icon/calendar.png" class="fas fa-calendar-alt" alt=""> {{date('d/m/Y',strtotime($news->created_at)) }}</span>
                        <h5>{{$news->title}}</h5>
                        <a href="{{route('shop.articleDetail',['slug'=>$news->slug])}}">Đọc Thêm</a>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</section>
<!-- Latest Blog Section End -->
@endsection
@section('script')
@parent

@endsection