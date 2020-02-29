<!DOCTYPE html>
<html>
<head>
	<title>添加</title>
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<form action="{{url('yonghu/store')}}" method="post">
	@csrf
	用户名称<input type="text" name="name"><br>
	用户属性<input type="radio" name="people" value="1">超级管理员
			<input type="radio" name="people" value="2">普通管理员<br>
	货物管理<input type="text" name="goods"><br>
	出入记录<input type="text" name="car"><br>
	<input type="submit" value="添加" >
</form>
</body>
</html>
<script>
	$('input[name="name"]').click(function(){
		//alert(123);
	})
</script>