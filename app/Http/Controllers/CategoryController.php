<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

class CategoryController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=Category::all();
        //无限极分类
        $data=createTree($data);
        return view('/category/index',['data'=>$data]);
    }


    public function checkOnly(){
        $name=request()->cate_name;
        $where=[];
        if ($name) {
            $where[]=['cate_name','=',$name];
        }
        //排除自身   修改时需要
        $n_id=request()->id;
        if ($n_id) {
            $where[]=['cate_id','!=',$n_id];
        }

        $count=Essay::where($where)->count();
        // \DB::connection()->enableQueryLog();
        // $logs = \DB::getQueryLog();
        // dd($logs);
        
        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=Category::all();
        //无限极分类
        $data=createTree($data);
        return view('/category/create',['data'=>$data]);
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
            'cate_name'=>'required|unique:category|regex:/^[\x{4e00}-\x{9fa5}]+$/u',
        ],[
            'cate_name.required'=>'分类不能为空',
            'cate_name.unique'=>'分类已存在',
            'cate_name.regex'=>'分类形式不符合',
        ]);
        $data=$request->except('_token');
        $res=Category::insert($data);
        if ($res) {
            return redirect('category/index');
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
        $user=Category::find($id);

        $data=Category::all();
        //无限极分类
        $data=createTree($data);
        return view('category.edit',['data'=>$data,'user'=>$user]);
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
        $res=Category::where('cate_id',$id)->update($user);
        if ($res!==false){
            return redirect('/category/index');
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
        $count=Category::where('p_id','=',$id)->count();
        if ($count>0) {
            echo "此分类下有子分类，不能删除";
        }else{
             $res=Category::destroy($id);
            if ($res) {
                return redirect('category/index');
            }
        }
       
    }
}
