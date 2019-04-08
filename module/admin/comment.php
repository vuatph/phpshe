<?php
$menumark = 'comment_list';
switch ($act) {
	//#####################@ 评价修改 @#####################//
	case 'edit':
		$sql = "select * from `".dbpre."comment` a,`".dbpre."product` b where a.`product_id` = b.`product_id` and a.`comment_id` = '{$_g_id}'";
		$info = $db->sql_select($sql);

		$seo = pe_seo('修改评价', '', '', 'admin');
		$action = "admin.php?mod=comment&act=editsql&id={$_g_id}";
		include(pe_tpl('comment_add.html'));
	break;
	//#####################@ 评价修改sql @#####################//
	case 'editsql':
		if ($db->pe_update('comment', array('comment_id'=>$_g_id), pe_dbhold($_p_info))) {
			pe_success('评价修改成功!', 'admin.php?mod=comment&act=list');
		}
		else {
			pe_error('评价修改失败...');
		}
	break;
	//#####################@ 评价删除sql @#####################//
	case 'delsql':
		if ($db->pe_delete('comment', array('comment_id'=>is_array($_p_comment_id) ? $_p_comment_id : $_g_id))) {
			pe_success('评价删除成功!');
		}
		else {
			pe_error('评价删除失败...');
		}
	break;
	//#####################@ 评价列表 @#####################//
	default :
		$_g_keyword && $sqlwhere .= " and `comment_text` like '%{$_g_keyword}%'";
		$sql = "select * from `".dbpre."comment` a,`".dbpre."product` b where a.`product_id` = b.`product_id` {$sqlwhere} order by a.`comment_id` desc";
		$info_list = $db->sql_selectall($sql, array(20, $_g_page));

		$seo = pe_seo('评价列表', '', '', 'admin');
		include(pe_tpl('comment_list.html'));
	break;
}
pe_result();
?>