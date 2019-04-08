<?php
$menumark = 'admin_list';
switch ($act) {
	//#####################@ 管理增加 @#####################//
	case 'add':
		$seo = pe_seo('增加管理', '', '', 'admin');
		$action = 'admin.php?mod=admin&act=addsql';
		include(pe_tpl('admin_add.html'));
	break;
	//#####################@ 管理增加sql @#####################//
	case 'addsql':
		$_p_admin_pw && $_p_info['admin_pw'] = md5($_p_admin_pw);
		if ($db->pe_insert('admin', $_p_info)) {
			pe_success('管理增加成功!', 'admin.php?mod=admin&act=list');
		}
		else {
			pe_error('管理增加失败...');
		}
	break;
	//#####################@ 管理修改 @#####################//
	case 'edit':
		$info = $db->pe_select('admin', array('admin_id'=>$_g_id));

		$seo = pe_seo('修改管理信息', '', '', 'admin');
		$action = "admin.php?mod=admin&act=editsql&id={$_g_id}";
		include(pe_tpl('admin_add.html'));
	break;
	//#####################@ 管理修改sql @#####################//
	case 'editsql':
		$_p_admin_pw && $_p_info['admin_pw'] = md5($_p_admin_pw);
		if ($db->pe_update('admin', array('admin_id'=>$_g_id), $_p_info)) {
			pe_success('管理信息修改成功!', 'admin.php?mod=admin&act=list');
		}
		else {
			pe_error('管理信息修改失败...');
		}
	break;
	//#####################@ 管理删除sql @#####################//
	case 'delsql':
		if ($_g_id == 1) {
			pe_error('抱歉，默认管理员不能删除...');
		}
		if ($db->pe_delete('admin', array('admin_id'=>$_g_id))) {
			pe_success('管理删除成功!');
		}
		else {
			pe_error('管理删除失败...');
		}
	break;
	//#####################@ 管理列表 @#####################//
	default:
		$info_list = $db->pe_selectall('admin', '', '*', array(20, $_g_page));

		$seo = pe_seo('管理列表', '', '', 'admin');
		include(pe_tpl('admin_list.html'));
	break;
}
pe_result();
?>