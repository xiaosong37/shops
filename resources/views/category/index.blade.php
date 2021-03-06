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
<center><h1>分类表展示</h1></center>

  <table class="table">
	<thead>
		<tr>
			<th>id</th>
			<th>分类名称</th>
			<th>父级</th>
			<th>分类简介</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k=>$v)
		<tr @if($k%2==0)class="active"@else class="success" @endif>
			<td>{{$v->cate_id}}</td>
			<td>{{str_repeat('- -|',$v->level)}}{{$v->cate_name}}</td>
			<td>{{$v->cate_desc}}</td>
			<td><a href="{{url('category/edit/'.$v->cate_id)}}" class="btn btn-info">编辑</a>|
				<a href="{{url('category/destroy/'.$v->cate_id)}}" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach
		
	</tbody>

</table>

</body>
<ml>