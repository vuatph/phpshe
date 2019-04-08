<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $seo['title'] ?></title>
<meta name="keywords" content="<?php echo $seo['keywords'] ?>" />
<meta name="description" content="<?php echo $seo['description'] ?>" />
<link type="text/css" rel="stylesheet" href="<?php echo $pe['host_tpl'] ?>css/all.css"  />
<link type="text/css" rel="stylesheet" href="<?php echo $pe['host_tpl'] ?>css/style.css" />
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>include/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo $pe['host_root'] ?>include/js/global.js"></script>
<script charset="utf-8" src="<?php echo $pe['host_root'] ?>include/plugin/artdialog/jquery.artDialog.js?skin=chrome"></script>
<script charset="utf-8" src="<?php echo $pe['host_root'] ?>include/plugin/artdialog/plugins/iframeTools.js"></script>
</head>
<body>
<div class="pagetop">
	<div class="width960">
		<div class="quick_menu">
			<p>
			<?php if($_s_user_id_key):?>
			您好，<?php echo $_s_user_name ?>！
			<a href="<?php echo $pe['host_root'] ?>index.php?mod=user&act=orderlist" title="会员中心">会员中心</a>
			<a href="<?php echo $pe['host_root'] ?>index.php?mod=order&act=cartlist" title="购物车">购物车 <span class="cred"><?php echo $cart_num ?></span> 件</a>
			<?php if($cache_setting['web_weibo']['setting_value']):?>
			<a href="<?php echo pe_url('user-logout') ?>" title="退出">退出</a>
			<a href="<?php echo $cache_setting['web_weibo']['setting_value'] ?>" title="官方微博" target="_blank" style="border:0">官方微博</a>
			<?php else:?>
			<a href="<?php echo pe_url('user-logout') ?>" title="退出" style="border:0">退出</a>
			<?php endif;?>
			<?php else:?>
			欢迎来到<?php echo $cache_setting['web_name']['setting_value'] ?>！
			<a href="<?php echo pe_url('user-login') ?>" title="登录">登录</a>
			<?php if($cache_setting['web_weibo']['setting_value']):?>
			<a href="<?php echo pe_url('user-register') ?>" title="注册">注册</a>
			<a href="<?php echo $cache_setting['web_weibo']['setting_value'] ?>" title="官方微博" target="_blank" style="border:0">官方微博</a>
			<?php else:?>
			<a href="<?php echo pe_url('user-register') ?>" title="注册" style="border:0">注册</a>
			<?php endif;?>
			<?php endif;?>
			</p>
		</div>
		<div class="clear"></div>
		<div class="header">
			<div class="fl"><a href="<?php echo $pe['host_root'] ?>" title="<?php echo $cache_setting['web_name']['setting_value'] ?>"><img src="<?php echo $pe['host_tpl'] ?>images/logo.jpg" /></a></div>
			<div class="sear fr">
				<form method="get" action="<?php echo pe_url('product-list') ?>">
				<div class="inputbg fl"><input type="text" name="keyword" value="<?php echo $_g_keyword ?>" class="fl searinput" /></div>
				<!--<a href="#"><img class="fl" src="<?php echo $pe['host_tpl'] ?>images/sear.gif" /></a>-->
				<input type="image" src="<?php echo $pe['host_tpl'] ?>images/searbtn.gif" class="fl" onclick="this.form.submit();return false;" />
				</form>
			</div>
		</div>
		<div class="clear"></div>
	</div>
	<div class="nav">
		<ul>
			<li class="sel"><a href="<?php echo $pe['host_root'] ?>" title="首页">首页</a></li>
			<?php foreach((array)$category_productarr[0] as $v):?>
			<li><a href="<?php echo pe_url('product-list-'.$v['category_id']) ?>"><?php echo $v['category_name'] ?></a></li>
			<?php endforeach;?>
		</ul>
	</div>
	<div class="clear"></div>
</div>