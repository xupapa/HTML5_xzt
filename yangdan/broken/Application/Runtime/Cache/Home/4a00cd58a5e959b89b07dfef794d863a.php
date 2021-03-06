<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
	<title>下单页</title>
	<meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="viewport"
        content="width=device-width, initial-scale=1">


  <!-- Set render engine for 360 browser -->
  <meta name="renderer" content="webkit">

  <!-- No Baidu Siteapp-->
  <meta http-equiv="Cache-Control" content="no-siteapp"/>

  <link rel="icon" type="image/png" href="i/favicon.png">

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="i/app-icon72x72@2x.png">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Amaze UI"/>
  <link rel="apple-touch-icon-precomposed" href="i/app-icon72x72@2x.png">

  <!-- Tile icon for Win8 (144x144 + tile color) -->
  <meta name="msapplication-TileImage" content="i/app-icon72x72@2x.png">
  <meta name="msapplication-TileColor" content="#0e90d2">

  <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
  <!--
  <link rel="canonical" href="http://www.example.com/">
  -->

  <link rel="stylesheet" href="/broken/Public/home/css/amazeui.min.css">
  <link rel="stylesheet" href="/broken/Public/home/css/app.css">
  <link rel="stylesheet" href="/broken/Public/home/css/nav.css"/>
  <link rel="stylesheet" href="/broken/Public/home/css/choose.css">
  <script src="/broken/Public/home/js/jquery.min.js"></script>
<!--<![endif]-->
<script src="/broken/Public/home/js/amazeui.min.js"></script>

</head>
<body>
		<header class="am-topbar am-topbar-fixed-top">
        
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
                    <a href="" class="am-btn am-btn-lg">
                        <i class="am-icon-refresh am-icon-sm"></i>
                    </a>
                </div>

                
            </div>
        </header>
    		<!--底部导航条-->
		<header class="am-topbar am-topbar-fixed-bottom">
		<ul class="am-nav am-nav-pills am-nav-justify">
		  <li ><a onclick="history.go(-1)">返回</a></li>
		  
		</ul>
		</header>
		<div class ="page" >
			<div class="head">
				<!-- 空 -->
			</div>
			<div  class="content" >
				<div class="first">
					<div class="top_left">
						<a href="http://sjz.meituan.com/?utm_campaign=baidu&utm_medium=organic&utm_source=baidu&utm_content=homepage&utm_term=" data-role="button"><img src="/broken/Public/home/images/meituan.jpg" ></a>
					</div>
					<div class="top_right">
						<a href="https://m.nuomi.com" data-role="button"><img src="/broken/Public/home/images/nuomi.png"></a>
					</div>
				</div>
				
				<div class="second"> 
					<div class="mid_left">
						<a href="https://m.dianping.com" data-role="button"><img src="/broken/Public/home/images/dianping.png"></a>
					</div>
					<div class="mid_right">
						<a href="https://www.alipay.com" data-role="button"><img src="/broken/Public/home/images/zhifubao.png"></a>
					</div>
				</div>
				<div class="third">
					<div class="bottom_left">
						<a href="https://map.baidu.com" data-role="button"><img src="/broken/Public/home/images/ditu.png"></a>
					</div>
					<div class="bottom_right">
						<a href="#" data-role="button"><img src="/broken/Public/home/images/more.jpg" data-am-modal="{target: '#my-alert'}"></a>
					</div>
				</div>
				<div class="am-modal am-modal-alert" tabindex="-1" id="my-alert">
				  <div class="am-modal-dialog">
				    <div class="am-modal-hd">哎呀！</div>
				    <div class="am-modal-bd">
				      没别的了...
				    </div>
				    <div class="am-modal-footer">
				      <span class="am-modal-btn">哦</span>
				    </div>
				  </div>
				</div>
		</div>
	</div>
			
		

</body>
</html>