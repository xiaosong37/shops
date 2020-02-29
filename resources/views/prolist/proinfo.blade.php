@extends('layout.shop')
@section('title', '详情') 
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
      @if($goods_imgs)
      @php $goods_imgs=explode('|',$goods_imgs)  @endphp
      @foreach($goods_imgs as $v)
                <img src="{{env('UPLOAD_URL')}}{{$v}}" width="40">
      @endforeach
      @endif
     </div><!--sliderA/-->
     <table class="jia-len">
        <tr>
         <th><strong class="orange">{{$data->goods_price}} </strong></th>
         <td>
          <input type="text" class="spinnerExample" />
         </td>
        </tr>
        <tr>
         <td>
          <strong>{{$data->goods_name}}</strong>
          <p class="hui">{{$data->goods_desc}}</p>
         </td>
         <td align="right">
          <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
         </td>
        </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
     <img src="{{env('UPLOAD_URL')}}{{$data->goods_img}}" width="636" height="822" />
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="{{url('index')}}"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a href="{{url('car')}}">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
    
     <!--jq加减-->
    <script src="/static/index/js/jquery.spinner.js"></script>
   <script>
	$('.spinnerExample').spinner({});
	</script>
  </body>
</html>
@endsection