<?php

namespace App\Http\Controllers;

use App\Color;
use App\Product;
use App\ProductColor;
use App\ProductDetail;
use App\ProductSize;
use App\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class ProductDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $product = Product::all();
        // dd($product);
        $color = Color::all();
        $size = Size::all();
        $proDetail = ProductDetail::latest()->get();
        return view('backend.product_detail.index', ['product' => $product, 'size'=>$size,'color'=>$color, 'proDetail'=>$proDetail]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $product = Product::all();
        $color = Color::latest()->get();
        // dd($color);
        $size = Size::latest()->get();
        return view('backend.product_detail.create', [
            'product' => $product,
            'color'=> $color,
            'size'=> $size]);
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
        $product_detail = new ProductDetail();
        $product_detail->name = $request->input('name');
        $product_detail->slug = Str::slug($request->input('product_id'));
        // $product_detail->size_id = $request->input('size_id');
        $product_detail->product_id = $request->input('product_id');
        $product_detail->quantity = $request->input('quantity');
        $product_detail->quantity_sold = $request->input('quantity_sold');
        $product_detail->price = $request->input('price');
        $product_detail->sale = $request->input('sale');
        // $product_detail->color_id = $request->input('color_id');
        $product_detail->status = ($request->input('status') == 'on' ) ? 1 : 0;
        
        $product_detail->save();

        $last_product = ProductDetail::latest()->get()->first()->id;
        foreach ($request->input('size_id') as $item) {
            $product_size = new ProductSize();
            $product_size->productDetail_id = $last_product;
            $product_size->size_id = $item;
            $product_size->save();
        }
        $last_proColor = ProductDetail::latest()->get()->first()->id;
        // dd($last_proColor);
        foreach ($request->input('color_id') as $item) {
            $product_color = new ProductColor();
            $product_color->productDetail_id = $last_proColor;
            $product_color->color_id = $item;
            $product_color->save();
        }

        return redirect()->route('product_detail.index');
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
        //
        $product = Product::all();
        $product_detail = ProductDetail::findOrFail($id);
        $color = Color::all();
        $size = Size::all();
        return view('backend.product_detail.edit', [
            'product_detail' => $product_detail,
            'color'=>$color,
            'size'=>$size,
            'product'=>$product]);
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
        $product_detail = ProductDetail::findOrFail($id);
        $product_detail->name = $request->input('name');
        $product_detail->slug = Str::slug($request->input('name'));
        // $product_detail->size_id = $request->input('size_id');
        $product_detail->product_id = $request->input('product_id');
        $product_detail->quantity = $request->input('quantity');
        $product_detail->quantity_sold = $request->input('quantity_sold');
        $product_detail->price = $request->input('price');
        $product_detail->sale = $request->input('sale');
        $product_detail->color_id = $request->input('color_id');
        $product_detail->status = ($request->input('status') == 'on' ) ? 1 : 0;
        
        $product_detail->size()->sync($request->input('size_id'));

        $product_detail->save();
        return redirect()->route('product_detail.index');

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
        $isDelete = ProductDetail::destroy($id); 
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
