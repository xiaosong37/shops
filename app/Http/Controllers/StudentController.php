<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Illuminate\validation\Rule;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //接受当前页页码
        $page=request()->page??1;
        $name=request()->name??'';
        $exam=request()->exam??'';
        $where=[];
        if ($name) {
            $where[]=['name','like',"%$name%"];
        }
        if ($exam) {
            $where[]=['exam','like',"%$exam%"];
        }

        
        //获取缓存值
        //$data=Cache::get('student_'.$page.'_'.$name.'_'.$exam);
        //dd($data);die;
        
        $data=Redis::get('student_'.$page.'_'.$name.'_'.$exam);     //门面
        //dd($data);
        if (!$data) {
            echo "123";
            $pageSize=config('app.pageSize');
            $data=DB::table('student')->where($where)->paginate($pageSize);
            //dd($data);die;

        //存入缓存
        //Cache::put('student_'.$page.'_'.$name.'_'.$exam,$data,60*60*24);
        //Cache::flush();
        
        //序列化结果集  讲object转化为字符串
        $data=serialize($data);
        Redis::setex('student_'.$page.'_'.$name.'_'.$exam,60,$data);
        }

        //反序列化结果集   将字符串转化为object对象
        $data=unserialize($data);

        //获取搜索所有条件
        $query=request()->all();
        //是ajax请求   既要实现ajax分页
        if (request()->ajax()) {
            return view('student.ajaxPage',['data'=>$data,'name'=>$name,'exam'=>$exam,'query'=>request()->all()]);
        }
        return view('student/index',['data'=>$data,'name'=>$name,'exam'=>$exam,'query'=>request()->all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student/create');
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
            'name' => 'required|unique:student|max:12|min:2|regex:/^[\x{4e00}-\x{9fa5}]+$/u',
            'sex' => 'required|between:1,100',
            'exam' => 'required|between:0,100'
         ],[
            'name.required'=>'名字不能为空',
            'name.unique'=>'名字已存在',
            'name.max'=>'名字长度不能超12位',
            'name.min'=>'名字长度不少于2位',
            'name.regex'=>'名字必须为汉字',
            'exam.required'=>'成绩不能为空',
            'exam.required'=>'成绩在0~100之间',
         ]);
        
        $data=$request->except('_token');
        //dd($data);
        
        //文件上传
        if ($request->hasFile('photo')) {
            $data['photo']=$this->upload('photo');
        }
        $res=DB::table('student')->insert($data);
        if ($res) {
            return redirect('student/index');
        }
    }

    /*
    文件上传
     */
    public function upload($filename){
        //判断上传中有没有错
        if (request()->file($filename)->isValid()){
            //接收值
            $photo=request()->file($filename);
            //上传
            $store_result=$photo->store('uploads');//文件位置
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
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
        $data=DB::table('student')->where('id',$id)->first();
        return view('student.edit',['data'=>$data]);
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
        //验证
        $request->validate([ 
            'name' =>[ 'required','max:12','min:2','regex:/^[a-zA-Z][a-zA-Z0-9_]{3,10}$/',
            Rule::unique("student")->ignore($id,'id'),
        ],
            'sex' => 'required|between:1,100',
            'exam' => 'required|between:0,100'
         ],[
            'name.required'=>'名字不能为空',
            'name.unique'=>'名字已存在',
            'name.max'=>'名字长度不能超12位',
            'name.min'=>'名字长度不少于2位',
            'name.regex'=>'名字必须为汉字',
            'exam.required'=>'成绩不能为空',
            'exam.required'=>'成绩在0~100之间',
         ]);
        $data=$request->except('_token');
        $res=DB::table('student')->where('id',$id)->update($data);
        if ($res!==false) {
            return redirect('/student/index');
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
        $res=DB::table('student')->where('id',$id)->delete();
        if ($res) {
            return redirect('/student/index');
        }
    }
}
