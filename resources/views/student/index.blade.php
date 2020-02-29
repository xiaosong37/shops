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
<center><h1>学生统计列表</h1></center>
<form>
	<input type="text" name="name" value="{{$name}}" placeholder="请输入姓名">
	<input type="text" name="exam" value="{{$exam}}" placeholder="请输入成绩">
	<input type="submit" value="搜索">
</form>
  <table class="table">
	<caption>上下文表格布局</caption>
	<thead>
		<tr>
			<th>id</th>
			<th>姓名</th>
			<th>性别</th>
			<th>班级</th>
			<th>照片</th>
			<th>成绩</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k=>$v)
		<tr @if($k%2==0)class="active"@else class="success" @endif>
			<td>{{$v->id}}</td>
			<td>{{$v->name}}</td>
			<td>{{$v->sex==1?'男':'女'}}</td>
			<td>{{$v->class}}</td>
			<td><img src="{{env('UPLOAD_URL')}}{{$v->photo}}" width="40" height="40"></td>
			<td>{{$v->exam}}</td>
			<td><a href="{{url('student/edit/'.$v->id)}}" class="btn btn-info">编辑</a>|
				<a href="{{url('student/destroy/'.$v->id)}}" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach
		<tr><td colspan="7">{{$data->appends(['name'=>$name,'exam'=>$exam])->links()}}</td></tr>
	</tbody>
</table>
</body>
<ml>
<script>
	//ajax分页
	//$('.pagination a').click(function(){
	$(document).on('click','.pagination a',function(){
		var url=$(this).attr('href');
		if (!url) {
			return;
		}
		$.get(url,function(result){
			$('tbody').html(result);
		});
		return false;
	})
</script>