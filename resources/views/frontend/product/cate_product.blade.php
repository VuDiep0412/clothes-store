@extends('frontend.layouts.main')

@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Sản phẩm</h4>
                    <div class="breadcrumb__links">
                        <a href="{{route('shop.index')}}">Trang chủ</a>
                        <a href="{{route('shop.product')}}">Sản phẩm</a>
                        
                        @foreach($category as $cate)
                        <span>{{$cate->name}}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                   
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Danh mục</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">

                                            <ul class="nice-scroll">
                                                @foreach($categories as $cate)

                                                <li><a href="{{route('cateProduct', $cate ->slug)}}">{{$cate->name}}</a></li>
                                                @endforeach

                                            </ul>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseThree">Phân loại giá</a>
                                </div>
                                <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__price">
                                            <ul>
                                                <li><a href="?price=1">0 - 200.000</a></li>
                                                <li><a href="?price=2">200.000 - 500.000</a></li>
                                                <li><a href="?price=3">500.000 - 1.000.000</a></li>
                                                <li><a href="?price=4">> 1.000.000</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <!-- <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">

                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Showing 1–12 of 126 results</p>
                            </div>
                        </div>
                    </div>
                </div> -->

                <div class="row">
                    @foreach($product as $prod)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item sale">
                            <a href="{{route('shop.productDetail',$prod['slug'])}}">
                                <div class="product__item__pic set-bg" data-setbg="{{asset($prod->avatar)}}">
                                    @if($prod->featured==1)
                                    <span class="label">Nổi bật</span>
                                    @elseif($prod->best_sale==1)
                                    <span class="label">Giảm giá</span>
                                    @endif
                                    
                                </div>
                            </a>
                            <div class="product__item__text">
                                <h6>{{$prod->name}}</h6>
                                <a href="{{route('shop.productDetail',$prod['slug'])}}" class="add-cart">{{$prod->name}}</a>
                                <h5>
                                    @if($prod->best_sale==1)
                                    <del style="color: red;">{{number_format($prod->price)}}đ</del>
                                    <br>
                                    {{number_format($prod->sale)}}đ
                                    @else
                                    {{number_format($prod->price)}}đ
                                    @endif
                                </h5>

                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <!-- <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination">
                            <a class="active" href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <span>...</span>
                            <a href="#">21</a>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->
@endsection