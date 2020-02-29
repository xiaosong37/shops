<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//use DB;
use App\People;
use App\Http\Requests\StorePeoplePost;
use Validator;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *列表页展示
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $username=request()->username??'';
        $where=[];
        if ($username) {
            $where[]=['username','like',"%$username%"];
        }
        /*DB*/
        //$data = DB::table('people')->select('*')->get();
        /*ORM*/
        //$data=People::all();
        // $data=People::get();
        $pageSize = config('app.pageSize');
        //echo $pageSize;
        $data=People::where($where)->orderby('p_id','desc')->paginate($pageSize);
        //dd($data);
        return view('people.index',['data'=>$data,'username'=>$username]);
    }

    /**
     * Show the form for creating a new resource.
     *添加页面
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('people.create');
    }

    /**
     * Store a newly created resource in storage.
     *执行添加
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    //public function store(StorePeoplePost $request)
    {
        //第一种验证
        /*
        $request->validate([ 
            'username' => 'required|unique:people|max:12|min:2',
            'age' => 'required|integer|min:1|max:3',
         ],[
            'username.required'=>'名字不能为空',
            'username.unique'=>'名字已存在',
            'username.max'=>'名字长度不能超12位',
            'username.min'=>'名字长度不少于2位',
            'age.required'=>'年龄不能为空',
            'age.integer'=>'年龄必须为数字',
            'age.min'=>'年龄数据不合法',
            'age.required'=>'年龄数据不合法',
         ]);
         */
        $data = $request->except('_token');
        //dd($data);

        //第三种验证
        $validator = Validator::make($data,[ 
            'username' => 'required|unique:people|max:12|min:2',
            'age' => 'required|integer|between:1,130',
            ],[
            'username.required'=>'名字不能为空',
            'username.unique'=>'名字已存在',
            'username.max'=>'名字长度不能超12位',
            'username.min'=>'名字长度不少于2位',
            'age.required'=>'年龄不能为空',
            'age.integer'=>'年龄必须为数字',
            'age.between'=>'年龄数据不合法',
         ]);
        if ($validator->fails()){ 
            return redirect('people/create')
                ->withErrors($validator) 
                ->withInput(); 
        }

        //文件上传
        if ($request->hasFile('head')) { 
            $data['head']=upload('head');
            //dd($img);
        }
        $data['add_time']=time();
        //DB
        //$res = DB::table('people')->insert($data);
        /*ORM*/ 
        // $people= new People;
        // $people->username=$data['username'];
        // $people->age=$data['age'];
        // $people->card=$data['card'];
        // $people->head=$data['head'];
        // $people->add_time=$data['add_time'];
        // $res=$people->save();
        //ORM create
        //$res = People::create($data);
        $res = People::insert($data);
        //dd($res);
        if ($res) {
            return redirect('people/index');
        }
    }
    
    /**
     * Display the specified resource.
     *预览详情页
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *编辑页面
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*ORM*/
        //$user = DB::table('people')->where('p_id',$id)->first();
        //$user = People::where('p_id',$id)->first();
        $user=People::find($id);
        return view('people.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *执行编辑
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = $request->except('_token');

         //文件上传
        if ($request->hasFile('head')) { 
            $user['head']=upload('head');
            //dd($img);
        }
        /*ORM*/
        //$res = DB::table('people')->where('p_id',$id)->update($user);
        /*ORM操作*/
        // $people=People::find($id);
        // $people->username=$user['username'];
        // $people->age=$user['age'];
        // $people->card=$user['card'];
        // $people->head=$user['head']??'';
        // $res=$people->save();
        
        $res=People::where('p_id',$id)->update($user);
        if ($res!==false) {
            return redirect('/people/index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *删除
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        /*ORM*/
        //$res = DB::table('people')->where('p_id',$id)->delete();
        $res=People::destroy($id);
        if ($res) {
            return redirect('/people/index');
        }
    }
}
