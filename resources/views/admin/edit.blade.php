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
<center><h1>管理员添加</h1></center>
<form  action="{{url('/admin/update/'.$user->admin_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="admin_name" id="firstname" 
				  value="{{$user->admin_name}}">
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员手机号</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="admin_tel" id="firstname" value="{{$user->admin_tel}}">
		</div>
	</div>
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员邮箱</label>
		<div class="col-sm-8">
			<input type="mail" class="form-control" name="admin_mail" id="firstname" 
				   value="{{$user->admin_mail}}">
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">修改<tton>
		</div>
	</div>
</form>

</body>
<ml>