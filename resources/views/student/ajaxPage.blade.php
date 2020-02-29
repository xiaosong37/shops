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