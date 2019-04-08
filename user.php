<?php
include('common.php');

$cache_category = cache::get('category');
$cache_category_arr = cache::get('category_arr');
$cache_class = cache::get('class');
$cache_class_arr = cache::get('class_arr');
$cache_menu = cache::get('menu');
pe_lead('hook/user.hook.php');
$web_qq = $cache_setting['web_qq'] ? explode(',', $cache_setting['web_qq']) : array();


if (pe_login('user') && $mod == 'do' && $act != 'logout') {
	pe_goto("{$pe['host_root']}user.php?mod=order");
}
if (!pe_login('user') && $mod != 'do') {
	pe_goto("{$pe['host_root']}user.php?mod=do&act=login");
}

if (in_array("{$mod}.php", pe_dirlist("{$pe['path_root']}module/{$module}/*.php"))) {
	include("{$pe['path_root']}module/{$module}/{$mod}.php");
}
pe_result();
?>