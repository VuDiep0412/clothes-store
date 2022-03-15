<?php

namespace App\Http\Controllers;

use App\Article;
use App\Order;
use App\Product;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $numProduct = Product::count();
        $numArticle = Article::count();
        $numUser = User::count();
        $numOrder = Order::count();

        $orders = Order::where(['order_status_id' => 1])
            ->orderBy('id', 'DESC')
            ->limit(6)->get();
        $orderMonth = [];
        $od = Order::whereMonth('created_at', Carbon::now()->month)->get();
        // dd($od);

        for ($i = 1; $i <= 5; $i++) {
            array_push($orderMonth, $od->where('order_status_id', $i)->count());
        }
        array_push($orderMonth, Order::where('order_status_id', 4)->whereMonth('created_at', Carbon::now()->month)->sum('total'));
        return view('backend.dashboard', [
            'numProduct' => $numProduct,
            'numArticle' => $numArticle,
            'numUser' => $numUser,
            'numOrder' => $numOrder,
            'orders' => $orders,
            'orderMonth' => $orderMonth,
            'od' => $od->count(),
        ]);
    }


    public function login()
    {
        return view('backend.admin.index');
    }

    public function postLogin(Request $request)
    {
        //validate dữ liệu
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6'
        ]); // validate false => tạo ra biến $errors để toàn thông tin bị lỗi cho từng trường


        // validate thành công

        $dataLogin = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        //hàm xác thực admin của framework : Auth::attemp();
        $checkLogin = Auth::guard('admin')->attempt($dataLogin, $request->has('remember'));

        // kiểm tra xem có đăng nhập thành công với email và password đã nhập hay không
        if ($checkLogin) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('msg', 'Email or Password not incorrect.');;
    }

    public function logout()
    {
        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}
