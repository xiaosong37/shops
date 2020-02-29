<?php

namespace App\Http\Controllers\index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Goods;

class ProlistController extends Controller
{
    public function prolist(){
    	$data=Goods::all();
    	//dd($data);
    	return view('prolist/prolist',['data'=>$data]);
    }

    public function proinfo($id){
    	$data=Goods::where('goods_id',$id)->first();
    	//dd($data);
        $goods_imgs=Goods::limit(4)->select('goods_imgs')->get();
    	return view('prolist/proinfo',['data'=>$data,'goods_imgs'=>$goods_imgs]);
    }
        
}
