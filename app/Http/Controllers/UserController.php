<?php

namespace App\Http\Controllers;

use App\Article;
use App\Banner;
use App\Category;
use App\Product;
use App\Setting;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();

        return view('backend.user.index',[
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|max:255',
            //kiem tra input có name="name"
//            required: kiểm tra có bổ trống hay k, unique: kiểm tra trùng dữ liệu --tên bảng--tên cột, max: đọ dài tối đa
            'email'=>'required',
            'password'=>'required',
          //  'address'=>'required',
          //  'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
          //  'content' => 'required'

        ], [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
          //  'address.required' => 'Địa chỉ không được để trống',
           // 'phone.required' => 'Số điện thoại không được để trống',
            'password.required' => 'Mật khẩu không được để trống',
           // 'content.required' => 'Nội dung không được để trống',
        ]);
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
     //   $user->phone = $request->input('phone');
        $user->password = bcrypt($request->input('password'));
        $user->address = $request->input('address');
       // $user->gender = $request->input('gender');

        $status = 1;
        if ($request->has('status')) { // kiem tra is_active co ton tai khong?
            $status = $request->input('status');
        }
        $user->status = $status;

        $user->save();

        return redirect()->back()->with('msg','Đăng ký thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        //
        $user = User::findOrFail(Auth::user()->id);
        $banner = Banner::where('status', 1)->orderBy('position', 'ASC')
            ->orderBy('id', 'DESC')->get();

        $category = Category::where('status', 1)->orderBy('position', 'ASC')
            ->orderBy('id', 'DESC')->get();

        $article = Article::where([ 'status'=> '1'])->orderBy('position', 'ASC')
            ->orderBy('id', 'DESC')->limit(3)->get();

        
       
        $setting = Setting::first();
        return view('frontend.user',[
            'user' => $user,
            'banner' => $banner,
            'setting' => $setting,
            'category' => $category,
            'article' => $article,
           
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
       

        
        // $product = Product::where('status',1)->orderBy('id','DESC')->get();
       
        $setting = Setting::first();
        $user = User::findOrFail(Auth::user()->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');

        $status = 1;
        if ($request->has('status')) { // kiem tra is_active co ton tai khong?
            $status = $request->input('status');
        }
        $user->status = $status;

        // kiểm tra xem có nhập mật khẩu mới không ,, nếu có thì mới cập nhật
        if ($request->input('new_password')) {
            $user->password = bcrypt($request->input('new_password')); // mật khẩu mới
        }

        $user->save();

        return view('frontend.user',[
            'user' => $user,
            
           
        ]);
    }

    public function login(){
        $setting = Setting::first();
        return view('frontend.login',[
            'setting' => $setting
        ]);
    }

    public function logout(){
        Auth::logout();

        return redirect()->route('shop.index');
    }

    public function register(){
        $setting = Setting::first();
        return view('frontend.register',[
            'setting' => $setting
        ]);
    }

    public function postLogin(Request $request){
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
        //hàm xác thực login của framework : Auth::attemp();
        $checkLogin = Auth::attempt($dataLogin, $request->has('remember'));
        // kiểm tra xem có đăng nhập thành côngh với email và password đã nhập hay không
        if ($checkLogin) {
            return redirect()->route('shop.index');
        }

        return redirect()->back()->with('msg', 'Email hoặc Password không chính xác');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $isDelete = User::destroy($id); // return 1 | 0, true  false

        if ($isDelete) { // xóa thành công
            $statusCode = 200;
            $isSuccess = true;
        } else {
            $statusCode = 400;
            $isSuccess = false;
        }

        // Trả về dữ liệu json và trạng thái kèm theo thành công là 200
        return response()->json(['isSuccess' => $isSuccess], $statusCode);
    }
}
