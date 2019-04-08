<?php
switch($act) {
	//#####################@ 用户登录 @#####################//
	case 'login':
		if (isset($_p_pesubmit)) {
			$sql_set['user_name'] = $_p_user_name;
			$sql_set['user_pw'] = md5($_p_user_pw);
			if (strtolower($_s_authcode) != strtolower($_p_authcode)) pe_error('验证码错误');
			if ($info = $db->pe_select('user', pe_dbhold($sql_set))) {
				$db->pe_update('user', array('user_id'=>$info['user_id']), array('user_ltime'=>time()));
				if (!$db->pe_num('pointlog', " and `user_id` = '{$info['user_id']}' and `pointlog_type` = 'reg' and `pointlog_text` = '登录帐号' and `pointlog_atime` >= '".strtotime(date('Y-m-d'))."'")) {
					add_pointlog($info['user_id'], 'reg', $cache_setting['point_login'], '登录帐号');				
				}
				$_SESSION['user_idtoken'] = md5($info['user_id'].$pe['host_root']);
				$_SESSION['user_id'] = $info['user_id'];
				$_SESSION['user_name'] = $info['user_name'];
				$_SESSION['pe_token'] = pe_token_set($_SESSION['user_idtoken']);
				//未登录时的购物车列表入库
				if (is_array($cart_list = unserialize($_c_cart_list))) {
					$cart_rows = $db->index('product_id')->pe_selectall('cart', array('user_id'=>$info['user_id']));
					foreach ($cart_list as $k => $v) {
						if (array_key_exists($k, $cart_rows)) {
							$db->pe_update('cart', array('cart_id'=>intval($cart_rows[$k]['cart_id'])), array('product_num'=>intval($cart_rows[$k]['product_num']+$cart_list[$k]['product_num'])));
						}
						else {
							$cart_info['cart_atime'] = time();
							$cart_info['product_id'] = intval($k);
							$cart_info['product_num'] = intval($v['product_num']);
							$cart_info['user_id'] = $info['user_id'];
							$db->pe_insert('cart', pe_dbhold($cart_info));
						}
					}
					setcookie('cart_list', '', time()-3600, '/');
				}
				pe_success('登录成功！', $_g_fromto);
			}
			else {
				pe_error('用户名或密码错误...');
			}
		}
		$seo = pe_seo($menutitle='用户登录');
 		include(pe_tpl('do_login.html'));
	break;
	//#####################@ 用户退出 @#####################//
	case 'logout':
		unset($_SESSION['user_idtoken'], $_SESSION['user_id'], $_SESSION['user_name']);
		pe_success('退出成功！', $pe['host_root']);
	break;
	//#####################@ 检查信息 @#####################//
	case 'check':
		if ($_g_type == 'authcode') {
			$result = strtolower($_s_authcode) == strtolower($_g_value) ? true : false;		
		}
		elseif ($_g_type == 'name') {
			$result = $db->pe_num('user', array('user_name'=>pe_dbhold($_g_value))) > 0 ? false : true;
		}
		elseif ($_g_type == 'email') {
			$result = $db->pe_num('user', array('user_email'=>pe_dbhold($_g_value))) > 0 ? false : true;
		}
		echo json_encode(array('result'=>$result));
	break;
	//#####################@ 找回密码 @#####################//
	case 'getpw':
		if ($_g_type == 'checkname') {
			$result = $db->pe_num('user', array('user_name'=>pe_dbhold($_g_user_name))) > 0 ? true : false;
			echo json_encode(array('result'=>$result));
			die();
		}
		if ($_g_type == 'checkemail') {
			$result = $db->pe_num('user', array('user_email'=>pe_dbhold($_g_user_email))) > 0 ? true : false;
			echo json_encode(array('result'=>$result));
			die();
		}
		if (isset($_p_pesubmit)) {
			pe_lead('hook/qunfa.hook.php');
			if (!$_p_user_name) pe_error('用户名必须填写...');
			if (!$_p_user_email) pe_error('邮箱必须填写...');
			$sql_set['user_name'] = $_p_user_name;
			$sql_set['user_email'] = $_p_user_email;
			$info = $db->pe_select('user', pe_dbhold($sql_set));
			if (!$info['user_id'])pe_error('不存在的用户名或邮箱...');
			$linshi_pw = substr(md5($pe['host_root'].$info['user_pw'].time()), 5, 8);
			$email['qunfa_name'] = "您好：{$info['user_name']}，您的密码找回信息！";
			$email['qunfa_text'] = "您好：{$info['user_name']}，您的临时登录密码是“{$linshi_pw}”，请尽快登录网站修改密码！";
			qunfa_emaildiy($email, $info['user_id']);
			if ($db->pe_update('user', array('user_id'=>$info['user_id']), array('user_pw'=>md5($linshi_pw)))) {
				pe_success('您的临时登录密码已发送至注册邮箱，请注意查收！');
			}
			else {
				pe_error('取回密码失败...');
			}
		}
		$seo = pe_seo($menutitle='找回密码');
 		include(pe_tpl('do_getpw.html'));
	break;
	//#####################@ 用户注册 @#####################//
	case 'register':
		if (isset($_p_pesubmit)) {
			if($db->pe_num('user', array('user_name'=>pe_dbhold($_g_user_name)))) pe_error('用户名已存在...');
			if($db->pe_num('user', array('user_email'=>pe_dbhold($_g_user_email)))) pe_error('邮箱已存在...');
			if (strtolower($_s_authcode) != strtolower($_p_authcode)) pe_error('验证码错误');
			$sql_set['user_name'] = $_p_user_name;
			$sql_set['user_pw'] = md5($_p_user_pw);
			$sql_set['user_email'] = $_p_user_email;
			$sql_set['user_ip'] = pe_ip();
			$sql_set['user_atime'] = $sql_set['user_ltime'] = time();
			if ($user_id = $db->pe_insert('user', pe_dbhold($sql_set))) {
				add_pointlog($user_id, 'reg', $cache_setting['point_reg'], '注册帐号');
				$info = $db->pe_select('user', array('user_id'=>$user_id));
				$_SESSION['user_idtoken'] = md5($info['user_id'].$pe['host_root']);
				$_SESSION['user_id'] = $info['user_id'];
				$_SESSION['user_name'] = $info['user_name'];
				$_SESSION['pe_token'] = pe_token_set($_SESSION['user_idtoken']);
				//未登录时的购物车列表入库
				if (is_array($cart_list = unserialize($_c_cart_list))) {
					foreach ($cart_list as $k => $v) {
						$cart_info['cart_atime'] = time();
						$cart_info['product_id'] = $k;
						$cart_info['product_num'] = $v['product_num'];
						$cart_info['user_id'] = $info['user_id'];
						$db->pe_insert('cart', pe_dbhold($cart_info));
					}
					setcookie('cart_list', '', time()-3600, '/');
				}
				pe_lead('hook/qunfa.hook.php');
				notice_add('reg');
				pe_success('用户注册成功！', $_g_fromto);
			}
			else {
				pe_error('用户注册失败...');
			}
		}
		$seo = pe_seo($menutitle='用户注册');
 		include(pe_tpl('do_register.html'));
	break;
}
?>