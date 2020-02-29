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
<center><h1>学生统计表</h1></center>
<form  action="{{url('/student/store')}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
	@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">名字</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="name" id="firstname" 
				   placeholder="请输入名字">
			<b style="color: red">{{$errors->first('name')}}</b>
		</div>
	</div>
		 
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">性别</label>
		<div class="col-sm-8">
			<input type="radio" name="sex" id="optionsRadios1" value="1" >男<br><br>
        	<input type="radio" name="sex" id="optionsRadios1" value="2" checked>女
		</div>
	</div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">照片</label>
		<div class="col-sm-8">
        	<input type="file" name="photo" class="form-control" >
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">班级</label>
		<div class="col-sm-8">
			<select name="class" id="firstname">
				<option>1907</option>
				<option>1908</option>
				<option>1909</option>
				<option>1910</option>
			</select>
		</div>
	</div>
	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">成绩</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name="exam" id="firstname" 
				   placeholder="请输入成绩">
			<b style="color: red">{{$errors->first('exam')}}</b>
		</div>
	</div>

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">添加<tton>
		</div>
	</div>
</form>

</body>
<ml>
