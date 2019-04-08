<?php
$menumark = 'user';
switch($act) {
	//#####################@ 修改地址 @#####################//
	case 'edit':
		$address_id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$_p_info['address_area'] = $_p_info['address_area'];					
			if ($db->pe_update('useraddr', array('address_id'=>$address_id), pe_dbhold($_p_info))) {
				pe_success('修改成功！', '', 'dialog');
			}
			else {
				pe_error('修改失败...');
			}
		}
		$info = $db->pe_select('useraddr', array('address_id'=>$address_id));
		$seo = pe_seo($menutitle='修改地址');
		include(pe_tpl('useraddr_add.html'));
	break;
	//#####################@ 地址删除 @#####################//
	case 'del':
		pe_token_match();
		if ($db->pe_delete('useraddr', array('address_id'=>is_array($_p_address_id) ? $_p_address_id : $_g_id))) {
			pe_success('删除成功！');
		}
		else {
			pe_error('删除失败...');
		}
	break;
	//#####################@ 地址列表 @#####################//
	default:
		$_g_name && $sqlwhere .= " and `user_name` like '%{$_g_name}%'";
		$_g_tname && $sqlwhere .= " and `user_tname` like '%{$_g_tname}%'";
		$_g_phone && $sqlwhere .= " and `user_phone` like '%{$_g_phone}%'";
		$_g_user_id && $sqlwhere .= " and `user_id` = '{$_g_user_id}'";
		$sqlwhere .= " order by `address_id` desc";
		$info_list = $db->pe_selectall('useraddr', $sqlwhere, '*', array(50, $_g_page));

		$tongji['user'] = $db->pe_num('user');
		$tongji['useraddr'] = $db->pe_num('useraddr');
		$tongji['userbank'] = $db->pe_num('userbank');
		$seo = pe_seo($menutitle='收货地址');
		include(pe_tpl('useraddr_list.html'));
	break;
}
?>