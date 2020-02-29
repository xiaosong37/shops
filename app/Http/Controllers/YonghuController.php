<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Yonghu;

class YonghuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Yonghu::all();
        return view('yonghu/index',['data'=>$data]);
    }

    public function list(){
        return view('yonghu/list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=request()->session()->get('admin');
        if ($user['limit']==2) {
            return view('yonghu/create');
        }else{
            echo "没有权限";
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data=$request->except('_token');
        $res=Yonghu::insert($data);
        if ($res) {
            return redirect('yonghu/index');
        }
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
        $user=request()->session()->get('admin');
        $res=Yonghu::destroy($id);
        if ($user['limit']==2) {
            return redirect('yonghu/index');
        }else{
            echo "没有权限";
        }
    }
}
