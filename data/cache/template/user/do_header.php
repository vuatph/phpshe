<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $seo['title'] ?></title>
<meta name="keywords" content="<?php echo $seo['keywords'] ?>" />
<meta name="description" content="<?php echo $seo['description'] ?>" />
<link rel="shortcut icon" type="image/ico" href="<?php echo $pe['host_root'] ?>favicon.ico">
<link type="text/css" rel="stylesheet" href="<?php echo $pe['host_tpl'] ?>css/style.css" />
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>include/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>include/js/global.js"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>include/plugin/layer/layer.js"></script>
</head>
<body>
<div class="quick_menu">
	<div class="width980" style="width:1000px;">
		<span class="fl">欢迎来到<?php echo $cache_setting['web_title'] ?>！</span>
		<div class="fr top_r">
			<?php if(pe_login('user')):?>
			您好：<a href="<?php echo $pe['host_root'] ?>user.php" style="color:#DF002F;padding:0;border:0"><?php echo $_s_user_name ?></a>
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=do&act=logout" title="退出" style="padding-left:0;color:#999">[退出]</a>
			<?php else:?>
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=do&act=login&<?php echo pe_fromto() ?>" title="登录">登录</a>
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=do&act=register&<?php echo pe_fromto() ?>" title="注册">免费注册</a>
			<?php endif;?>	
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=order" title="我的订单" class="scj">我的订单</a>
			<a href="<?php echo pe_url('article-news') ?>" title="资讯中心">资讯中心</a>
			<a href="<?php echo pe_url('article-help') ?>" title="帮助中心" style="border-right:0;">帮助中心</a>
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="width980" style="width:1000px;">
	<div class="login_logo">
		<a href="<?php echo $pe['host_root'] ?>" title="<?php echo $cache_setting['web_name'] ?>"><img src="<?php echo pe_thumb($cache_setting['web_logo']) ?>" alt="<?php echo $cache_setting['web_name'] ?>" /></a>
	</div>
</div>
