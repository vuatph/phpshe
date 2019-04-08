<?php
$menumark = 'brand';
pe_lead('hook/cache.hook.php');
switch ($act) {
	//#####################@ 品牌列表 @#####################//
	default:
		$seo = pe_seo($menutitle='品牌管理', '', '', 'admin');
		include(pe_tpl('free.html'));
	break;
}
?>