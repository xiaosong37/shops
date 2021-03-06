<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Goods;
use App\Brand;
use App\Category;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //session(['name'=>"热水养花"]);
        //echo session('name');die;

        $pageSize = config('app.pageSize');
        //$pageSize = 5;
        $data = goods::leftjoin('brand', 'goods.brand_id', '=', 'brand.brand_id')
                        ->leftjoin('category', 'goods.cate_id', '=', 'category.cate_id')
                        ->orderby('goods_id', 'desc')
                        ->paginate($pageSize);

        foreach ($data as $v) {
            if ($v->goods_imgs) {
                $v->goods_imgs=explode('|',$v->goods_imgs);
            }
        }
        return view('goods.index', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brandInfo=Brand::all();
        $cateInfo=Category::all();
        $cateInfo=createTree($cateInfo);
        return view('goods/create',['brandInfo'=>$brandInfo,'cateInfo'=>$cateInfo]);
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
        //dd($data);
        $data['add_time']=time();
        //文件上传
        if ($request->hasFile('goods_img')) {
            $data['goods_img']=upload('goods_img');
        }

        //多文件上传
        if ($data['goods_imgs']) {
            $photos=Moreuploads('goods_imgs');
            //dd($photos);
            $data['goods_imgs']=implode('|',$photos);
        }
        
        $res=Goods::insert($data);
        //dd($data);
        if ($res) {
            return redirect('goods/index');
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
        $user=Goods::find($id);

        $brandInfo=Brand::all();
        $cateInfo=Category::all();
        $cateInfo=createTree($cateInfo);
        return view('goods/edit',['user'=>$user,'brandInfo'=>$brandInfo,'cateInfo'=>$cateInfo]);
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
        $res=Goods::where('goods_id',$id)->update($user);
        //文件上传
        if ($request->hasFile('goods_img')) {
            $user['goods_img']=upload('goods_img');
        }

        //多文件上传
        if ($user['goods_imgs']) {
            $photos=Moreuploads('goods_imgs');
            //dd($photos);
            $user['goods_imgs']=implode('|',$photos);
        }
        $res=Goods::insert($user);
        if ($res!==false){
            return redirect('/goods/index');
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
        $res=Goods::destroy($id);
        if ($res) {
            return redirect('goods/index');
        }
    }
}
