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
</head>
<body>
<div class="quick_menu">
	<div class="width980">
		<span class="fl">欢迎来到<?php echo $cache_setting['web_title'] ?>！</span>
		<div class="fr top_r">
			<?php if(pe_login('user')):?>
			您好：<a href="<?php echo $pe['host_root'] ?>user.php?mod=setting&act=base" style="color:#DF002F;padding-left:0"><?php echo $_s_user_name ?></a>
			<?php else:?>
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=do&act=login&<?php echo pe_fromto() ?>" title="登录">登录</a>
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=do&act=register&<?php echo pe_fromto() ?>" title="注册">免费注册</a>
			<?php endif;?>	
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=order" title="我的订单" class="scj">我的订单</a>
			<a href="<?php echo pe_url('article-list-'.key($cache_class_arr['help'])) ?>" title="帮助中心">帮助中心</a>
			<?php if(pe_login('user')):?>
			<a href="<?php echo $pe['host_root'] ?>user.php?mod=do&act=logout" title="退出" style="border:0">退出</a>
			<?php endif;?>	
		</div>
		<div class="clear"></div>
	</div>
</div>
<div class="width980">
<?php echo ad_show('header') ?>
<?php if($mod=='index'):?><?php echo ad_show('index_header') ?><?php endif;?>
</div>
<div class="width980">
	<div class="header">
		<div class="fl logo"><a href="<?php echo $pe['host_root'] ?>" title="<?php echo $cache_setting['web_name'] ?>"><img src="<?php echo pe_thumb($cache_setting['web_logo']) ?>" alt="<?php echo $cache_setting['web_name'] ?>" /></a></div>
		<div><a class="head_gwc" href="<?php echo $pe['host_root'] ?>index.php?mod=order&act=add"><div class="head_gwc_tb">购物车 <span class="cred strong" id="cart_num"><?php echo user_cartnum() ?></span> 件</div></a></div>
		<!--<p class="top_tel fr"><?php echo $cache_setting['web_phone'] ?></p>-->
		<div class="sear fr">				
			<form method="get" action="<?php echo pe_url('product-list') ?>">
			<div class="inputbg fl"><input type="text" name="keyword" value="<?php echo htmlspecialchars($_g_keyword) ?>" class="fl searinput c666" /></div>
			<input type="submit" class="fl sear_btn" onclick="this.form.submit();return false;" value=" " />
			</form>
			<div class="clear"></div>
			<div class="mat5 head_hot">
			热门：<?php foreach(explode(',', $cache_setting['web_hotword']) as $v):?>
			<a href="<?php echo pe_url('product-list', 'keyword='.$v) ?>" title="<?php echo $v ?>" target="_blank" class="mar5 c888"><?php echo $v ?></a>
			<?php endforeach;?>
			</div>
		</div>
	</div>
</div>
<div class="clear"></div>
<div class="nav">
	<ul>
	<li class="sel" style="width:240px; position:relative;z-index:999" id="menu_nav">
		<h3 class="all"><a>全部商品分类</a></h3>
		<div class="fl_index" id="menu_html" style="display:none">
			<?php foreach((array)$cache_category_arr[0] as $k=>$v):?>
			<?php $i++;?>
			<div class="fenlei_li">
				<div class="fenlei_h3"><a href="<?php echo pe_url('product-list-'.$k) ?>" title="<?php echo $v['category_name'] ?>" class="i<?php echo $i ?>"><?php echo $v['category_name'] ?></a></div>
				<div class="js_right" style="display:none">
					<p class="strong">选择分类：</p>
					<?php foreach((array)$cache_category_arr[$k] as $kk=>$vv):?>
					<a href="<?php echo pe_url('product-list-'.$kk) ?>" title="<?php echo $vv['category_name'] ?>"><?php echo $vv['category_name'] ?></a>
					<?php endforeach;?>
				</div>
			</div>
			<?php endforeach;?>
		</div>
	</li>
	<li><h3><a href="<?php echo $pe['host_root'] ?>" title="首页">首页</a></h3></li>
	<?php foreach((array)$cache_menu as $v):?>
	<li><h3><a href="<?php echo $v['menu_url'] ?>" title="<?php echo $v['menu_name'] ?>" <?php echo $v['target'] ?>><?php echo $v['menu_name'] ?></a></h3></li>
	<?php endforeach;?>
	</ul>
</div>
<div class="clear"></div>