<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Essay;

use Illuminate\Support\Facades\Cache;

class EssayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page=request()->page??1;
        $name=request()->name??'';
        $cate=request()->cate??'';
        $where=[];
            if ($name) {
                $where[]=['name','like',"%$name%"];
            }
            if ($cate) {
                $where[]=['cate','like',"%$cate%"];
            }
        //获取缓存值
        $data=Cache::get('essay'.$page.$name.$cate); //门面
        //$data=cache('essay_'.$page);  //
         
        dump($data);
        if (!$data) {
            echo "走DB==";
            
            $pageSize = 4;
            //echo $pageSize;
            $data=Essay::where($where)->orderby('id','desc')->paginate($pageSize);
            //dd($data);
            
            //cache(['essay'=>$data],60*60*24);
            Cache::put('essay'.$page.$name.$cate,$data,60*60*24);
        }
        return view('essay.index',['data'=>$data,'name'=>$name,'cate'=>$cate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('essay.create');
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
            'name' => 'required|unique:essay|regex:/^[\x{4e00}-\x{9fa5}]+$/u',
            'important' => 'required',
            'cate' => 'required',
         ],[
            'name.required'=>'文章标题不能为空',
            'name.unique'=>'文章标题已存在',
            'name.regex'=>'文章标题只能为汉字',
            'important.required'=>'重要性不能为空',
            'cate.required'=>'分类不能为空',
         ]);

        $data=$request->except('_token');
        $data['add_time']=time();
        //文件上传
        if ($request->hasFile('photo')) {
            $data['photo']=upload('photo');
        }
        $res=Essay::insert($data);
        //dd($res);
        if ($res) {
            return redirect('essay/index');
        }
    }


    public function checkOnly(){
        $name=request()->name;
        $where=[];
        if ($name) {
            $where[]=['name','=',$name];
        }
        //排除自身   修改时需要
        $n_id=request()->id;
        if ($n_id) {
            $where[]=['id','!=',$n_id];
        }
        $count=Essay::where($where)->count();
        \DB::connection()->enableQueryLog();
        $logs = \DB::getQueryLog();
        dd($logs);
        
        echo json_encode(['code'=>'00000','msg'=>'ok','count'=>$count]);
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
        $user=Essay::find($id);
        return view('essay.edit',['user'=>$user]);
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
        $user = $request->except('_token');
        //文件上传
        if ($request->hasFile('photo')) { 
            $user['photo']=upload('photo');
            //dd($img);
        }
        $res=Essay::where('id',$id)->update($user);
        if ($res!==false) {
            return redirect('/essay/index');
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
        $res=Essay::destroy($id);
        /*普通的
        if ($res) {
            return redirect('/essay/index');
        }
        */
       if ($res) {
           echo json_encode(['code'=>'00000','msg'=>'ok']);
       }
    }
}
