<?php

namespace App\Http\Controllers;

use App\Article;
use App\Banner;
use App\Category;
use App\Color;
use App\Contact;
use App\Product;
use App\ProductDetail;
use App\ProductImage;
use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ShopController extends Controller
{
    //
    public function index()
    {
        $banner = Banner::where('status', 1)->orderBy('position', 'ASC')
            ->orderBy('id', 'DESC')->get();

        $category = Category::where('status', 1)->orderBy('position', 'ASC')
            ->orderBy('id', 'DESC')->get();

        $article = Article::where([ 'status'=> '1'])->orderBy('position', 'ASC')
            ->orderBy('id', 'DESC')->limit(3)->get();
        
       
        
        // $product = Product::where('status',1)->orderBy('id','DESC')->get();
        $salePro = Product::where('status', 1)->where('best_sale', 1)->limit(4)->get();
        $featuredPro = Product::where('status', 1)->where('featured', 1)->limit(4)->get();
        $setting = Setting::first();
        return view('frontend.index', [
            'banner' => $banner,
            'category' => $category,
            // 'product' => $product,
            'salePro' => $salePro,
            'featuredPro' => $featuredPro,
            'setting' => $setting,
            'article' => $article
        ]);
    }

    public function contact()
    {
        $setting = Setting::first();
        return view('frontend.contact', [
            'setting' => $setting
        ]);
    }

    public function postContact(Request $request)
    {
        $contact = new Contact();
        $contact->name = $request->input('name');
        $contact->address = $request->input('address');
        $contact->email = $request->input('email');
        $contact->phone = $request->input('phone');
        $contact->content = $request->input('content');
        $contact->save();

        return redirect()->route('lienhe')->with('msg', 'Bạn đã gửi liên hệ thành công');
    }

    public function article()
    {
        $setting = Setting::first();
        $article = Article::where('status',1)->get();
        return view('frontend.article', [
            'setting' => $setting,
            'article' => $article
        ]);
    }

    public function articleDetail($slug)
    {
        $setting = Setting::first();
        $article = Article::where(['slug' => $slug, 'status' => '1'])->first();

        // if(!$article){
        //     return $this->notfound();
        // }
        return view('frontend.articleDetail', [
            'setting' => $setting,
            'article' => $article
        ]);
    }

    public function product(Request $request)
    {

        $categories = Category::where('status', 1)->orderBy('position', 'ASC')
        ->orderBy('id', 'DESC')->get();
        // $category = Category::where(['slug'=>$slug])->get();
        $product = Product::where('status', 1)->orderBy('id', 'ASC')->get();

        
        $query = Product::all();
// dd($query);


        
        $setting = Setting::first();
        return view('frontend.product.product', [
            // 'slug' => $slug,
            // 'pro' => $pro,
            // 'prodByMen' => $productByMen,
            'product' => $product,
            'setting' => $setting,
            'categories' => $categories,
            // 'category' => $category,
        ]);
    }

    public function productDetail($slug)
    {
        // $product = Product::where(['slug' => $slug], ['status' => 1])->first();
        $productAvt = Product::where(['slug' => $slug], ['status' => 1])->get();
        $productImg = Product::where(['slug' => $slug], ['status' => 1])->first();
        // dd($productImg);

        // $proDetail = ProductDetail::all();
        // $proImg = ProductImage::where(['', $product->id])->get();

        $proDetail = Product::where([['slug', '=', $slug]])->get()->first();
        
        $proSize = DB::table('products')
            ->selectRaw('sizes.name, sizes.id, product_size.number, product_size.size_id')
            ->join('product_size', 'products.id', '=', 'product_size.product_id')
            ->join('sizes', 'sizes.id', '=', 'product_size.size_id')
            ->where([['products.id', '=', $proDetail->id]])
            ->groupBy('sizes.name', 'sizes.id', 'product_size.number', 'product_size.size_id')
            ->get();

            // dd($proSize);

        $proColor = DB::table('products')
            ->selectRaw('colors.name, colors.id, product_color.color_id')
            ->join('product_color', 'products.id', '=', 'product_color.product_id')
            ->join('colors', 'colors.id', '=', 'product_color.color_id')
            ->where([['products.id', '=', $proDetail->id]])
            ->groupBy('colors.name', 'colors.id', 'product_color.color_id')
            ->get();
        // dd($proColor);
        
        $color = Color::all();
        $setting = Setting::first();
        return view('frontend.product.productDetail', [
            // 'product' => $product,
            'setting' => $setting,
            'color' => $color,
            'productAvt' => $productAvt,
            'proDetail' => $proDetail,
            'proColor' => $proColor,
            'proSize' => $proSize,
            'slug' => $slug,
            'productImg' => $productImg,
            // 'proDetail' => $proDetail
        ]);
    }

    public function cart()
    {
        $setting = Setting::first();

        return view('frontend.cart', [
            'setting' => $setting
        ]);
    }
    public function notfound()
    {
        return view('errors.404',[
        ]);
    }

    public function cateProduct($slug){
        $category = Category::where(['slug'=>$slug])->get();
        $product = Product::where(['category_id'=>$category->first()->id])->get();
        $setting = Setting::first();
        $categories = Category::where('status', 1)->orderBy('position', 'ASC')
            ->orderBy('id', 'DESC')->get();
        
        return view('frontend.product.cate_product',[
            'category' => $category,
            'product' => $product,
            'setting' => $setting,
            'categories' => $categories
        ]);
    }

    public function search(Request $request)
    {
        $setting = Setting::first();
        $categories = Category::where('status', 1)->orderBy('position', 'ASC')
            ->orderBy('id', 'DESC')->get();
        // b1. Lấy từ khóa tìm kiếm
        $keyword = $request->input('tu-khoa');
        $slug = Str::slug($request->input('tu-khoa'));
        $product = Product::where([['slug', 'like', '%' . $slug . '%'], ['status', '=', 1]])->get();

        return view('frontend.product.searchProduct', [
            'product' => $product,
//            'totalResult' => $totalResult,
            'keyword' => $keyword,
            // 'banner' => $banner,
            'setting' => $setting,
            'categories' => $categories,
            
        ]);
    }

    
}
