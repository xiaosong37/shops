<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Login;

class LoginController extends Controller
{
    public function logindo(Request $request){
    	$user=$request->except('_token');

    	$user['pwd']=md5($user['pwd']);

    	$admin=Login::where($user)->first();
    	
    	if ($admin) {
    		session(['admin'=>$admin]);
    		$request->session()->save();
    		return redirect('/yonghu/list');
    	}
	}
}