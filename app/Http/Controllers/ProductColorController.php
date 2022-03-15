<?php

namespace App\Http\Controllers;

use App\Color;
use App\Product;
use App\ProductColor;
use App\ProductDetail;
use Illuminate\Http\Request;

class ProductColorController extends Controller
{
    //
    public function index()
    {
        //
        $proSize = ProductColor::latest()->get();

        return view('backend.product_color.index',[
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
        $proDetail = Product::all();
        $color = Color::all();

        return view('backend.product_color.create',[
            'proDetail' => $proDetail,
            'color' => $color
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
        $proSize = new ProductColor();
        $proSize->product_id = $request->input('product_id');
        $proSize->color_id = $request->input('color_id');

        $proSize->save();

        return redirect()->route('admin.productColor.index');
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
        $proSize = ProductColor::findOrFail($id);
        $proDetail = Product::all();
        $color = Color::all();

        return view('backend.product_color.edit',[
            'proSize'=>$proSize,
            'proDetail'=>$proDetail,
            'color'=>$color
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
        $proSize = ProductColor::findOrFail($id);
        $proSize->product_id = $request->input('product_id');
        $proSize->color_id = $request->input('color_id');

        $proSize->save();

        return redirect()->route('admin.productColor.index');
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
        $isDelete = ProductColor::destroy($id); 
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
