<?php

/**
 * 公用的方法  返回json数据，进行信息的提示
 * @param $status 状态
 * @param string $message 提示信息
 * @param array $data 返回数据
 */
function showMsg($status,$message = '',$data = array()){
    $result = array(
        'status' => $status,
        'message' =>$message,
        'data' =>$data
    );
    exit(json_encode($result));
}
/*
    无限极分类
     */
    function createTree($data,$p_id=0,$level=1){
        static $arr=[];
        if (!$data) {
            return;
        }
        foreach ($data as $k=>$v) {
            if ($v->p_id==$p_id) {
                $v->level=$level;
                $arr[]=$v;
                createTree($data,$v->cate_id,$level+1);
            }
        }
        return $arr;
    }
    /*
    上传文件  单
     */
    function upload($filename){
        //判断上传中有没有错
        if (request()->file($filename)->isValid()) {
            //接收值
            $photo = request()->file($filename);
            //上传
            $store_result = $photo->store('uploads');//文件位置
            return $store_result;
        }
        exit('未获取到上传文件或上传过程出错');
    }
    //多个文件上传
    function Moreuploads($filename){
       $photo = request()->file($filename);
       if(!is_array($photo)){
         return;
       } 
       // dd($photo);
       foreach( $photo as $v ){
          if ($v->isValid()){
            $store_result[] = $v->store('uploads');
          }
       }
         
       return $store_result;
    }