<?php
$menumark = 'collect';
switch($act) {
	//#####################@ 收藏删除 @#####################//
	case 'del':
		pe_token_match();
		$collect_id = intval($_g_id);
		$info = $db->pe_select('collect', array('collect_id'=>$collect_id));
		if ($db->pe_delete('collect', array('collect_id'=>$collect_id, 'user_id'=>$_s_user_id))) {
			pe_lead('hook/product.hook.php');
			product_num('collectnum', $info['product_id']);
			pe_success('收藏删除成功！');
		}
		else {
			pe_error('收藏删除失败...');
		}
	break;
	//#####################@ 收藏列表 @#####################//
	default:
		$sql = "select * from `".dbpre."collect` a, `".dbpre."product` b where a.`product_id` = b.`product_id` and a.`user_id` = '{$_s_user_id}' order by a.`collect_id` desc";
		$info_list = $db->sql_selectall($sql, array(10, $_g_page));
		
		$seo = pe_seo($menutitle='我的收藏');
		include(pe_tpl('collect_list.html'));
	break;
}
?>