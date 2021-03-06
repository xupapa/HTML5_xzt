<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="no-js">
<head>
	 <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport"
        content="width=device-width, initial-scale=1">
  <title>碎评</title>

  <!-- Set render engine for 360 browser -->
  <meta name="renderer" content="webkit">

  <!-- No Baidu Siteapp-->
  <meta http-equiv="Cache-Control" content="no-siteapp"/>

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Amaze UI"/>

  <!-- Tile icon for Win8 (144x144 + tile color) -->
  <meta name="msapplication-TileColor" content="#0e90d2">

  <link rel="stylesheet" href="/broken/Public/home/css/amazeui.min.css">
  <link rel="stylesheet" href="/broken/Public/home/css/app.css">
  <link rel="stylesheet" href="/broken/Public/home/css/bottom.css">
  <link rel="stylesheet" href="/broken/Public/home/css/nav.css">
  <link rel="stylesheet" href="/broken/Public/home/css/content.css">
  <link rel="stylesheet" href="/broken/Public/home/css/post.css">
  <script src="/broken/Public/home/js/jquery.min.js"></script>
  <script src="/broken/Public/home/js/amazeui.min.js"></script>
<style type="text/css">
	
</style>
</head>
<body>
<!--导航栏-->
	<header class="am-topbar am-topbar-fixed-top">
	<div>
		<div class="am-g">
			<div class="am-u-sm-2" id="sm2">
				<a href="index.html" class="am-btn am-btn-lg">
					<i class="am-icon-home am-icon-sm"></i>
				</a>
			</div>
			<div class="am-u-sm-7" id="sm7">
				<a href="index.html" class="am-text-ir">logo</a>
			</div>
			<div class="am-u-sm-1" id="sm1"></div>
			<div class="am-u-sm-2" id="smu2">
				<a href="shop_search.html" class="am-btn am-btn-lg">
					<i class="am-icon-search am-icon-sm"></i>
				</a>

			</div>
		</div>
	</div>
	</header>
  
	<!--列表-->
	<div class="content">
	<?php if(is_array($sellertab)): $i = 0; $__LIST__ = array_slice($sellertab,0,null,true);if( count($__LIST__)==0 ) : echo "抱歉，暂时没有店铺信息。" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><!--1-->
		<div class="am-g" id="list">
		  <div class="am-u-sm-7" id="list_img">
		  	<img src="/broken/Public/home/images/<?php echo ($v["simage"]); ?>">
		  </div>
		  <div class="am-u-sm-5" id="list_text">
			  <div class="am-g">
			    <div class="am-u-sm-12" id="list-title"><h3><?php echo ($v["shopname"]); ?></h3></div>
			  </div>
			  <div class="am-g">
			    <div class="am-u-sm-12" id="list-content">
			      <p class="am-serif">地址：<?php echo ($v["introduce"]); ?></p>
			    </div>
			  </div>
		  </div>
		</div><?php endforeach; endif; else: echo "抱歉，暂时没有店铺信息。" ;endif; ?>
	</div>
	
<!--底部导航条-->
  <div class="am-topbar am-topbar-fixed-bottom" id="nav">
        <ul class="am-nav am-nav-pills am-nav-justify">
          <li><a href="<?php echo U('Home/Life/match');?>"><i class="am-icon am-icon-gift am-icon-md"></i><br>搭配</a></li>
          <li><a href="<?php echo U('Home/Life/beauty');?>"><i class="am-icon am-icon-medkit am-icon-md"></i><br>美妆</a></li>
          <li><a href="<?php echo U('Home/Life/book');?>"><i class="am-icon am-icon-columns am-icon-md"></i><br>阅读</a></li>
          <li><a href="<?php echo U('Home/Life/post');?>"><i class="am-icon am-icon-bolt am-icon-md"></i><br>快递</a></li>
        </ul>
    </div>

<script>
  $(function() {
    var $slider = $('#demo-slider-0');
    var counter = 0;
    var getSlide = function() {
      counter++;
      return '<li><img src="http://s.amazeui.org/media/i/demos/bing-' +
        (Math.floor(Math.random() * 4) + 1) + '.jpg" />' +
        '<div class="am-slider-desc">动态插入的 slide ' + counter + '</div></li>';
    };

    $('.js-demo-slider-btn').on('click', function() {
      var action = this.getAttribute('data-action');
      if (action === 'add') {
        $slider.flexslider('addSlide', getSlide());
      } else {
        var count = $slider.flexslider('count');
        count > 1 && $slider.flexslider('removeSlide', $slider.flexslider('count') - 1);
      }
    });

  });
</script>

</body>
</html>