<?php

namespace App\Http\Controllers;

use App\Category;
use App\Color;
use App\Product;
use App\ProductColor;
use App\ProductSize;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();

        return view('backend.product.index', ['product' => $product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = Category::all();
        $color = Color::latest()->get();
        // dd($color);
        $size = Size::latest()->get();
        
        return view('backend.product.create', [
            'category' => $category,
            'color'=>$color,
            'size'=>$size]);
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
        $product = new Product();

        $product->name = $request->input('name');
        $product->slug = Str::slug($request->input('name'));
        $product->price = $request->input('price');
        $product->sale = $request->input('sale');
        $product->quantity = $request->input('quantity');
        $product->quantity_sold = $request->input('quantity_sold');
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path_upload = 'upload/product/';
            $file->move($path_upload, $filename);
            $product->avatar = $path_upload . $filename;
        }

        $product->category_id = $request->input('category_id');
        $product->content = $request->input('content');
        // Sản phẩm nổi bật
        $featured = 0;
        if ($request->has('featured')) {
            $featured = $request->input('featured');
        }
        $product->featured = $featured;

        //San pham bán chạy
        $best_sale = 0;
        if ($request->has('best_sale')) {
            $best_sale = $request->input('best_sale');
        }
        $product->best_sale = $best_sale;
        $status = 0;
        if ($request->has('status')) {
            $status = $request->input('status');
        }
        $product->status = $status;

        $product->save();

        $last_product = Product::latest()->get()->first()->id;
        foreach ($request->input('size_id') as $item) {
            $product_size = new ProductSize();
            $product_size->product_id = $last_product;
            $product_size->size_id = $item;
            $product_size->save();
        }
        $last_proColor = Product::latest()->get()->first()->id;
        // dd($last_proColor);
        foreach ($request->input('color_id') as $item) {
            $product_color = new ProductColor();
            $product_color->product_id = $last_proColor;
            $product_color->color_id = $item;
            $product_color->save();
        }
        return redirect()->route('admin.product.index');
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
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::all();
        $color = Color::all();
        $size = Size::all();
        return view('backend.product.edit', [
            'product' => $product,
            'category' => $category,
            'color' => $color,
            'size' =>$size
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::findOrFail($id);

        $product->name = $request->input('name');
        $product->slug = Str::slug($request->input('name'));
        $product->price = $request->input('price');
        $product->sale = $request->input('sale');
        $product->quantity = $request->input('quantity');
        $product->quantity_sold = $request->input('quantity_sold');
        if ($request->hasFile('new_avatar')) {
            @unlink(public_path($product->avatar));
            $file = $request->file('new_avatar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path_upload = 'upload/product/';
            $file->move($path_upload, $filename);
            $product->avatar = $path_upload . $filename;
        }

        $product->category_id = $request->input('category_id');
        $product->content = $request->input('content');
        // Sản phẩm nổi bật
        $featured = 0;
        if ($request->has('featured')) {
            $featured = $request->input('featured');
        }
        $product->featured = $featured;

        //San pham bán chạy
        $best_sale = 0;
        if ($request->has('best_sale')) {
            $best_sale = $request->input('best_sale');
        }
        $product->best_sale = $best_sale;

        $status = 0;
        if ($request->has('status')) {
            $status = $request->input('status');
        }
        $product->status = $status;
        
        $product->size()->sync($request->input('size_id'));
        $product->color()->sync($request->input('color_id'));
        $product->save();

        
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDelete = Product::destroy($id);
        if ($isDelete) {
            $statusCode = 200;
            $isSuccess = true;
        } else {
            $statusCode = 400;
            $isSuccess = false;
        }

        return response()->json(['isSuccess' => $isSuccess], $statusCode);
    }
}
