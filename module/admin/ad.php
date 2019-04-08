<?php
$menumark = "ad_list";
switch ($act) {
	//#####################@ 增加广告 @#####################//
	case 'add':
		$seo = pe_seo('增加广告', '', '', 'admin');
		$action = "admin.php?mod=ad&act=addsql";
		include(pe_tpl('ad_add.html'));
	break;
	//#####################@ 增加广告sql @#####################//
	case 'addsql':
		if ($_FILES['ad_logo']['size']) {
			pe_lead('include/class/upload.class.php');
			$upload = new upload($_FILES['ad_logo']);
			$_p_info['ad_logo'] = $upload->fileurl;
		}
		if ($db->pe_insert('ad', pe_dbhold($_p_info))) {
			pe_success('广告增加成功!', "admin.php?mod=ad&act=list");
		}
		else {
			pe_error('广告增加失败!');
		}
	break;
	//#####################@ 修改广告 @#####################//
	case 'edit':
		$info = $db->pe_select('ad', array('ad_id'=>$_g_id));

		$seo = pe_seo('修改广告', '', '', 'admin');
		$action = "admin.php?mod=ad&act=editsql&id={$_g_id}";
		include(pe_tpl('ad_add.html'));
	break;
	//#####################@ 修改广告sql @#####################//
	case 'editsql':
		if ($_FILES['ad_logo']['size']) {
			pe_lead('include/class/upload.class.php');
			$upload = new upload($_FILES['ad_logo']);
			$_p_info['ad_logo'] = $upload->fileurl;
		}
		if ($db->pe_update('ad', array('ad_id'=>$_g_id), pe_dbhold($_p_info))) {
			pe_success('广告修改成功!', "admin.php?mod=ad&act=list");
		}
		else {
			pe_error('广告修改失败!');
		}
	break;
	//#####################@ 广告排序sql @#####################//
	case 'ordersql':
		foreach ($_p_ad_order as $k=>$v) {
			$result = $db->pe_update('ad', array('ad_id'=>$k), array('ad_order'=>$v));
		}
		if ($result) {
			pe_success('广告排序成功!');
		}
		else {
			pe_error('广告排序失败!');
		}
	break;
	//#####################@ 广告删除 @#####################//
	case 'delsql':
		if ($db->pe_delete('ad', array('ad_id'=>is_array($_p_ad_id) ? $_p_ad_id : $_g_id))) {
			pe_success('广告删除成功!');
		}
		else {
			pe_error('广告删除失败...');
		}
	break;
	//#####################@ 广告列表 @#####################//
	default :
		$info_list = $db->pe_selectall('ad', array('order by'=>'ad_order asc'), '*', array(20, $_g_page));

		$seo = pe_seo('广告列表', '', '', 'admin');
		include(pe_tpl('ad_list.html'));
	break;
}
pe_result();
?>