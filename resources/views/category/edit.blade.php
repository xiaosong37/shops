<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><h1>分类表</h1></center>
<form  action="{{url('/category/update/'.$user->cate_id)}}" method="post" class="form-horizontal" role="form">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" value="{{$user->cate_name}}" name="cate_name" id="firstname" 
				   placeholder="请输入分类名称">
			<b style="color: red">{{$errors->first('cate_name')}}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类</label>
		<div class="col-sm-8">
			<select name="p_id">
				<option value="0">--请选择父级分类--</option>
				@foreach($data as $v)
				<option value="{{$v->cate_id}}">{{str_repeat('--|',$v->level)}}{{$v->cate_name}}</option>
				@endforeach
			</select>
		</div>
	</div>
		 
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类介绍</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="cate_desc" value="{{$user->cate_desc}}" id="firstname" 
				   placeholder="请输入分类简介">
			<b style="color: red">{{$errors->first('cate_desc')}}</b>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改<tton>
		</div>
	</div>
</form>
<script>
	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	var id="{{$user->cate_id}}";//
		//提交按钮的验证
	$('button[type="button"]').click(function(){
		//定义title标识   唯一性
		var titleflag=true;
		$('input[name="cate_name"]').next().html('');
		//标题验证
		var name=$('input[name="cate_name"]').val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z]+$/;
		if (!reg.test(name)) {
			$(this).next().html('分类由中文字母数字组成不能为空');
			return;
		}

		//验证唯一性
		$.ajax({
			type:'post',
			url:"/category/checkOnly",
			data:{name:name,id:id},
			async:false,
			dataType:'json',
			success:function(result){
				if (result.count>0) {
					$('input[name="cate_name"]').next().html('分类已存在');
					titleflag=false;
				}
			}
		});
		if (!titleflag) {
			return;//阻止
		}
		
		//form  提交
		$('form').submit();
	});


	//单个文章名字的验证
	$('input[name="cate_name"]').blur(function(){
		$(this).next().html('');
		var name = $(this).val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z]+$/;
		if (!reg.test(name)) {
			$(this).next().html('分类由中文字母数字组成不能为空');
			return;
		}

	//验证唯一性
	$.ajax({
		type:"post",
		url:"/essay/checkOnly",
		data:{name:name,id:id},
		//async:true,
		dataType:"json",
		success:function(result){
			if (result.count>0) {
				$('input[name="cate_name"]').next().html("分类已存在");
			}
		}
	});
		
	})
</script>
</body>
<ml>
