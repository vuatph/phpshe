<?php
$menumark = 'ask_list';
switch ($act) {
	//#####################@ 咨询回复 @#####################//
	case 'edit':
		$sql = "select * from `".dbpre."ask` a,`".dbpre."product` b where a.`product_id` = b.`product_id` and a.`ask_id` = '{$_g_id}'";
		$info = $db->sql_select($sql);

		$seo = pe_seo('回复咨询', '', '', 'admin');
		$action = "admin.php?mod=ask&act=editsql&id={$_g_id}";
		include(pe_tpl('ask_add.html'));
	break;
	//#####################@ 咨询回复sql @#####################//
	case 'editsql':
		$_p_info['ask_replytime'] = time();
		$_p_info['ask_state'] = 1;
		if ($db->pe_update('ask', array('ask_id'=>$_g_id), pe_dbhold($_p_info))) {
			pe_success('咨询回复成功!', 'admin.php?mod=ask&act=list&type=all');
		}
		else {
			pe_error('咨询回复失败...');
		}
	break;
	//#####################@ 咨询删除sql @#####################//
	case 'delsql':
		if ($db->pe_delete('ask', array('ask_id'=>is_array($_p_ask_id) ? $_p_ask_id : $_g_id))) {
			pe_success('咨询删除成功!');
		}
		else {
			pe_error('咨询删除失败...');
		}
	break;
	//#####################@ 咨询列表 @#####################//
	default :
		$_g_state != 'all' && $sqlwhere .= " and `ask_state` = '{$_g_state}'";
		$_g_keyword && $sqlwhere .= " and `ask_text` like '%{$_g_keyword}%'";
		$sql = "select * from `".dbpre."ask` a,`".dbpre."product` b where a.`product_id` = b.`product_id` {$sqlwhere} order by a.`ask_id` desc";
		$info_list = $db->sql_selectall($sql, array(20, $_g_page));

		$seo = pe_seo('咨询列表', '', '', 'admin');
		include(pe_tpl('ask_list.html'));
	break;
}
pe_result();
?>