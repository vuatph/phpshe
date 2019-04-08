<?php
/**
 * @copyright   2008-2012 简好技术 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
$menumark = 'rule';
pe_lead('hook/cache.hook.php');
pe_lead('include/class/upload.class.php');
switch ($act) {
	//#####################@ 规格列表 @#####################//
	default:
		$seo = pe_seo($menutitle='商品规格', '', '', 'admin');
		include(pe_tpl('free.html'));
	break;
}
?>