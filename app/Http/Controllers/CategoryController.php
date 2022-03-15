<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Category::all();

        return view('backend.category.index', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cates = Category::all();
        $pos = Category::max('position');
        
        return view('backend.category.create', ['pos'=>$pos, 'cates'=>$cates]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category();

        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('name'));
        
        if($request->hasFile('image')){
            $file = $request->file('image');

            $filename = time().'_'.$file->getClientOriginalName();

            $path_upload = 'upload/category/';

            $file->move($path_upload, $filename);

            $category->image = $path_upload.$filename;
        }

        $category->parent_id = $request->input('parent_id');

        $status = 0;
        if($request->has('status')){
            $status = $request->input('status');
        }
        $category->status = $status;

        $position = 0;
        if($request->has('position')){
            $position = $request->input('position');
        }
        $category->position = $position;

        $category->save();

        return redirect()->route('admin.category.index');
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
        $cates = Category::all();
        $category = Category::findOrFail($id);

        return view('backend.category.edit', ['cates'=>$cates, 'category'=>$category]);
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

        $category = Category::findOrFail($id);

        $category->parent_id = $request->input('parent_id');
        $category->name = $request->input('name');
        $category->slug = Str::slug($request->input('name'));

        if($request->hasFile('new_image')){
            @unlink(public_path($category->image));

            $file = $request->file('new_image');

            $filename = time().'_'.$file->getClientOriginalName();

            $path_upload = 'upload/category/';

            $file->move($path_upload, $filename);

            $category->image = $path_upload.$filename;
        }

        

        $status = 0;
        if($request->has('status')){
            $status = $request->input('status');
        }
        $category->status = $status;

        $position = 0;
        if($request->has('position')){
            $position = $request->input('position');
        }
        $category->position = $position;

        $category->save();

        return redirect()->route('admin.category.index');
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
        $isDelete = Category::destroy($id);
        if($isDelete)
        {
            $statusCode = 200;
            $isSuccess = true;
        } else { 
            $statusCode = 400;
            $isSuccess = false;
        }

        return response()->json(['isSuccess' => $isSuccess], $statusCode);
    }
}
