<?php
switch ($act) {
	//#####################@ 管理员退出 @#####################//
	case 'logout':
		unset($_SESSION['admin_id_key'], $_SESSION['admin_id'], $_SESSION['admin_name']);
		pe_success('管理员退出成功！', 'admin.php');
	break;
	//#####################@ 管理员登录sql @#####################//
	case 'loginsql':
		$_p_info['admin_pw'] = md5($_p_info['admin_pw']);
		if ($info = $db->pe_select('admin', pe_dbhold($_p_info))) {
			$db->pe_update('admin', array('admin_id'=>$info['admin_id']), array('admin_ltime'=>time()));
			$_SESSION['admin_id_key'] = md5($pe['host_root'].time());
			$_SESSION['admin_id'] = $info['admin_id'];
			$_SESSION['admin_name'] = $info['admin_name'];
			pe_success('管理员登录成功！', 'admin.php');
		}
		else {
			pe_error('用户名或密码错误...');
		}
	break;
	//#####################@ 管理员登录 @#####################//
	default:
		$seo = pe_seo('管理员登录', '', '', 'admin');
		$action = 'admin.php?mod=do&act=loginsql';
		include(pe_tpl('do_login.html'));
	break;
}
pe_result();
?>