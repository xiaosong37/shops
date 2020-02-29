<!DOCTYPE html>
<html>
<head>
	<title>
		
	</title>
</head>
<body>

<center> 
	<!-- @php $admin=session('admin') @endphp -->
	@if(session('admin')->limit==1)<b><a href="">您是普通管理员</a></b>@else<a href="">您是超级管理员</a>
	@endif
	
<a href="">货物管理</a>
<a href="">出入记录</a>
<a href="{{url('yonghu/index')}}">用户管理</a>
</center>

</body>
</html>