@extends('frontend.layouts.main')

@section('content')
<!-- Blog Details Hero Begin -->
<section class="blog-hero spad" style="height: 20px;">
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-9 text-center">
                <div class="blog__hero__text" >
                    <h2>{{$article->title}}</h2>
                    <ul>
                        <!-- <li>By Deercreative</li> -->
                        <li>{{date('d/m/Y',strtotime($article->created_at)) }}</li>
                        <!-- <li>8 Comments</li> -->
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Blog Details Hero End -->

<!-- Blog Details Section Begin -->
<section class="blog-details spad" style="margin-top: 20px;">
    <div class="container">

        <div class="row d-flex justify-content-center">
            <!-- <div class="col-lg-12">
                    <div class="blog__details__pic">
                        <img src="{{asset($article->image)}}" alt="">
                    </div>
                </div> -->
            <div class="col-lg-8">
                <div class="blog__details__content">
                    <div class="blog__details__share">
                        <span>share</span>
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#" class="youtube"><i class="fa fa-youtube-play"></i></a></li>
                            <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                    </div>
                    <div class="blog__details__text">
                        <br>
                        <p>{!!$article->content!!}</p>

                    </div>
                    
                </div>
            </div>
        </div>
        <div style="font: 2em sans-serif; text-align: center;">
            <a href="{{route('shop.article')}}"><i class="fa fa-angle-double-left" style="color: black;" aria-hidden="false"> Trở lại</i></a>
        </div>
    </div>
</section>
<!-- Blog Details Section End -->
@endsection