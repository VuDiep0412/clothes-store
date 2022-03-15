 <!-- Header Section Begin -->
 <header class="header">
     <div class="header__top">
         <div class="container">
             <div class="row">
                 <div class="col-lg-6 col-md-7">
                     <div class="header__top__left">
                         <p>30 ngày đổi trả hàng</p>
                     </div>
                 </div>
                 <div class="col-lg-6 col-md-5">
                     <div class="header__top__right">
                         @if(Auth::check())
                         <div class="header__top__links">
                             <a href="{{route('thongtin')}}">{{Auth::user()->name}}</a>
                             <a href="{{route('dangxuat')}}">Đăng xuất</a>
                         </div>
                         @else
                         <div class="header__top__links">
                             <a href="{{route('dangnhap')}}">Đăng nhập</a>
                             <a href="{{route('dangky')}}">Đăng ký</a>
                         </div>
                         @endif
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <div class="container">
         <div class="inner-header">
             <div class="row">
                 <div class="col-lg-3 col-md-3">
                     <div class="header__logo">
                         <a href="{{route('shop.index')}}"><img src="/frontend/img/logo3.png" alt=""></a>
                     </div>
                 </div>
                 <div class="col-lg-5 col-md-5">
                     <nav class="header__menu mobile-menu" style="padding-top:40px; font-size: 40px;">
                         <ul>
                             <li class=""><a href="{{route('shop.index')}}">Trang chủ</a></li>
                             <li><a href="{{route('shop.product')}}">Sản phẩm</a></li>

                             <li><a href="{{route('shop.article')}}">Tin tức</a></li>
                             <li><a href="{{route('lienhe')}}">Liên hệ</a></li>
                         </ul>
                     </nav>
                 </div>
                 <div class="col-lg-2 text-right col-md-2" style="padding-top: 55px;">
                     <div class="shop__sidebar__search">
                         <form action="{{route('searchProduct')}}">
                             <input type="text" name="tu-khoa" value="{{ isset($keyword) ? $keyword : '' }}" placeholder="Search...">
                             <button type="submit"><span class="icon_search"></span></button>
                         </form>
                     </div>
                 </div>
                 <div class="col-lg-2  col-md-2">

                     <ul class="nav-right" style="padding-top: 60px;">
                        @if(Auth::check())
                         <li class="heart-icon"><a href="{{route('wishlist.index')}}">
                                 <i class="icon_heart_alt"></i>
                                 <span>{{Auth::user()->wishlist()->count()}}</span>
                             </a>
                         </li>
                         @endif
                         <li class="cart-icon"><a href="{{route('cart')}}">
                                 <i class="icon_bag_alt"></i>
                                 <span>{{Cart::count()}}</span>
                             </a>
                             <div class="cart-hover">
                                 <div class="select-items">
                                     <table>
                                         <tbody>
                                             @foreach(Cart::content() as $item)
                                             <tr>
                                                 <td class="si-pic"><img src="{{$item->options['avatar']}}" alt="" style="width: 90px;"></td>
                                                 <td class="si-text">
                                                     <div class="product-selected">
                                                         <p style="color: black;">
                                                             @if($item->options['best_sale'] == 1)
                                                             {{number_format($item->options['sale'])}} x {{$item->qty}}

                                                             @else
                                                             {{number_format($item->price)}} x {{$item->qty}}

                                                             @endif
                                                         </p>
                                                         <h6>{{$item->name}}</h6>
                                                     </div>
                                                 </td>
                                                 <td class="si-close">
                                                     <a href="{{route('removeToCart',[$item->rowId])}}"><i class="ti-close"></i></a>
                                                 </td>
                                             </tr>
                                             @endforeach
                                         </tbody>
                                     </table>
                                 </div>
                                 <!-- <div class="select-total" >
                                     <span style="color: black;">Tổng:</span>
                                     <h5 style="color: black;">₫120.00</h5>
                                 </div> -->
                                 @if(Cart::count() == 0)
                                <h6 style="color:orangered; text-align: center;">Chưa có sản phẩm trong giỏ hàng</h6>
                                <h6 style="color: orangered; text-align: center;">Hãy mua sắm thêm</h6>
                                 @else
                                 <div class="select-button">
                                     <a href="{{route('cart')}}" class="primary-btn view-card">Xem đơn hàng</a>
                                     <a href="{{route('order')}}" class="primary-btn checkout-btn">Thanh toán</a>
                                 </div>
                                 @endif
                             </div>
                         </li>
                     </ul>
                     <!-- </div> -->
                 </div>
             </div>
             <div class="canvas__open"><i class="fa fa-bars"></i></div>
         </div>
     </div>
 </header>
 <!-- Header Section End -->