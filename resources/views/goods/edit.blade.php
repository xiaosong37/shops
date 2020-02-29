<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 水平表单</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery/2.1.1/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>修改商品</h1></center>
<hr/>
<form class="form-horizontal" role="form" action="{{url('/goods/update/'.$user->goods_id)}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品名称</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" value="{{$user->goods_name}}" name="goods_name">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">货号</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="firstname" value="{{$user->goods_no}}" name="goods_no">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品价格</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" id="firstname" value="{{$user->goods_price}}" name="goods_price">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品缩略图</label>
        <div class="col-sm-8">
            <input type="file" class="form-control" id="firstname" name="goods_img">
            <img src="{{env('UPLOAD_URL')}}{{$user->goods_img}}" alt="" height="50" width="50">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品相册</label>
        <div class="col-sm-8">
            <input type="file" class="form-control" id="firstname" multiple="multiple" name="goods_imgs">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品库存</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" id="firstname" value="{{$user->goods_num}}" name="goods_num">
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否精品</label>
        <div class="col-sm-8">
            <input type="radio" name="is_best" value="1" @if($user->is_best==1) checked @endif>是
            <input type="radio" name="is_best" value="2" @if($user->is_best==2) checked @endif>否
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">是否热卖</label>
        <div class="col-sm-8">
            <input type="radio" name="is_hot" value="1" @if($user->is_hot==1) checked @endif>是
            <input type="radio" name="is_hot" value="2" @if($user->is_hot==2) checked @endif>否
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">所属品牌</label>
        <div class="col-sm-8">
            <select name="brand_id" id="" class="col-sm-2 control-label">
                <option value="">--请选择--</option>
                @foreach($brandInfo as $v)
                <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">所属分类</label>
        <div class="col-sm-8">
            <select name="cate_id" id="" class="col-sm-2 control-label">
                <option value="">--请选择--</option>
                @foreach($cateInfo as $vv)
                <option value="{{$vv->cate_id}}">{{str_repeat('|--', $vv->level)}}{{$vv->cate_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品描述</label>
        <div class="col-sm-8">
            <textarea name="goods_desc" class="form-control" value="{{$user->goods_desc}}" id="" cols="50" rows="5"></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">修改</button>
        </div>
    </div>
</form>
</body>
</html>