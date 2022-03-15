<?php

namespace App\Http\Controllers;

use App\Manager;
use App\Role;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Manager::all();
        return view('backend.manager.index', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view('backend.manager.create', ['role'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $manager = new Manager();
        $manager->name = $request->input('name');
        $manager->email = $request->input('email');
        $manager->password = bcrypt($request->input('password'));
        if($request->hasFile('avatar'))
        {
            $file = $request->file('avatar');

            $filename = time().'_'.$file->getClientOriginalName();

            $path_upload = 'upload/manager/';

            $request->file('avatar')->move($path_upload,$filename);

            $manager->avatar = $path_upload.$filename;
        }
        $manager->role_id = $request->input('role_id');
        $status = 0;
        if ($request->has('status'))
        {
            $status = $request->input('status');
        }
        $manager->status = $status;

        $manager->save();

        return redirect()->route('admin.manager.index');
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
        $manager = Manager::findOrFail($id);
        $roles = Role::all();

        return view('backend.manager.edit', ['manager'=> $manager, 'role'=> $roles]);
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
        $manager = Manager::findOrFail($id);
        $manager->name = $request->input('name');
        $manager->email = $request->input('email');
        if($request->input('new_password'))
        {
            $manager->password = bcrypt($request->input('new_password'));
        }
        if($request->hasFile('new_avatar'))
        {
            //Xoa file cu
            @unlink(public_path($manager->avatar));

            $file = $request->file('new_avatar');

            $filename = time().'_'.$file->getClientOriginalName();

            $path_upload = 'upload/manager/';

            $file->move($path_upload,$filename);

            $manager->avatar = $path_upload.$filename;
        }
        $manager->role_id = $request->input('role_id');
        $status = 0;
        if ($request->has('status'))
        {
            $status = $request->input('status');
        }
        $manager->status = $status;

        $manager->save();

        return redirect()->route('admin.manager.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDelete = Manager::destroy($id);
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
