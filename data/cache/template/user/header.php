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
	<div class="width980">
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
<div style="background:#E45050; padding-bottom:20px; position:relative">
<div class="width980">
	<div class="fl logo">
		<a href="<?php echo $pe['host_root'] ?>user.php">会员中心</a>
	</div>
	<div class="user_nav">
		<li><h3><a href="<?php echo $pe['host_root'] ?>" title="首页">首页</a></h3></li>
		<?php foreach((array)$cache_menu as $v):?>
		<li><h3><a href="<?php echo $v['menu_url'] ?>" title="<?php echo $v['menu_name'] ?>" <?php echo $v['target'] ?>><?php echo $v['menu_name'] ?></a></h3></li>
		<?php endforeach;?>
	</div>
	<div class="head_gwc"><a href="<?php echo $pe['host_root'] ?>index.php?mod=order&act=add"><div class="head_gwc_tb">购物车 <span id="cart_num" class="num cred"><?php echo user_cartnum() ?></span> 件　 ></div></a></div>
	<div class="sear fr">				
		<form method="get" action="<?php echo $pe['host_root'] ?>index.php">
		<input type="hidden" name="mod" value="product" />
		<input type="hidden" name="act" value="list" />
		<div class="inputbg fl"><input type="text" name="keyword" value="<?php echo htmlspecialchars($_g_keyword) ?>" class="fl searinput c666" /></div>
		<input type="submit" class="fl sear_btn" onclick="this.form.submit();return false;" value="搜 索" />
		</form>
		<div class="clear"></div>
	</div>
	<div class="clear"></div>
</div>
</div>