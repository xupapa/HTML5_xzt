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
  
	<!-- 轮播图 -->
    <div class="am-slider am-slider-default" data-am-flexslider id="demo-slider-0">
	  <ul class="am-slides">
	  <?php if(is_array($sliders)): $i = 0; $__LIST__ = array_slice($sliders,0,4,true);if( count($__LIST__)==0 ) : echo "抱歉，暂时没有图片。" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><li><img src="/broken/Public/home/images/<?php echo ($v["sldimage"]); ?>" /></li><?php endforeach; endif; else: echo "抱歉，暂时没有图片。" ;endif; ?>
	  </ul>
	</div>
	<!-- 活动 -->
	<div class="am-g" id="active">
		<div class="am-u-sm-6" id="active1">
			<img src="/broken/Public/home/images/<?php echo ($activity[0]['actimage']); ?>">
		</div>
		<div class="am-u-sm-6" id="active4">
			<div class="am-g">
				<div class="am-u-sm-6" id="active2">
					<img src="/broken/Public/home/images/<?php echo ($activity[1]['actimage']); ?>">
				</div>
				<div class="am-u-sm-6" id="active3">
					<img src="/broken/Public/home/images/<?php echo ($activity[2]['actimage']); ?>" id="active3_img1">
					<img src="/broken/Public/home/images/<?php echo ($activity[3]['actimage']); ?>" id="active3_img2">
				</div>
			</div>
		</div>
	</div>
	<!-- 列表 -->
	<ul class="am-list" id="list">
	<?php if(is_array($sellertab)): $i = 0; $__LIST__ = array_slice($sellertab,0,4,true);if( count($__LIST__)==0 ) : echo "抱歉，暂时没有店铺信息。" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a href="/broken/index.php/Home/Life/store/id/<?php echo ($v["sid"]); ?>">
	 <!-- <input type="text" name="sid" value="<?php echo ($v["sid"]); ?>"> -->
	 	<li>
		  <div class="am-g">
		    <div class="am-u-sm-4" id="list1"><img src="/broken/Public/home/images/<?php echo ($v["simage"]); ?>">
		    </div>
		    <div class="am-u-sm-8">
		    	<div class="am-g">
		    		<div class="am-u-sm-8" id="list2">
		    			<p id="list2_p1"><?php echo ($v["shopname"]); ?></p>
						<p id="list2_p2"class="am-sans-serif">简介：<?php echo (msubstr($v["introduce"],0,30)); ?></p>
		    			<p id="list2_p3">评分：<?php echo ($v["slevel"]); ?></p>
		    		</div>
		    		<div class="am-u-sm-4" id="list3">
		    			<a class="am-icon-pencil-square am-icon-lg" data="<?php echo ($v["sid"]); ?>" href="javascript:void(0);" data-am-collapse="{parent: '#accordion', target: '#<?php echo ($v["sid"]); ?>'}"></a>
		    		</div>
		    	</div>
		    </div>
		</div> 
		<div id="<?php echo ($v["sid"]); ?>" class="am-panel-collapse am-collapse">
		  <div class="am-panel-bd">
		  	<input type="hidden" name="chipname" />
		  	<?php if(is_array($chips)): $i = 0; $__LIST__ = array_slice($chips,0,null,true);if( count($__LIST__)==0 ) : echo "抱歉，暂时没有可选标签。" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><a class="clickme" data="<?php echo ($v["id"]); ?>" href="javascript:void(0);"><div class="am-badge am-round am-badge-secondary am-text-sm" id="badge"><?php echo ($v["chipname"]); ?> <span><?php echo ($v["clickcount"]); ?></span></div></a><?php endforeach; endif; else: echo "抱歉，暂时没有店铺信息。" ;endif; ?>
			<div class="clear"></div>
		  	<?php if(is_array($progress)): $i = 0; $__LIST__ = array_slice($progress,0,2,true);if( count($__LIST__)==0 ) : echo "抱歉，暂时没有可选标签。" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><div class="am-g" id="panel">
		  		<div class="am-u-sm-3"><?php echo ($v["chipname"]); ?></div>
		  		<div class="am-u-sm-9">
		  			<div class="am-progress">
					  <div class="am-progress-bar am-progress-bar-warning" style="width: <?php echo ($v["malewidth"]); ?>%"><?php echo ($v["malewidth"]); ?>%</div>
					  <div class="am-progress-bar am-progress-bar-success" style="width: <?php echo ($v["femalewidth"]); ?>%"><?php echo ($v["femalewidth"]); ?>%</div>
					</div>
		  		</div>
		  	</div><?php endforeach; endif; else: echo "抱歉，暂时没有可选标签。" ;endif; ?>
			
		  </div>
	    </div>
       </li>
	 </a><?php endforeach; endif; else: echo "抱歉，暂时没有可选标签。" ;endif; ?>
	 <input id="ids" type="hidden" value="<?php echo ($user[busername]); ?>">
	</ul>
<script>
	// $(".am-icon-pencil-square").on('click',function(){
	//     //alert("123");
	// 	var Oa=$(this);
 //        var id=Oa.attr('data');
 //        //alert(id);
 //         // $.ajax({
 //         // 	url:'/life/match',
 //         // 	data:{data:id},
 //         // 	type:"post",
 //         // 	dataType:"json"
 //         // });
	// 	$.post('/broken/index.php/Home/Life/mat/ssid/{data:id}',{data:id},function(d){
	// 		alert(d);
	// 	}); 
 //        //alert(data);
 //  // $.ajax({
 //  // 	type:"post",
 //  // 	url:"/life/match",
 //  // 	data:{"sid":"{$v.sid}"},
 //  // 	dataType:"json"
 //  // });
	// })
</script>	
<script>
	$(".clickme").on('click',function(){
		if($("#ids").val()!=''){
        var Oa=$(this);
        var id=Oa.attr('data');//获取id属性
        var vl=Oa.find("span").text();
            vl=parseInt(vl)+1;
        $.post('/broken/index.php/Home/Life/set_hits',{data:id},function(data){
        	if(data.status==1){ 
                alert('感谢您的选择！');
                Oa.find("span").text(vl);//页面元素加1
            }else{
                alert('失败');
            }
        },'json'
            //alert(data);
       ); 
    }else{
    	window.location.href="/broken/index.php/Home/Admin/login";
    }
    })
</script>


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