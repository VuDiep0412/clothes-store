<?php

namespace App\Http\Controllers;

use App\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $wishlist = Auth::user()->wishlist()->with('product')->get();
        // dd($wishlist);
        
        return view('frontend.wishlist', compact('wishlist'));
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
        $user = Auth::user();
        // dd($request->input());
        if(!Wishlist::where('product_id',$request->product_id)->where('user_id',$user->id)->count())
        {
            $user->wishlist()->create(['product_id' => $request->product_id]);
        }
        else{
            return back()->with('success','Sản phẩm đã tồn tại trong danh sách yêu thích của bạn!');
        }
        return redirect()->back()->with('success','Đã thêm sản phẩm vào danh sách yêu thích!');
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
        // return "abcd";s
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
        $record = Wishlist::findOrFail($id);
        if($record){
            if($record->user_id==Auth::user()->id){
                $record->delete();
                return back();
            }
        }
        return back();
        
    }
}
