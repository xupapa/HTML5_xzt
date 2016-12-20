<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html class="no-js">
<head>
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
  <link rel="stylesheet" href="/broken/Public/home/css/nav.css">
  <link rel="stylesheet" href="/broken/Public/home/css/bottom.css"/>
  <link rel="stylesheet" href="/broken/Public/home/css/yl_content.css"/>
  <script src="/broken/Public/home/js/jquery.min.js"></script>
  <script src="/broken/Public/home/js/amazeui.min.js"></script>

</head>
<body>
<header class="am-topbar am-topbar-fixed-top">
        <div>
            <div class="am-g">
                <div class="am-u-sm-2">
                    <a href="index.html" class="am-btn am-btn-lg" >
                        <i class="am-icon-home am-icon-sm" id="am-btn_i"></i>
                    </a>
                </div>
                <div class="am-u-sm-7">
                    <a href="index.html" class="am-text-ir">logo</a>
                </div>
                <div class="am-u-sm-3">
                	<a href="<?php echo U('Home/Amusement/shop_search');?>" class="am-btn am-btn-lg" >
					<i class="am-icon-search am-icon-sm" ></i>
				</a>
                </div>
            </div>
        </div>
    </header>
	<!-- 轮播图 -->
    
<title>游戏</title>
	<!-- 轮播图 -->
    <div class="am-slider am-slider-default" data-am-flexslider id="demo-slider-0">
	  <ul class="am-slides">
	    <?php if(is_array($sliders)): $i = 0; $__LIST__ = $sliders;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><img src="/broken/Public/home/images/<?php echo ($vo["sldimage"]); ?>" /></li><?php endforeach; endif; else: echo "" ;endif; ?>
	  </ul>
	</div>
	<!-- 活动 -->
<div class="am-g" id="g1" >
	<div class="am-u-sm-6" id="am-u-sm-6_1">
		<img src="/broken/Public/home/images/<?php echo ($activities[0]['actimage']); ?>" id="img1" >
	</div>
	<div class="am-u-sm-6" id="am-u-sm-6_2" >
		<div class="am-g" id="g2">
			<div class="am-u-sm-6" id="am-u-sm-6_3">
				<img src="/broken/Public/home/images/<?php echo ($activities[1]['actimage']); ?>" id="img2">
				<img src="/broken/Public/home/images/<?php echo ($activities[2]['actimage']); ?>" id="img3">
			</div>
			<div class="am-u-sm-6" id="am-u-sm-6_3">
				<img src="/broken/Public/home/images/<?php echo ($activities[3]['actimage']); ?>" id="img2">
				<img src="/broken/Public/home/images/<?php echo ($activities[4]['actimage']); ?>" id="img3">
			</div>
		</div>
	</div>
</div>
	<!-- 列表 -->
	<ul class="am-list">
	<?php if(is_array($sellertab)): $i = 0; $__LIST__ = array_slice($sellertab,0,null,true);if( count($__LIST__)==0 ) : echo "抱歉，暂时没有店铺信息。" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><a href="/broken/index.php/Home/Amusement/yl_gamestore/id/<?php echo ($vo["sid"]); ?>" id="am-list-a" >
	  <li>
		  <div class="am-g">
			  <div class="am-u-sm-4"><img src="/broken/Public/home/images/<?php echo ($vo["simage"]); ?>" id="img4">
			  </div>
			  <div class="am-u-sm-8">
				  <div class="am-g">
					  <div class="am-u-sm-8" id="am-u-sm-8_1">
						  <p><?php echo ($vo["shopname"]); ?></p>
						  <p>评分：<?php echo ($vo["slevel"]); ?></p>
					  </div>
					  <div class="am-u-sm-4" id="am-u-sm-4_1">
						  <a class="am-icon-pencil-square am-icon-lg" data-am-collapse="{parent: '#accordion', target: '#<?php echo ($vo["sid"]); ?>'}"></a>
					  </div>
				  </div>
			  </div>
		  </div>

		  <div id="<?php echo ($vo["sid"]); ?>" class="am-panel-collapse am-collapse">
			  <div class="am-panel-bd">
				  <div class="am-g" id="g3">
					  <?php if(is_array($vo["chiptwo"])): $i = 0; $__LIST__ = $vo["chiptwo"];if( count($__LIST__)==0 ) : echo "抱歉，暂时没有可选标签。" ;else: foreach($__LIST__ as $key=>$k): $mod = ($i % 2 );++$i;?><a class="clickme" id="<?php echo ($k["id"]); ?>" href="javascript:void(0);"><div class="am-badge am-round am-badge-secondary am-text-sm" id="badge1"><?php echo ($k["chipname"]); ?> <span><?php echo ($k["clickcount"]); ?></span></div></a><?php endforeach; endif; else: echo "抱歉，暂时没有店铺信息。" ;endif; ?>
				  </div>
				  <?php if(is_array($vo["chiptwo"])): $i = 0; $__LIST__ = array_slice($vo["chiptwo"],0,2,true);if( count($__LIST__)==0 ) : echo "抱歉，暂时没有进度条信息。" ;else: foreach($__LIST__ as $key=>$k): $mod = ($i % 2 );++$i;?><div class="am-g" id="g4" >				    
					<div class="am-u-sm-3" id="am-u-sm-3_1"><?php echo ($k["chipname"]); ?></div>		
					  <div class="am-u-sm-9" id="am-u-sm-9_1">
						<div class="am-progress" id="progress_1">
							<div class="am-progress-bar" id="progress-bar_1" style="width:<?php echo ($k["malewidth"]); ?>% ;"><?php echo ($k["malewidth"]); ?>%</div>
							<div class="am-progress-bar " id="progress-bar_2" style="width: <?php echo ($k["femalewidth"]); ?>%;"><?php echo ($k["femalewidth"]); ?>%</div>
					  </div>
				    </div>
				  </div><?php endforeach; endif; else: echo "抱歉，暂时没有进度条信息。" ;endif; ?>
				  
			  </div>
		  </div>
       </li>
       </a><?php endforeach; endif; else: echo "抱歉，暂时没有可选标签。" ;endif; ?>
      <input id="ids" type="hidden" value="<?php echo ($user[busername]); ?>">
	</ul>
    <!--底部导航条-->
<script>
/*
var ajax;
if(window.XMLHttpRequest)
{ 
	ajax = new XMLHttpRequest();
}
else{ 
	ajax = new ActiveXObject('Microsoft.XMLHTTP');
}
ajax.open('GET','/broken/index.php/Home/Life/set_hits/id/<?php echo ($_GET['id']); ?>',true);
ajax.send();
*/
$(".clickme").on('click',function(){    
	if($("#ids").val()!=''){
		var Oa=$(this);
        var id=Oa.attr('id');//获取id属性
        var vl=Oa.find("span").text();
            vl=parseInt(vl)+1;
        $.post('/broken/index.php/Home/Amusement/set_hits',{id:id},function(data){
            if(data.status==1){ 
                alert('感谢您的选择！');
                Oa.find("span").text(vl);//页面元素加1
            }else{
                alert("失败！");
            }
        },'json'); 
    
	}else{
    	window.location.href="/broken/index.php/Home/Admin/login";
    }
})
</script>


		
    <!--底部导航条-->
    
<div class="am-topbar am-topbar-fixed-bottom" id="nav">
        <ul class="am-nav am-nav-pills am-nav-justify">
          <li><a href="yl_movie.html"><i class="am-icon am-icon-ticket am-icon-md"></i><br>电影</a></li>
          <li><a href="yl_games.html"><i class="am-icon am-icon-fort-awesome am-icon-md"></i><br>游戏</a></li>
          <li><a href="yl_sports.html"><i class="am-icon am-icon-life-saver am-icon-md"></i><br>运动</a></li>
        </ul>
    </div>


<script>
  $(function() {
    var $slider = $('#demo-slider-0');
    var getSlide = function() {    var counter = 0;

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