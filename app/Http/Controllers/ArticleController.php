<?php

namespace App\Http\Controllers;

use App\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Article::all();

        return view('backend.article.index', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $pos = Article::max('position');

        return view('backend.article.create', ['pos'=>$pos]);
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
        $article = new Article();

        $article->title = $request->input('title');
        $article->slug = Str::slug($request->input('title'));

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $path_upload = 'upload/article/';
            $file->move($path_upload, $filename);
            $article->image = $path_upload.$filename;
        }

        $article->type = $request->input('type');
        $article->description = $request->input('description');
        $article->content = $request->input('content');

        $position = 0;
        if($request->has('position')){
            $position = $request->input('position');
        }
        $article->position = $position;

        $status = 0;
        if($request->has('status')){
            $status = $request->input('status');
        }
        $article->status = $status;

        $article->save();
        return redirect()->route('admin.article.index');
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
        $article = Article::findOrFail($id);

        return view('backend.article.edit', ['article'=>$article]);
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
        $article = Article::findOrFail($id);

        $article->title = $request->input('title');
        $article->slug = Str::slug($request->input('title'));

        if($request->hasFile('new_image')){
            @unlink(public_path($article->image));
            $file = $request->file('new_image');
            $filename = time().'_'.$file->getClientOriginalName();
            $path_upload = 'upload/article/';
            $file->move($path_upload, $filename);
            $article->image = $path_upload.$filename;
        }

        $article->type = $request->input('type');
        $article->description = $request->input('description');
        $article->content = $request->input('content');

        $position = 0;
        if($request->has('position')){
            $position = $request->input('position');
        }
        $article->position = $position;

        $status = 0;
        if($request->has('status')){
            $status = $request->input('status');
        }
        $article->status = $status;

        $article->save();
        return redirect()->route('admin.article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDelete = Article::destroy($id);
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
