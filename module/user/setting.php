<?php
switch($act) {
	//#####################@ 修改头像  @#####################//
	case 'logo':
		$menumark = 'setting_logo';
		$info = $db->pe_select('user', array('user_id'=>$_s_user_id), 'user_logo');
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if ($db->pe_update('user', array('user_id'=>$_s_user_id), array('user_logo'=>$_p_user_logo))) {
				pe_jsonshow(array('result'=>true, 'show'=>'提交成功'));
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'提交失败'));
			}
		}
		$seo = pe_seo($menutitle='修改头像');
		include(pe_tpl('setting_logo.html'));
	break;
	//#####################@ 密码修改  @#####################//
	case 'pw':
		$menumark = 'setting_pw';
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if (!$db->pe_num('user', array('user_id'=>$_s_user_id, 'user_pw'=>md5($_p_user_oldpw)))) {
				pe_error('原密码错误');
			}
			if ($db->pe_update('user', array('user_id'=>$_s_user_id), array('user_pw'=>md5($_p_user_pw)))) {
				pe_success('修改成功！');
			}
			else {
				pe_error('修改失败');
			}
		}
		$seo = pe_seo($menutitle='修改密码');
		include(pe_tpl('setting_pw.html'));
	break;
	//#####################@ 个人信息 @#####################//
	default:
		$menumark = 'setting_base';
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if ($_p_user_phone && !pe_formcheck('phone', $_p_user_phone)) pe_error('请填写正确的手机号');
			if ($_p_user_email && !pe_formcheck('email', $_p_user_email)) pe_error('请填写正确的邮箱');
			$sql_set['user_tname'] = $_p_user_tname;
			$sql_set['user_phone'] = $_p_user_phone;
			$sql_set['user_email'] = $_p_user_email;
			if ($db->pe_update('user', array('user_id'=>$_s_user_id), pe_dbhold($sql_set))) {
				pe_success('修改成功！');
			}
			else {
				pe_error('修改失败');
			}
		}
		$info = $db->pe_select('user', array('user_id'=>$_s_user_id));				
		$seo = pe_seo($menutitle='个人信息');
		include(pe_tpl('setting_base.html'));
	break;
}
?>