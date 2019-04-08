<?php
$menumark = 'comment';
pe_lead('hook/product.hook.php');
switch($act) {
	//#####################@ 评价列表 @#####################//
	default:
		$sql = "select * from `".dbpre."comment` a, `".dbpre."product` b where a.`product_id` = b.`product_id` and a.`user_id` = '{$_s_user_id}' order by a.`comment_id` desc";
		$info_list = $db->sql_selectall($sql, array(10, $_g_page));
		
		$seo = pe_seo($menutitle='我的评价');
		include(pe_tpl('comment_list.html'));
	break;
}
?>