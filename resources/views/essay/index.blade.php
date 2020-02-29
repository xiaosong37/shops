<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
<body>
</head>
<center><h1>文章的展示列表</h1></center>
<form>
	<select name="cate">
				<option>请选择</option>
				<option id="1">散文</option>
				<option id="2">文言文</option>
				<option id="3">小说</option>
				<option id="4">神话</option>
				<option id="5">名著</option>
			</select>
	<input type="text" name="name" value="{{$name ?? ''}}" placeholder="请输入文章">
	<input type="submit" value="搜索">
</form>

  <table class="table">
	<caption>上下文表格布局</caption>
	<thead>
		<tr>
			<th>id</th>
			<th>文章标题</th>
			<th>文章分类</th>
			<th>文章重要性</th>
			<th>是否显示</th>
			<th>添加时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach($data as $k=>$v)
		<tr @if($k%2==0)class="active"@else class="success" @endif>
			<td>{{$v->id}}</td>
			<td>{{$v->name}}</td>
			<td>{{$v->cate}}</td>
			<td>{{$v->important}}</td>
			<td>{{$v->show==1?'√':'×'}}</td>
			<td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
			<td><a href="{{url('essay/edit/'.$v->id)}}" class="btn btn-info">编辑</a>|
				<a href="javascript:void(0)" onclick="del('{{$v->id}}')" class="btn btn-danger">删除</a>
			</td>
		</tr>
		@endforeach

		<tr><td colspan="7">{{$data->appends(['name'=>$name ?? '','cate'=>$cate])->links()}}</td></tr>
	</tbody>

</table>
</body>
<script>
	//ajax删除
	function del(id){
		if (!id) {
			return;
		}
		if (confirm('是否要删除此条记录')) {
			//ajax删除
			$.get('/essay/destroy/'+id,function(result){
				if (result.code=='00000') {
					location.reload();
				}
			},'json')
		}
	}	
</script>
<ml>