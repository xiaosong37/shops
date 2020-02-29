<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Admin;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Admin::get();
        //$pageSize = config('app.pageSize');
        return view('admin/index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("/admin/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //验证
        $request->validate([
            'admin_name'=>'required|unique:admin|regex:/^[\x{4e00}-\x{9fa5}]+$/u',
            'admin_tel'=>'required',
        ],[
            'admin_name.required'=>'管理员姓名不能为空',
            'admin_name.unique'=>'管理员姓名已存在',
            'admin_name.regex'=>'管理员姓名形式不符合',
            'admin_tel.required'=>'电话不能为空',
        ]);
        
        $data=$request->except('_token');
        $data['admin_pwd']=encrypt($data['admin_pwd']);
        $res=Admin::create($data);
        if ($res) {
            return redirect('admin/index');
        }
    }

    public function checkOnly(){

        $admin_name = request()->admin_name??'';

        $count = Admin::where(['admin_name'=>$admin_name])->count();

        echo json_encode(['code'=>'00000', 'msg'=>'ok', 'count'=>$count]);
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
        $user=Admin::find($id);
        return view("admin/edit",['user'=>$user]);
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
        $user=$request->except('_token');
        $res=Admin::where('admin_id',$id)->update($user);
        if ($res!==false) {
            return redirect('/admin/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res=Admin::destroy($id);
        if ($res) {
            return redirect('admin/index');
        }
    }
}
