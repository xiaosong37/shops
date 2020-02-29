<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
use Illuminate\Support\Facades\Cookie; 


class IndexController extends Controller
{
	public function setcookie(){
		//return response('测试产生cookie')->cookie('name','热水养花',2);
		//cookie全局辅助函数
		//$cookie=cookie('name','songxialing',2);

		//return response('测试产生cookie2')->cookie($cookie);
		// Cookie::queue(Cookie::make('age', '18', 2));
		Cookie::queue(Cookie::make('number', '100', 2));
	}

    public function index(){
    	//echo "123";die;
    	//echo request()->cookie('name');
    	$value = Cookie::get('age ');
    	echo $value;
    	return view("index/index");
    }


   
}
