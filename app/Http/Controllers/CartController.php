<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use App\Product;
use App\Setting;
use Exception;
use Gloudemans\Shoppingcart\Cart as ShoppingcartCart;
use Hamcrest\Core\Set;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    //

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $cart = Cart::content();

        // dd($cart);

        $products = DB::table('products')->get()->first();
        // dd($products);
        $carts = Cart::content();
        foreach ($carts as $item) {
            $product = Product::where([['id', '=', $item->id]])->first();
            if (is_object($product) && $product->sale > 0) {
                Cart::update($item->rowId, [
                    'price' =>  $product->sale
                ]);
            }
        }

        $totalPrice = Cart::subtotal(0, ",", ".");
        // dd($totalPrice);
        $setting = Setting::first();
        return view('frontend.cart', [
            'products' => $products,
            'setting' => $setting,
            'cart' => $cart,
            'totalPrice' => $totalPrice
        ]);

    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->id);
        if((int)$request->qty > $product->quantity){
            return redirect()->route('shop.productDetail', $product->slug)
            ->with('warning','Số lượng sản phẩm vượt quá số lượng kho');
        }
        $cart = Cart::content();
        foreach($cart as $item){
            if($item->id == $product->id && $item->qty + (int)$request->qty > $product->quantity){
                return redirect()->route('shop.productDetail', $product->slug)
                ->with('warning','Số lượng sản phẩm vượt quá số lượng kho');
            }
        }


        $cartInfo = [
            'id' => $product->id,
            'name' => $product->name,
            'qty' => (int)$request->qty,
            'price' => $product->price,

            'options' => [
                'avatar' => asset($product->avatar),
                'size' => $request->size,
                'color' => $request->color,
                'sale' => $product->sale,
                'best_sale' => $product->best_sale
            ]
        ];
        // dd($cartInfo);
        Cart::add($cartInfo);

        

        session(['totalItem' => Cart::count()]);
        return redirect()->route('cart');
    }

    public function removeToCart($rowId)
    {
        Cart::remove($rowId);
        $cart = Cart::content();
        $totalPrice = Cart::subtotal(0, ",", ".");
        $setting = Setting::first();

        return view('frontend.cart', [
            'cart' => $cart,
            'totalPrice' => $totalPrice,
            'setting' => $setting
        ]);
    }

    public function update(Request $request)
    {

        $rowId = $request->input('rowId');
        $qty = (int) $request->input('qty');

        $itemFocus = Cart::get($rowId);
        $product = Product::where([['id', '=', $itemFocus->id]])->first();
        if($qty > $product->quantity){
            return response()->json(['msg' => 'Số lượng sản phẩm đã đạt giới hạn','qty'=> $itemFocus->qty], 400);
        }
        $cart = Cart::content();
        foreach($cart as $item){
            if($item->id == $product->id && $item->qty + $qty > $product->quantity && $item->rowId != $rowId){
                return response()->json(['msg' => 'Số lượng sản phẩm đã đạt giới hạn','qty'=> $itemFocus->qty], 400);
            }
        }


        // if($qty > $product->quantity){
        //     return response()->json(['msg' => 'Không thể vượt quá số lượng sản phẩm trong kho'], 400);
        // }
        // cập nhật lại số lương
        //        Cart::update($rowId, $qty);
        Cart::update($rowId, $qty);


        session(['totalItem' => Cart::count()]);
        $cart = Cart::content();
        $totalPrice = Cart::subtotal(0, ",", "."); // lấy tổng giá của sản phẩm

        
        $list = array();
        foreach($cart as $item){
            $list[$item->rowId] = $item;
        }
        return response()->json([
            'totalPrice' => $totalPrice,
            'cart' => $cart,
            'list' => $list], 200);
    }

    public function destroy()
    {
        Cart::destroy();
        return redirect('/')->with('msg', 'Hủy giỏ hàng thành công.');
    }

    public function order()
    {
        $totalCount = Cart::count();
        $totalPrice = Cart::subtotal(0, "", "");
        // $intTotalPrice = intval($totalPrice);
        // $value = session()->get('coupon')['value'] ?? 0;
        // $priceInValue = $intTotalPrice - $value;
        $setting = Setting::first();

        //        //  Kiểm tra có sản phẩm trong giỏ hàng

        return view('frontend.order', [
            'totalCount' => $totalCount,
            'totalPrice' => $totalPrice,
            // 'value' => $value,
            /*'newSubtotal' => $newSubtotal,*/
            // 'priceInValue' => $priceInValue,
            'setting' => $setting
        ]);
    }


    // Xử lý đặt hàng
    public function postOrder(Request $request)
    {
        $request->validate([
            'cus_name' => 'required|max:255',
            'cus_phone' => 'required|numeric|min:10',
            'cus_email' => 'required|email',
            'cus_address' => 'required',
        ], [
            'cus_name.required' => 'Bạn cần nhập vào họ tên.',
            'cus_phone.required' => 'Bạn cần nhập vào số điện thoại.',
            'cus_phone.numeric' => 'Bạn cần phải nhập vào chữ số.',
            'cus_email.required' => 'Bạn cần nhập vào email.',
            'cus_email.email' => 'Bạn cần nhập đúng định dạng @email. ',
            'cus_address.required' => 'Bạn cần nhập vào địa chỉ.',
        ]);

        $cart = Cart::content();
        // dd($cart);
        $totalPrice = Cart::subtotal(0, "", "");
        // dd($totalPrice);
        $intTotalPrice = intval($totalPrice);
        
        // Lưu vào bảng thông tin đơn đặt hàng
        $order = new Order();
        $order->cus_name = $request->input('cus_name');
        $order->cus_phone = $request->input('cus_phone');
        $order->cus_email = $request->input('cus_email');
        $order->cus_address = $request->input('cus_address');
        $order->note = $request->input('note');
        $order->total = $totalPrice;
    
        //setup trang thai don hang la moi
        $order->order_status_id = 1; // 1 = mới
        // Lưu vào bảng chi tiết đơn đặt hàng
        if ($order->save()) {
            $maDonHang = 'DH-0' . $order->id .time();// Tạo mã đơn hàng.
            $order->code = $maDonHang;
            $order->save();

            // if(count($cart) > 0) {

            foreach ($cart as $key => $item) {
                // dd($item);
                // Lưu lại đơn hàng chi tiết, khi cập nhật lại giá, hay hình ảnh của đơn hàng thì chi tiết đơn hàng không thay đổi
                $_detail = new OrderDetail();
                $_detail->order_id = $order->id;
                $_detail->name = $item->name;
                $_detail->avatar = $item->options->avatar;
                $_detail->product_id = $item->id;
                $_detail->quantity = $item->qty;
                $_detail->price = $item->price;
                $_detail->color = $item->options['color'];
                $_detail->size = $item->options['size'];
                // $_detail->unit = $item->options->unit;
                $prod = Product::findOrFail($item->id);
                $oldStock = $prod->quantity;
                $prod->quantity = $oldStock - $item->qty;

                $prod->save();
                $_detail->save();
            }
            
            $to_mail = $order->cus_email;
            $content =array('name'=>$order->cus_name,'email'=>$order->cus_email, 'address' =>$order->cus_address,
                'orderId'=>$maDonHang, 'phone'=>$order->cus_phone,
                'total'=>$order->total, 'item' => $cart,
                
                );
            //        $order = $this->postOrder($request, null);
            Mail::send('email.orderStatus', $content,
                function($message) use ($to_mail){
                $message->to($to_mail, 'Clothes Store')->subject('Clothes Store - Đơn hàng mới');
                $message->from('admin@Clothes.com', 'Clothes');
            });


            // Xóa thông tin giỏ hàng hiện tại sau khi đặt hàng thành công.
            Cart::destroy();
            session(['totalItem' => 0]);
            
            return redirect()->route('complete')->with('msg', 'Cảm ơn bạn đã đặt hàng. Mã đơn hàng của bạn : ' . $order->code);
        }
    
    }



    // Hiển thị hoàn tất đơn hàng.
    public function completeOrder()
    {
        return view('frontend.completeOrder');
    }
}
