<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<title>网吧</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/broken/Public/home/css/amazeui.css"/>
    <link rel="stylesheet" href="/broken/Public/home/css/yl_gamestore.css"/>

    <script src="/broken/Public/home/js/jquery.min.js"></script>
    <script src="/broken/Public/home/js/amazeui.min.js"></script>
</head>
<body>
	<header class="am-topbar">
		<div class="am-g" >	
				<img src="/broken/Public/home/images/<?php echo ($sellertab["sbanner"]); ?>" id="banner"/>
				<a onclick="history.go(-1)" class="am-btn am-btn-lg" id="a1">
					<i class="am-icon-chevron-left" id="a_i" ></i>
				</a>
		</div>	
	</header>
	<article class="am-comment" id="my-scrollspy">
			<div class="am-comment-bd">
			<div class="am-g">
				<div class="am-u-sm-2">
					<a href="#">
						<img src="/broken/Public/home/images/<?php echo ($sellertab["sbrand"]); ?>" alt="头像" height="60px" width="60px" class="am-circle" />
					</a>
				</div>
				<div class="am-u-sm-10">
					<div class="am-comment-meta">
						<div class="am-g" id=
						"meta">
							<div class="am-u-sm-6">
								<a href="#link-to-user" class="am-comment-author"><?php echo ($sellertab["shopname"]); ?></a>
							</div>						
								
						
						</div>
						<div class="am-g">
							<p id="p1">地址：<?php echo ($sellertab["saddress"]); ?></p>
						</div>
					</div> 
					 

				</div>
			</div>
			</div>
		</article>
     	<article class="am-article">
            <div class="am-article-bd">
              <p class="am-article-lead" id="p2">
             	<?php echo ($sellertab["introduce"]); ?>
              </p>
            </div>
        </article>
        <div class="am-topbar am-topbar-fixed-bottom">
			<a href="/broken/index.php/Home/Amusement/choose" class="am-btn am-btn-lg am-btn-block"><i class="am-icon-plus"></i>&nbsp;&nbsp;去娱乐</a>
		</div>


</body>
</html>