<!DOCTYPE html>
<html>
<head>
	<title>
		用户表
	</title>
</head>
<body>
<table border="2">
	<a href="">管理员</a>
	<tr>
		<td>用户id</td>
		<td>用户名称</td>
		<td>用户属性</td>
		<td>货物管理</td>
		<td>出入库记录管理</td>
		<td>操作</td>
	</tr>
	@foreach ($data as $k=>$v)
	<tr>
		<td>{{$v->id}}</td>
		<td>{{$v->name}}</td>
		<td>{{$v->people==1?'库管主管':'普通管理员'}}</td>
		<td>{{$v->goods}}</td>
		<td>{{$v->car}}</td>
		<td>
			<a href="{{url('yonghu/destroy/'.$v->id)}}">删除</a>|
			<a href="{{url('yonghu/update/'.$v->id)}}">编辑</a>|
			<a href="{{url('yonghu/create/')}}">添加</a>
		</td>
	</tr>
	@endforeach
</table>
</body>
</html>