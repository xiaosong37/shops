<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//闭包路由

//前台
//index 
Route::get('/','Index\IndexController@index');
Route::view('/login','Index/login');
Route::post('/loginDo','Index\LoginController@loginDo');
Route::view('/reg','Index/reg');
Route::view('/fenxiao','Index/fenxiao');
Route::get('/regDo','Index\LoginController@regDo');
//测试cookie  短信  邮件
Route::get('/setcookie','Index\IndexController@setCookie');
Route::get('/sendsms','Index\LoginController@sendSms');
Route::get('/send','Index\LoginController@ajaxsend');
Route::get('/sendemail','Index\LoginController@sendEmail');
//prolist
Route::get('/prolist','Index\ProlistController@prolist');
Route::get('/proinfo/{id}','Index\ProlistController@proinfo');
//car
Route::view('/car','car/car');
Route::view('/pay','car/pay');
Route::view('/success','car/success');
//user
Route::view('/user','user/user');
Route::view('/address','user/address');
Route::view('/order','user/order');
Route::view('/tixian','user/tixian');
Route::view('/quan','user/quan');
Route::view('/add-address','user/add-address');
Route::view('/shoucang','user/shoucang');





// Route::get('/', function () {
// 	$name = "1908欢迎您";
//     return view('welcome',['name'=>$name]);
// });

Route::get('/show', function () {
	echo "hello";
});
/*
Route::get('user','UserController@index');

Route::get('adduser','UserController@add');

Route::post('adddo','UserController@adddo');
*/


//正则约束
Route::get('/goods/{id}',function($goods_id){
	echo "商品ID：";
	echo $goods_id;
});
Route::get('/show/{id}',function($goods_id){
	echo "id:";
	echo $goods_id;
});
Route::get('/goods/{id}/{name}',function($goods_id,$name){
	echo "商品ID：";
	echo $goods_id;
	echo "商品名称";
	echo $name;
})->where(['id'=>'\d+','name'=>'\w+']);

//外来务工人员统计
Route::prefix('people')->middleware('checkLogin')->group(function(){
	Route::get('create','PeopleController@create');
	Route::post('store','PeopleController@store');
	Route::get('index','PeopleController@index');
	Route::get('edit/{id}','PeopleController@edit');
	Route::post('update/{id}','PeopleController@update');
	Route::get('destroy/{id}','PeopleController@destroy');
});
/*中间件
Route::view('/login','login');
Route::post('/logindo','LoginController@logindo');
*/

//学生表的增删改查
Route::prefix('student')->group(function(){
	Route::get('create','StudentController@create');
	Route::post('store','StudentController@store');
	Route::get('index','StudentController@index');
	Route::get('edit/{id}','StudentController@edit');
	Route::post('update/{id}','StudentController@update');
	Route::get('destroy/{id}','StudentController@destroy');
});


//品牌表的ORM增删改查
Route::prefix('brand')->group(function(){
	Route::get('create','BrandController@create');
	Route::post('store','BrandController@store');
	Route::get('index','BrandController@index');
	Route::get('edit/{id}','BrandController@edit');
	Route::post('update/{id}','BrandController@update');
	Route::get('destroy/{id}','BrandController@destroy');
});

//文章表的ORM的增删改查
Route::prefix('essay')->group(function(){
	Route::get('create','EssayController@create');
	Route::post('store','EssayController@store');
	Route::post('checkOnly','EssayController@checkOnly');
	Route::get('index','EssayController@index');
	Route::get('edit/{id}','EssayController@edit');
	Route::post('update/{id}','EssayController@update');
	Route::get('destroy/{id}','EssayController@destroy');
});

//分类表的ORM增删改查
Route::prefix('category')->group(function(){
	Route::get('create','CategoryController@create');
	Route::post('store','CategoryController@store');
	Route::get('index','CategoryController@index');
	Route::get('edit/{id}','CategoryController@edit');
	Route::post('update/{id}','CategoryController@update');
	Route::get('destroy/{id}','CategoryController@destroy');
});

//商品表的ORM增删改查
Route::prefix('goods')->group(function(){
	Route::get('create','GoodsController@create');
	Route::post('store','GoodsController@store');
	Route::get('index','GoodsController@index');
	Route::get('edit/{id}','GoodsController@edit');
	Route::post('update/{id}','GoodsController@update');
	Route::get('destroy/{id}','GoodsController@destroy');
});

//商品表的ORM增删改查
Route::prefix('admin')->group(function(){
	Route::get('create','AdminController@create');
	Route::post('store','AdminController@store');
	Route::get('index','AdminController@index');
	Route::get('edit/{id}','AdminController@edit');
	Route::post('update/{id}','AdminController@update');
	Route::get('destroy/{id}','AdminController@destroy');
});

//用户表的ORM增删改查
Route::prefix('yonghu')->group(function(){
	Route::get('list','YonghuController@list');
	Route::get('create','YonghuController@create');
	Route::post('store','YonghuController@store');
	Route::get('index','YonghuController@index');
	Route::get('edit/{id}','YonghuController@edit');
	Route::post('update/{id}','YonghuController@update');
	Route::get('destroy/{id}','YonghuController@destroy');
});
