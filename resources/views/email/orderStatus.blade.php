<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clothes Store</title>
</head>

<body>
    <h1>Cảm ơn bạn đã đặt hàng tại Clothes Store</h1>
    <p>Đơn hàng của bạn đang được xử lí. Bộ phận bán hàng sẽ liên hệ bạn sớm nhất</p>
    <div style="padding:10px 15px">
        <h4 style="color:#00a65a">THÔNG TIN ĐƠN HÀNG {{$orderId}}</h4>
        <div style="padding:0px 30px">
            <table style="width:100%">
                <tbody>
                    <tr>
                        <td><b>Khách hàng: {{$name}}</b></td>
                        <td><b>Tổng : </b>{{number_format($total)}} đ</td>
                    </tr>
                    <tr>
                        <td><b>Email: </b>{{$email}}</td>
                        <td><b>Số điện thoại: </b> {{$phone}}</td>
                    </tr>
                    <tr>
                        <td><b>Địa chỉ nhận hàng: </b>{{$address}}</td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div style="padding:10px 15px">
        <h4 style="color:#00a65a">CHI TIẾT ĐƠN HÀNG</h4>
        <table style="width:100%;border-collapse:collapse">
            <thead style="color:#ffffff;background:#00a65a;text-align:left">
                <tr style="padding:8px">
                    <th style="padding:8px">Sản phẩm</th>
                    <th style="padding:8px;">Size</th>
                    <th style="padding:8px;">Màu</th>
                    <th style="padding:8px;">Số lượng</th>
                    <th style="padding:8px;">Giá</th>
                    <th style="padding:8px;">Tổng</th>
                </tr>
            </thead>
            <tbody style="text-align:left">
                @foreach($item as $key => $items)
                <tr style="background-color:#eaeaea;border-bottom:1px solid #d4d4d4">
                    <td style="padding:8px;">
                        {{$items->name}}
                    </td>
                    <td style="padding:8px;">
                        {{$items->options['size']}}
                    </td>
                    <td style="padding:8px;">
                        {{$items->options['color']}}
                    </td>
                    <td style="padding:8px;">
                        {{$items->qty}}
                    </td>
                    <td style="padding:8px">
                        {{number_format($items->price) }} đ
                    </td>
                    <td style="padding:8px;">{{number_format(($items->qty)*($items->price))}} đ</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot style="text-align:right">
            </tfoot>
        </table>
</body>

</html>