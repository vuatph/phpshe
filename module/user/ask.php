<?php
$menumark = 'ask';
switch($act) {
	//#####################@ 咨询列表 @#####################//
	default:
		$sql = "select * from `".dbpre."ask` a, `".dbpre."product` b where a.`product_id` = b.`product_id` and a.`user_id` = '{$_s_user_id}' order by a.`ask_id` desc";
		$info_list = $db->sql_selectall($sql, array(10, $_g_page));
		
		$seo = pe_seo($menutitle='我的咨询');
		include(pe_tpl('ask_list.html'));
	break;
}
?>