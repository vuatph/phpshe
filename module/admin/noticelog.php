<?php
/**
 * @copyright   2008-2015 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
$menumark = 'noticelog';
switch ($act) {
	//#####################@ 短/邮记录 @#####################//
	default:
		$info_list = $db->pe_selectall('noticelog', array('order by'=>'noticelog_id desc'), '*', array(30, $_g_page));
		$tongji['all'] = $db->pe_num('noticelog');
		$seo = pe_seo($menutitle='短/邮记录', '', '', 'admin');
		include(pe_tpl('noticelog_list.html'));
	break;
}
?>