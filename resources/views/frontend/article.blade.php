@extends('frontend.layouts.main')

@section('content')

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-blog set-bg" data-setbg="frontend/img/breadcrumb-bg.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>Our Blog</h2>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Blog Section Begin -->
<section class="blog spad">
    <div class="container">
        <div class="row">
            @foreach($article as $art)
            <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="blog__item">
                    <div class="blog__item__pic set-bg" data-setbg="{{asset($art->image)}}"></div>
                    <div class="blog__item__text">
                        <span><img src="frontend/img/icon/calendar.png" class="fas fa-calendar-alt" alt="">{{date('d/m/Y',strtotime($art->created_at)) }}</span>
                        <h5>{{$art->title}}</h5>
                        <a href="{{route('shop.articleDetail',['slug' => $art->slug])}}">Đọc Thêm</a>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
    </div>
</section>
<!-- Blog Section End -->

@endsection