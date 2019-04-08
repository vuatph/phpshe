<?php
$menumark = 'user_list';
switch ($act) {
	//#####################@ 会员修改 @#####################//
	case 'edit':
		$info = $db->pe_select('user', array('user_id'=>$_g_id));

		$seo = pe_seo('修改会员', '', '', 'admin');
		$action = "admin.php?mod=user&act=editsql&id={$_g_id}";
		include(pe_tpl('user_add.html'));
	break;
	//#####################@ 会员修改sql @#####################//
	case 'editsql':
		$_p_user_pw && $_p_info['user_pw'] = md5($_p_user_pw);
		if ($db->pe_update('user', array('user_id'=>$_g_id), $_p_info)) {
			pe_success('会员信息修改成功!', 'admin.php?mod=user&act=list');
		}
		else {
			pe_error('会员信息修改失败...');
		}
	break;
	//#####################@ 会员删除sql @#####################//
	case 'delsql':
		if ($db->pe_delete('user', array('user_id'=>is_array($_p_user_id) ? $_p_user_id : $_g_id))) {
			pe_success('会员删除成功!');
		}
		else {
			pe_error('会员删除失败...');
		}
	break;
	//#####################@ 会员列表 @#####################//
	default:
		$_g_keyword && $sqlwhere = " and `user_name` like '%{$_g_keyword}%'";
		$sqlwhere .= " order by `user_id` desc";
		$info_list = $db->pe_selectall('user', $sqlwhere, '*', array(20, $_g_page));

		$seo = pe_seo('会员列表', '', '', 'admin');
		include(pe_tpl('user_list.html'));
	break;
}
pe_result();
?>