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
</head>
<body>
<div class="bgimg"></div>
<div class="pagetop">
	<div class="logo fl"><img src="<?php echo $pe['host_tpl'] ?>images/logo.png" /></div>
	<div class="head_r fr">
		<a href="<?php echo $pe['host_root'] ?>" target="_blank">【网站首页】</a>
		<a href="admin.php?mod=do&act=logout">【注销】</a>
	</div>
	<div class="clear"></div>
</div>
<div class="content">
	<div class="main_top"></div>
	<div class="main">
		<div class="left fl">
			<?php foreach($adminmenu as $k=>$v):?>
			<div class="fenlei">
				<h3><?php echo $v['headnav'] ?></h3>
				<ul>
					<?php foreach($v['subnav'] as $vv):?>
					<li <?php if($vv['menumark']==$menumark):?>class="sel"<?php endif;?>><a href="<?php echo $vv['url'] ?>"><?php echo $vv['name'] ?></a></li>
					<?php endforeach;?>
				</ul>
			</div>
			<?php endforeach;?>
			<div class="fenlei">
				<h3>软件信息</h3>
				<p style="text-align:center"><a href="http://www.phpshe.com" target="_blank" class="cgreen">phpshe1.0(2012-07-07)</a></p>
				<p style="text-align:center" class="cgreen strong">简单、好用！</p>
				<p>团队：<u>简好技术</u></p>
				<p>邮箱：<u>admin@phpshe.com</u></p>
				<p>企鹅：<u>1318321、1517735</u></p>
			</div>
		</div>