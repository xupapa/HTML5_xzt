<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo ($sellertab["type_branch"]); ?>-<?php echo ($sellertab["shopname"]); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/broken/Public/home/css/amazeui.css"/>
    <link rel="stylesheet" href="/broken/Public/home/css/life_store.css"/>
    <script src="/broken/Public/home/js/jquery.min.js"></script>
    <script src="/broken/Public/home/js/amazeui.min.js"></script>
    <style type="text/css">
    	
    </style>
</head>
<body>
	<div>

	</div>
	<header class="am-topbar">
		<div class="am-g" id="amg">
			<img src="/broken/Public/home/images/<?php echo ($sellertab["sbanner"]); ?>" id="banner"/>
			<a href="" onclick="history.go(-1)" class="am-btn am-btn-xl" rel="am-back">
				<i class="am-icon-chevron-left" id="store_i"></i>
			</a>
		</div>
	</header>
	<article class="am-comment" id="my-scrollspy">
			<div class="am-comment-bd">
			<div class="am-g" id="center">
				<div class="am-u-sm-2">
					<a href="#">
						<img src="/broken/Public/home/images/<?php echo ($sellertab["sbrand"]); ?>" alt="头像" height="52px" width="52px" class="am-round" />
					</a>
				</div>
				<div class="am-u-sm-10">
					<div class="am-comment-meta">
						<div class="am-g" id=
						"meta">
							<div class="am-u-sm-10">
								<a href="#link-to-user" class="am-comment-author" id="author"><?php echo ($sellertab["shopname"]); ?><i class="am-icon-envira" id="leaf"></i></a>
							</div>
							<!--
							<div class="am-u-sm-4">
								<a href="#" class="am-btn am-btn-sm am-btn-success"style="color:white;"><i class="am-icon-envira"></i>&nbsp收藏</a>
							</div>
							-->
						</div>	
					</div> 
					<hr></hr>
				</div>

			</div>
			</div>
		</article>
     	<article class="am-article">
            <div class="am-article-bd" id="article">
              <blockquote>
			  <p><?php echo ($sellertab["block_word"]); ?></p>
			  <small>——<?php echo ($sellertab["block_idea"]); ?></small>
			  </blockquote>
              <p class="am-article-lead" id="article_lead">
              <?php echo ($sellertab["introduce"]); ?>
              </p>
            </div>

            <div class="am-topbar am-topbar-fixed-bottom">
			<a href="#" class="am-btn am-btn-lg am-btn-block" id="bottom_btn"><i class="am-icon-cart-plus"></i>&nbsp&nbsp&nbsp去购物</a>
		</div>
        </article>
		
</body>
</html>