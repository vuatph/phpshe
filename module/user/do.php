<?php
switch($act) {
	//#####################@ 用户登录 @#####################//
	case 'login':
		if (isset($_p_pesubmit)) {
			$sql_set['user_name'] = $_p_user_name;
			$sql_set['user_pw'] = md5($_p_user_pw);
			//if (!$_p_authcode || strtolower($_s_authcode) != strtolower($_p_authcode)) pe_jsonshow(array('result'=>false, 'show'=>'验证码错误'));
			if ($info = $db->pe_select('user', pe_dbhold($sql_set))) {
				$db->pe_update('user', array('user_id'=>$info['user_id']), array('user_ltime'=>time()));
				if (!$db->pe_num('pointlog', " and `user_id` = '{$info['user_id']}' and `pointlog_type` = 'give' and `pointlog_text` = '每日登录' and `pointlog_atime` >= '".strtotime(date('Y-m-d'))."'")) {
					add_pointlog($info['user_id'], 'give', $cache_setting['point_login'], '每日登录');				
				}
				$_SESSION['user_idtoken'] = md5($info['user_id'].$pe['host_root']);
				$_SESSION['user_id'] = $info['user_id'];
				$_SESSION['user_name'] = $info['user_name'];
				$_SESSION['user_ltime'] = $info['user_ltime'];
				$_SESSION['pe_token'] = pe_token_set($_SESSION['user_idtoken']);
				pe_jsonshow(array('result'=>true, 'show'=>'登录成功！'));
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'用户名或密码错误'));
			}
		}
		$seo = pe_seo($menutitle='用户登录');
 		include(pe_tpl('do_login.html'));
	break;
	//#####################@ 用户退出 @#####################//
	case 'logout':
		unset($_SESSION['user_idtoken'], $_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_ltime'], $_SESSION['pe_token']);
		pe_success('退出成功！', $pe['host_root']);
	break;
	//#####################@ 找回密码 @#####################//
	case 'getpw':
		if (isset($_p_pesubmit)) {
			if (!$_p_user_name) pe_jsonshow(array('result'=>false, 'show'=>'请填写用户名'));
			if (!$_p_user_email) pe_jsonshow(array('result'=>false, 'show'=>'请填写邮箱'));
			$info = $db->pe_select('user', array('user_name'=>pe_dbhold($_p_user_name)));
			if (!$info['user_id']) pe_jsonshow(array('result'=>false, 'show'=>'用户名不存在'));
			if ($info['user_email'] != $_p_user_email) pe_jsonshow(array('result'=>false, 'show'=>'邮箱错误'));			
			if (!$_p_authcode || strtolower($_s_authcode) != strtolower($_p_authcode)) pe_jsonshow(array('result'=>false, 'show'=>'验证码错误'));
			//发送找回密码邮件
			pe_lead('hook/qunfa.hook.php');
			$token = md5($_p_authcode.time().rand(111111,999999).microtime(true));
			$url = "{$pe['host_root']}user.php?mod=do&act=setpw&token={$token}";
			$email['qunfa_name'] = "您好：{$info['user_name']}，您的密码找回信息！";
			$email['qunfa_text'] = "您正在尝试找回登录密码，请点击该链接：<a href='{$url}'>{$url}</a>，进入网站重置密码，如非本人操作，请忽略此邮件！<br />（此链接30分钟内有效）";
			$qunfa = qunfa_email($email, $info['user_email']);
			if (!$qunfa['result']) pe_jsonshow(array('result'=>false, 'show'=>$qunfa['show']));
			//生成找回密码记录
			$db->pe_update('getpw', array('user_id'=>$info['user_id']), array('getpw_state'=>1));
			$sql_set['getpw_token'] = $token;
			$sql_set['getpw_atime'] = time();
			$sql_set['user_id'] = $info['user_id'];
			$sql_set['user_name'] = $info['user_name'];
			if ($db->pe_insert('getpw', pe_dbhold($sql_set))) {
				pe_jsonshow(array('result'=>true, 'show'=>'找回密码链接已发至您的邮箱，请查收！', 'token'=>$sql_set['getpw_token']));			
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'提交失败'));		
			}
		}
		$seo = pe_seo($menutitle='找回密码');
 		include(pe_tpl('do_getpw.html'));
	break;
	//#####################@ 重置密码 @#####################//
	case 'setpw':
		if (isset($_p_pesubmit)) {
			$nowtime = time() - 1800;
			if (!$_g_token) pe_jsonshow(array('result'=>false, 'show'=>'链接已失效'));
			$info = $db->pe_select('getpw', " and `getpw_token` = '".pe_dbhold($_g_token)."' and `getpw_state` = 0 and `getpw_atime` >= '{$nowtime}'");
			if (!$info['getpw_id']) pe_jsonshow(array('result'=>false, 'show'=>'链接已失效'));
			if (strlen($_p_user_pw) < 6 or strlen($_p_user_pw) > 20) pe_jsonshow(array('result'=>false, 'show'=>'新密码为6-20位字符'));
			if ($db->pe_update('user', array('user_id'=>$info['user_id']), array('user_pw'=>md5($_p_user_pw)))) {
				$db->pe_update('getpw', array('user_id'=>$info['user_id']), array('getpw_state'=>1));
				pe_jsonshow(array('result'=>true, 'show'=>'密码重置成功'));
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'密码重置失败'));
			}
		}
		$seo = pe_seo($menutitle='重置密码');
 		include(pe_tpl('do_setpw.html'));
	break;
	//#####################@ 用户注册 @#####################//
	case 'register':
		if (isset($_p_pesubmit)) {
			if (mb_strlen($_p_user_name, 'utf8') < 5 or mb_strlen($_p_user_name, 'utf8') > 15) pe_jsonshow(array('result'=>false, 'show'=>'用户名为5-15位字符'));
			if (!pe_formcheck('uname', $_p_user_name)) pe_jsonshow(array('result'=>false, 'show'=>'用户名有特殊字符'));				
			if ($db->pe_num('user', array('user_name'=>pe_dbhold($_p_user_name)))) pe_jsonshow(array('result'=>false, 'show'=>'用户名已存在'));
			if (strlen($_p_user_pw) < 6 or strlen($_p_user_pw) > 20) pe_jsonshow(array('result'=>false, 'show'=>'密码为6-20位字符'));
			if ($_p_user_pw != $_p_user_pw1) pe_jsonshow(array('result'=>false, 'show'=>'两次密码不一致'));
			if (!pe_formcheck('email', $_p_user_email)) pe_jsonshow(array('result'=>false, 'show'=>'请填写正确的邮箱'));
			if ($db->pe_num('user', array('user_email'=>pe_dbhold($_p_user_email)))) pe_jsonshow(array('result'=>false, 'show'=>'邮箱已存在'));
			if (!$_p_authcode || strtolower($_s_authcode) != strtolower($_p_authcode)) pe_jsonshow(array('result'=>false, 'show'=>'验证码错误'));
			$sql_set['user_name'] = $_p_user_name;
			$sql_set['user_pw'] = md5($_p_user_pw);
			$sql_set['user_email'] = $_p_user_email;
			$sql_set['user_ip'] = pe_ip();
			$sql_set['user_atime'] = $sql_set['user_ltime'] = time();
			if ($_s_user_wx_openid) $sql_set['user_wx_openid'] = $_s_user_wx_openid;
			if ($user_id = $db->pe_insert('user', pe_dbhold($sql_set))) {
				add_pointlog($user_id, 'give', $cache_setting['point_reg'], '新用户注册');
				$info = $db->pe_select('user', array('user_id'=>$user_id));
				$_SESSION['user_idtoken'] = md5($info['user_id'].$pe['host_root']);
				$_SESSION['user_id'] = $info['user_id'];
				$_SESSION['user_name'] = $info['user_name'];
				$_SESSION['user_ltime'] = time();
				$_SESSION['pe_token'] = pe_token_set($_SESSION['user_idtoken']);
				//add_noticelog($_s_user_id, 'reg');
				pe_jsonshow(array('result'=>true, 'show'=>'注册成功！'));
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'注册失败'));
			}
		}
		$seo = pe_seo($menutitle='用户注册');
 		include(pe_tpl('do_register.html'));
	break;
}
?>