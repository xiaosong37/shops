@extends('layout.shop')
@section('title', '分享') 
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>分销申请</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="static/index/images/head.jpg" />
     </div><!--head-top/-->
     <div class="fenxiao">
      <div class="fen-text1">欢迎加入<span class="f60">三级分销</span>，请填写申请信息！</div>
      <div class="fen-text1">邀请人：<span class="f60">王大力</span>(请核对)</div>
      <form action="#" method="get" class="fenxiaoinput">
       <input type="text" placeholder="请填写真实姓名，用于佣金结算" />
       <input type="text" placeholder="请填写手机号码方便联系" />
       <input type="submit" value="申请成为分销商" class="fensub" />
      </form>
      <div class="fen-text1">分销商特权</div>
      <div class="fen-list">
       <dl>
        <dt><img src="static/index/images/fen1.jpg" /></dt>
        <dd>
         <h3>独立微店</h3>
         <p>拥有自己的微店及推广二维码；</p>
        </dd>
        <div class="clearfix"></div>
       </dl>
       <dl>
        <dt><img src="static/index/images/fen2.jpg" /></dt>
        <dd>
         <h3>销售拿佣金</h3>
         <p>微店卖出商品，您可以获得佣金；</p>
        </dd>
        <div class="clearfix"></div>
       </dl>
      </div><!--fen-list/-->
     </div><!--fenxiao/-->
     
     <div class="height1"></div>
     <div class="footNav">
      <dl>
       <a href="index.html">
        <dt><span class="glyphicon glyphicon-home"></span></dt>
        <dd>微店</dd>
       </a>
      </dl>
      <dl>
       <a href="prolist.html">
        <dt><span class="glyphicon glyphicon-th"></span></dt>
        <dd>所有商品</dd>
       </a>
      </dl>
      <dl>
       <a href="car.html">
        <dt><span class="glyphicon glyphicon-shopping-cart"></span></dt>
        <dd>购物车 </dd>
       </a>
      </dl>
      <dl>
       <a href="user.html">
        <dt><span class="glyphicon glyphicon-user"></span></dt>
        <dd>我的</dd>
       </a>
      </dl>
      <div class="clearfix"></div>
     </div><!--footNav/-->
    </div><!--maincont-->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="static/index/js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="static/index/js/bootstrap.min.js"></script>
    <script src="static/index/js/style.js"></script>
    <!--焦点轮换-->
    <script src="static/index/js/jquery.excoloSlider.js"></script>
    <script>
		$(function () {
		 $("#sliderA").excoloSlider();
		});
	</script>
  </body>
</html>
@endsection