<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
<center><h1>添加文章表</h1></center>



<form  action="{{url('/essay/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="name" id="firstname" 
				   placeholder="请输入名字">
				   <b style="color: red">{{$errors->first('name')}}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-8">
			<select name="cate">
				<option>请选择</option>
				<option id="1">散文</option>
				<option id="2">文言文</option>
				<option id="3">小说</option>
				<option id="4">神话</option>
				<option id="5">名著</option>
			</select>
			<b style="color: red">{{$errors->first('cate')}}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章重要性</label>
		<div class="radio">
    <label>
        <input type="radio" name="important" id="optionsRadios1" value="1" checked>普通<br><br>
        <input type="radio" name="important" id="optionsRadios1" value="2" >置顶
        <b style="color: red">{{$errors->first('important')}}</b>
    </label>
</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
		<div class="radio">
    <label>
        <input type="radio" name="show" id="optionsRadios1" value="1" checked>显示<br><br>
        <input type="radio" name="show" id="optionsRadios1" value="2" >不显示
        
    </label>
</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="people" id="firstname" 
				   placeholder="请输入文章作者">
				   <b style="color: red">{{$errors->first('age')}}</b>
		</div>
	</div>
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">作者email</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="email" id="firstname" 
				   placeholder="请输入作者email">
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="keyword" id="firstname" 
				   placeholder="请输入文章关键字">
		</div>
	</div>
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章简介</label>
		<div class="col-sm-8">
			<textarea name="desc"></textarea>
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-8">
			<input type="file" name="photo" class="form-control"  
				   >
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default">添加<tton>
		</div>
	</div>
</form>
</body>
<script>

	$.ajaxSetup({headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')}});
	//提交按钮的验证
	$('button[type="button"]').click(function(){
		var titleflag=true;
		$('input[name="name"]').next().html('');
		//标题验证
		var name=$('input[name="name"]').val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z]+$/;
		if (!reg.test(name)) {
			$(this).next().html('文章标题由中文字母数字组成不能为空');
			return;
		}

		//验证唯一性
		$.ajax({
			type:'post',
			url:"/essay/checkOnly",
			data:{name:name},
			async:false,
			dataType:'json',
			success:function(result){
				if (result.count>0) {
					$('input[name="name"]').next().html('标题已存在');
					titleflag=false;
				}
			}
		});
		if (!titleflag) {
			return;//阻止
		}

		//作者验证
		var people = $('input[name="people"]').val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z]{2,8}$/;
		if (!reg.test(people)) {
			$('input[name="people"]').next().html('文章作者由中文字母数字组成不能为空长度为2,8');
			return;
		}
		//form  提交
		$('form').submit();
	});

	//单个文章作者的验证
	$('input[name="people"]').blur(function(){
		$(this).next().html('');
		var people = $(this).val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z]{2,8}$/;
		if (!reg.test(people)) {
			$(this).next().html('文章作者由中文字母数字组成不能为空长度为2,8');
			return;
		}
	})

	//单个文章名字的验证
	$('input[name="name"]').blur(function(){
		$(this).next().html('');
		var name = $(this).val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z]+$/;
		if (!reg.test(name)) {
			$(this).next().html('文章标题由中文字母数字组成不能为空');
			return;
		}

	//验证唯一性
	$.ajax({
		type:"post",
		url:"/essay/checkOnly",
		data:{name:name},
		//async:true,
		dataType:"json",
		success:function(result){
			if (result.count>0) {
				$('input[name="title"]').next().html("标题已存在");
			}
		}
	});
		
	})
</script>
<ml>