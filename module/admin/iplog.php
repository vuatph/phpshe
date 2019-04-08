<?php
/**
 * @copyright   2008-2014 简好技术 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
$menumark = 'iplog';
switch ($act) {
	//#####################@ 流量统计 @#####################//
	default:
		$seo = pe_seo($menutitle='流量统计', '', '', 'admin');
		include(pe_tpl('free.html'));
	break;
}
?>