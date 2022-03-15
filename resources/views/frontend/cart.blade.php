@extends('frontend.layouts.main')

@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Chi tiết giỏ hàng</h4>

                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shopping Cart Section Begin -->
@if(count(Cart::content()))
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th></th>
                                <th>Số lượng</th>

                                <!-- <th>Tổng</th> -->
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $item)
                            <tr class="quantity_full">
                                <td class="product__cart__item">
                                    <div class="product__cart__item__pic">
                                        <img src="{{$item->options['avatar']}}" style="width: 100px;" alt="">
                                    </div>
                                    <div class="product__cart__item__text">
                                        <h6>{{$item->name}} <br><br> {{$item->options['color']}} - {{$item->options['size']}}</h6>

                                        <h6>
                                            @if($item->options['best_sale'] == 1)
                                            {{number_format($item->options['sale'])}}đ
                                            @else
                                            {{number_format($item->price)}}đ
                                            @endif
                                        </h6>
                                    </div>
                                </td>
                                <td class="cart__price"></td>
                                <td class="quantity__item">
                                    <div class="quantity">
                                        <div class="pro-qty-2">
                                            <input id="{{$item->rowId}}" class="item-qty" type="text" value="{{$item->qty}}">
                                        </div>
                                    </div>
                                </td>

                                <!-- <td class="cart__price">
                                    @if($item->options['best_sale'] == 1)
                                    {{number_format($item->options['sale'])}}đ
                                    @else
                                    {{number_format($item->price)}}đ
                                    @endif
                                </td> -->
                                <td class="cart__close">
                                    <a data-id="{{$item->rowId}}" class="update-qty" href="javascript:void(0)"><i class="fa fa-repeat"></i></a>
                                    <a href="{{route('removeToCart', [$item->rowId])}}"><i class="fa fa-close"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="{{route('shop.product')}}">Mua thêm</a>
                        </div>
                    </div>
                    <!-- <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i>Cập nhật hóa đơn</a>
                            </div>
                        </div> -->
                </div>
            </div>
            <div class="col-lg-3">
                <div class="cart__total">
                    <h6>Tổng hoá đơn</h6>
                    <ul>
                        <li class="subTotal1">Tạm tính <span style="color: black;">{{($totalPrice)}}đ</span></li>
                        <li>Phí vận chuyển <span style="color: black;">--</span></li>
                        <li class="subTotal2">Tổng tiền<span>{{$totalPrice}}đ</span></li>
                    </ul>

                    <a href="{{route('order')}}" class="primary-btn">Hoàn tất hóa đơn</a>
                </div>
            </div>
        </div>
    </div>
</section>
@section('my_javascript')
<script type="text/javascript">
    $(function() {
        // cập nhật số lượng của từng sản phẩm trong giỏ hàng
        $(document).on("click", '.update-qty', function(e) {
            var rowId = $(this).attr('data-id');
            var qty = $(this).closest('.quantity_full').find('.item-qty').val(); // lấy số lượng của ô input
            // console.log(qty)
            // Kiểm tra Nếu không phải là số nguyên Hoặc số lượng < 1
            if (isNaN(qty) || qty < 1) {
                alert("Số lượng là số nguyên lớn hơn >= 1");
                $(this).closest('.quantity_full').find('.item-qty').val(1);
                return false;
            }

            $.ajax({
                url: '/gio-hang/cap-nhat-so-luong-sp',
                type: 'get',
                data: {
                    rowId: rowId,
                    qty: qty
                }, // dữ liệu truyền sang nếu có
                dataType: "HTML", // kiểu dữ liệu trả về
                success: function(response) {
                    data = JSON.parse(response);
                    // console.log(data.totalPrice)
                    $('.subTotal1 > span').text(data.totalPrice + " đ");
                    $('.subTotal2 > span').text(data.totalPrice + " đ");
                    alert('Giỏ hàng đã được cập nhật');

                    // $(this).closest('.shopping-cart').find('.subTotal1').text = data.totalPrice + " đ"
                },
                error: function(xhr, status, error) { // lỗi nếu có
                    var err = JSON.parse(xhr.responseText);
                    // console.log(err);
                    alert(err.msg);
                    $('#' + rowId).val(err.qty);
                }
            });
        });
    })
</script>
@endsection
@else
<style>
    .buyother {
        display: block;
        overflow: hidden;
        background: #fff;
        line-height: 40px;
        text-align: center;
        margin: 15px auto;
        width: 300px;
        font-size: 14px;
        color: black;
        font-weight: 700;
        text-transform: uppercase;
        border: 2px solid black;
        border-radius: 5px;
    }
</style><br>
<div class="content">
    <h3 class="text-center" style="font-size: 25px; color: black">Bạn chưa có sản phẩm nào trong giỏ hàng</h3>
</div>
<a href="/" class="buyother"><i class="fa fa-chevron-left"></i> Về trang chủ</a>
@endif
<!-- Shopping Cart Section End -->

@endsection