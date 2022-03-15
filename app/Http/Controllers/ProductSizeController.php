<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductDetail;
use App\ProductSize;
use App\Size;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $proSize = ProductSize::latest()->get();

        return view('backend.product_size.index',[
            'proSize'=>$proSize
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
        $product = Product::all();
        $size = Size::all();

        return view('backend.product_size.create',[
            'product' => $product,
            'size' => $size
        ]);
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
        $proSize = new ProductSize();
        $proSize->product_id = $request->input('product_id');
        $proSize->size_id = $request->input('size_id');
        $proSize->number = $request->input('number');

        $proSize->save();

        return redirect()->route('admin.productSize.index');
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
        $proSize = ProductSize::findOrFail($id);
        $product = Product::all();
        $size = Size::all();

        return view('backend.product_size.edit',[
            'proSize'=>$proSize,
            'product'=>$product,
            'size'=>$size
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
        $proSize = ProductSize::findOrFail($id);
        $proSize->product_id = $request->input('product_id');
        $proSize->size_id = $request->input('size_id');
        $proSize->number = $request->input('number');

        $proSize->save();

        return redirect()->route('admin.productSize.index');
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
        $isDelete = ProductSize::destroy($id); 
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
