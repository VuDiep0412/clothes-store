<?php

namespace App\Http\Controllers;

use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Banner::all();
        return view('backend.banner.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pos = Banner::max('position');

        return view('backend.banner.create', ['pos' => $pos]);
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

        $banner = new Banner();

        $banner->title = $request->input('title');

        if($request->hasFile('image')){
            $file = $request->file('image');

            $filename = time().'_'.$file->getClientOriginalName();

            $path_upload = 'upload/banner/';

            $file->move($path_upload, $filename);

            $banner->image = $path_upload.$filename;
        }

        $banner->url = $request->input('url');
        $banner->slug = Str::slug($request->input('title'));
        $banner->description = $request->input('description');

        $status = 0;
        if($request->has('status')){
            $status = $request->input('status');
        }
        $banner->status = $status;

        $position = 0;
        if($request->has('position')){
            $position = $request->input('position');
        }
        $banner->position = $position;

        $banner->save();

        return redirect()->route('admin.banner.index');
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
        $banner = Banner::findOrFail($id);

        return view('backend.banner.edit', ['banner'=>$banner]);
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
        $banner = Banner::findOrFail($id);

        $banner->title = $request->input('title');

        if($request->hasFile('new_image')){
            @unlink(public_path($banner->image));

            $file = $request->file('new_image');

            $filename = time().'_'.$file->getClientOriginalName();

            $path_upload = 'upload/banner/';

            $file->move($path_upload, $filename);

            $banner->image = $path_upload.$filename;
        }

        $banner->url = $request->input('url');
        $banner->slug = Str::slug($request->input('title'));
        $banner->description = $request->input('description');

        $position = 0;
        if($request->has('position')){
            $position = $request->input('position');
        }
        $banner->position = $position;

        $status = 0;
        if($request->has('status')){
            $status = $request->input('status');
        }
        $banner->status = $status;

        $banner->save();

        return redirect()->route('admin.banner.index');
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
        $isDelete = Banner::destroy($id);

        if($isDelete) {
            $statusCode = 200;
            $isSuccess = true;
        }
        else {
            $statusCode = 400;
            $isSuccess = false;
        }

        return response()->json(['isSuccess' => $isSuccess], $statusCode);
    }
}
