<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>搜索.</title>
  <!-- Set render engine for 360 browser -->
  <meta name="renderer" content="webkit">

  <!-- No Baidu Siteapp-->
  <meta http-equiv="Cache-Control" content="no-siteapp"/>

  <link rel="icon" type="image/png" href="#">

  <!-- Add to homescreen for Chrome on Android -->
  <meta name="mobile-web-app-capable" content="yes">
  <link rel="icon" sizes="192x192" href="#">

  <!-- Add to homescreen for Safari on iOS -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="apple-mobile-web-app-title" content="Amaze UI"/>

  <link rel="stylesheet" href="/broken/Public/home/css/amazeui.css"/>
  <link rel="stylesheet" href="/broken/Public/home/css/app.css">
  <link rel="stylesheet" href="/broken/Public/home/css/nav.css"/>
  <link rel="stylesheet" href="/broken/Public/home/css/shop_search.css"/>
  <style type="text/css">
  
  </style>

</head>
<body>
<!--工具栏-->
  <header class="am-topbar am-topbar-fixed-top">
    <div class="am-g">
      <div class="am-u-sm-2" id="sm2">
        <a href="index.html" class="am-btn am-btn-lg">
          <i class="am-icon-home am-icon-sm"></i>
        </a>
      </div>
      <div class="am-u-sm-8" id="sm8">
        <h3>
          搜索
        </h3>
      </div>
      <div class="am-u-sm-2" id="sm2">
    </a>
      </div>
    </div>
  </header>
<!--搜索框-->
<div class="form">
<form action="" class="am-form">
<div class="am-form-group am-form-icon">
    <i class="am-icon-search"></i>
    <input type="text" class="am-form-field am-round am-input-sm" placeholder="请输入..." >
</div>
</form>

</div>
<!--搜索标签-->
<div class="badge">
  <p class="am-serif"><i class="am-icon-fire"></i>热门搜索</p>
  <div class="badge_content">
  <button type="button" class="am-btn am-btn-danger am-round am-btn-xs">火锅</button>
  <button type="button" class="am-btn am-btn-danger am-round am-btn-xs">盖饭</button>
  <button type="button" class="am-btn am-btn-danger am-round am-btn-xs">蛋挞</button>
  <button type="button" class="am-btn am-btn-secondary am-round am-btn-xs">必胜客</button>
  <button type="button" class="am-btn am-btn-secondary am-round am-btn-xs">奶油蘑菇汤</button>
  <button type="button" class="am-btn am-btn-secondary am-round am-btn-xs">水饺</button>
  <button type="button" class="am-btn am-btn-success am-round am-btn-xs">奶油蘑菇汤</button>
  <button type="button" class="am-btn am-btn-success am-round am-btn-xs">芝士火腿披萨</button>
  </div>
</div>
<script src="/broken/Public/home/js/jquery.min.js"></script>
<script src="/broken/Public/home/js/amazeui.min.js"></script>
</body>
</html>