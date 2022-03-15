@extends('frontend.layouts.main')

@section('content')
  
  <!-- Map Begin -->
   <div class="map">
   <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14898.760738455712!2d105.9230089187622!3d21.00505267291286!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135a94c1f882977%3A0x6d016e6656923f46!2zSOG7jWMgdmnhu4duIE7DtG5nIG5naGnhu4dwIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1638068382793!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>
    <!-- Map End -->

    <!-- Contact Section Begin -->
    <section class="contact spad" style=" padding-top: 10px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Thông tin</span>
                            <h2>Liên hệ với chúng tôi</h2>
                            <!-- <p>As you might expect of a company that began as a high-end interiors contractor, we pay
                                strict attention.</p> -->
                            @if(session('msg'))
                                <div class="form-group has-feedback"><a href="#" style="color: orangered;">{{session('msg')}}</a></div>
                            @endif
                        </div>
                        <ul>
                            <li>
                                <h4>Hà Nội</h4>
                                <p>Thị trấn Trâu Quỳ - Gia Lâm - HN <br />0123456789</p>
                            </li>
                        
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form action="{{route('shop.postContact')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row" style="color: black;">
                                <div class="col-lg-6">
                                    <input type="text" name="name" placeholder="Họ tên" style="color: black;">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="address" placeholder="Địa chỉ" style="color: black;">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="email" placeholder="Email" style="color: black;">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="phone" placeholder="Sđt" style="color: black;">
                                </div>
                                <div class="col-lg-12">
                                    <textarea name="content" placeholder="Nội dung" style="color: black;"></textarea>
                                    <button type="submit" id="btnSend" class="site-btn">Gửi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

@endsection


