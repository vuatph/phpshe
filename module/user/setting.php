<?php
switch($act) {
	//#####################@ 密码修改  @#####################//
	case 'pw':
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if ($db->pe_update('user', array('user_id'=>$_s_user_id), array('user_pw'=>md5($_p_info['user_pw'])))) {
				pe_success('密码修改成功！');
			}
			else {
				pe_error('密码修改失败...');
			}
		}
		$info = $db->pe_select('user', array('user_id'=>$_s_user_id));
		$menumark = 'setting_pw';
		$seo = pe_seo($menutitle='修改密码');
		include(pe_tpl('setting_pw.html'));
	break;
	//#####################@ 基本信息 @#####################//
	default:
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$sql_set['user_tname'] = $_p_user_tname;
			$sql_set['user_phone'] = $_p_user_phone;
			$sql_set['user_email'] = $_p_user_email;
			$sql_set['user_address'] = $_p_user_address;
			if ($db->pe_update('user', array('user_id'=>$_s_user_id), pe_dbhold($sql_set))) {
				pe_success('资料修改成功！');
			}
			else {
				pe_error('资料修改失败...');
			}
		}
		$info = $db->pe_select('user', array('user_id'=>$_s_user_id));
		$menumark = 'setting_base';
		$seo = pe_seo($menutitle='基本资料');
		include(pe_tpl('setting_base.html'));
	break;
}
?>