<?php
$menumark = 'page_list';
pe_lead('hook/cache.hook.php');
switch ($act) {
	//#####################@ 单页增加 @#####################//
	case 'add':
		$seo = pe_seo('增加单页', '', '', 'admin');
		$action = 'admin.php?mod=page&act=addsql';
		include(pe_tpl('page_add.html'));
	break;
	//#####################@ 单页增加sql @#####################//
	case 'addsql':
		if ($db->pe_insert('page', pe_dbhold($_p_info, array('page_text')))) {
			cache_write('page');
			pe_success('单页增加成功!', 'admin.php?mod=page&act=list');
		}
		else {
			pe_error('单页增加失败...');
		}
	break;
	//#####################@ 单页修改 @#####################//
	case 'edit':
		$info = $db->pe_select('page', array('page_id'=>$_g_id));

		$seo = pe_seo('修改单页', '', '', 'admin');
		$action = "admin.php?mod=page&act=editsql&id={$_g_id}";
		include(pe_tpl('page_add.html'));
	break;
	//#####################@ 单页修改sql @#####################//
	case 'editsql':
		if ($db->pe_update('page', array('page_id'=>$_g_id), pe_dbhold($_p_info, array('page_text')))) {
			cache_write('page');
			pe_success('单页修改成功!', 'admin.php?mod=page&act=list');
		}
		else {
			pe_error('单页修改失败...');
		}
	break;
	//#####################@ 单页删除sql @#####################//
	case 'delsql':
		if ($db->pe_delete('page', array('page_id'=>is_array($_p_id) ? $_p_id : $_g_id))) {
			cache_write('page');
			pe_success('单页删除成功!');
		}
		else {
			pe_error('单页删除失败...');
		}
	break;
	//#####################@ 单页列表 @#####################//
	default :
		$seo = pe_seo('单页列表', '', '', 'admin');
		$info_list = $db->pe_selectall('page', array('order by'=>'`page_id` desc'), '*', array(20, $_g_page));
		include(pe_tpl('page_list.html'));
	break;
}
pe_result();
?>