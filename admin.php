<?php
include('common.php');

$adminmenu[] = array(
	'headnav' => '商品管理',
	'subnav' => array(
		array('name' => '商品分类', 'menumark' => 'category_product', 'url' => 'admin.php?mod=category&act=list&type=product'),
		array('name' => '商品列表', 'menumark' => 'product_list', 'url' => 'admin.php?mod=product&act=list'),
		array('name' => '商品咨询', 'menumark' => 'ask_list', 'url' => 'admin.php?mod=ask&act=list&state=all'),
		array('name' => '商品评价', 'menumark' => 'comment_list', 'url' => 'admin.php?mod=comment&act=list'),
		array('name' => '订单列表', 'menumark' => 'order_list', 'url' => 'admin.php?mod=order&act=list')
	)
);
$adminmenu[] = array(
	'headnav' => '信息管理',
	'subnav' => array(
		array('name' => '文章分类', 'menumark' => 'category_article', 'url' => 'admin.php?mod=category&act=list&type=article'),
		array('name' => '文章列表', 'menumark' => 'article_list', 'url' => 'admin.php?mod=article&act=list'),
		array('name' => '单页列表', 'menumark' => 'page_list', 'url' => 'admin.php?mod=page&act=list')
	)
);
$adminmenu[] = array(
	'headnav' => '用户管理',
	'subnav' => array(
		array('name' => '会员列表', 'menumark' => 'user_list', 'url' => 'admin.php?mod=user&act=list'),
		array('name' => '管理列表', 'menumark' => 'admin_list', 'url' => 'admin.php?mod=admin&act=list')
	)
);
$adminmenu[] = array(
	'headnav' => '控制面板',
	'subnav' => array(
		array('name' => '基本信息', 'menumark' => 'setting_base', 'url' => 'admin.php?mod=setting&act=base'),
		array('name' => '支付接口', 'menumark' => 'setting_pay', 'url' => 'admin.php?mod=setting&act=pay'),
		array('name' => '缓存管理', 'menumark' => 'cache_list', 'url' => 'admin.php?mod=cache&act=list'),
		array('name' => '友情链接', 'menumark' => 'link_list', 'url' => 'admin.php?mod=link&act=list'),
		array('name' => '广告列表', 'menumark' => 'ad_list', 'url' => 'admin.php?mod=ad&act=list')
	)
);

if (!$_s_admin_id_key && !in_array($act, array('login', 'loginsql'))) {
	pe_goto('admin.php?mod=do&act=login');
}
if ($_s_admin_id_key && (in_array($act, array('login', 'loginsql')) or $mod == 'index')) {
	pe_goto('admin.php?mod=order&act=list');
}
include("{$pe['path_root']}module/{$module}/{$mod}.php");
?>