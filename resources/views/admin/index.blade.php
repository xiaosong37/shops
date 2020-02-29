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
<center><h1>品牌列表</h1></center>
  <table class="table">
	<caption>如下</caption>
	<thead>
		<tr>
			<th>id</th>
			<th>管理员名称</th>
			<th>管理员手机号</th>
			<th>管理员邮箱</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k=>$v)
		<tr @if($k%2==0)class="active"@else class="success" @endif>
			<td>{{$v->admin_id}}</td>
			<td>{{$v->admin_name}}</td>
			<td>{{$v->admin_tel}}</td>
			<td>{{$v->admin_mail}}</td>
			<td><a href="{{url('admin/edit/'.$v->admin_id)}}" class="btn btn-info">编辑</a>|
				<a href="{{url('admin/destroy/'.$v->admin_id)}}" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach
	</tbody>

</table>

</body>
<ml>