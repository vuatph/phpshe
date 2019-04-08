<?php
//记录交易明细
function add_moneylog($user_id, $type, $money, $text=null, $time='') {
	global $db;
	if (in_array($type, array('recharge', 'add', 'back'))) {
		$sql_user = "`user_money` = `user_money` + '{$money}'";
		$sql_set['moneylog_in'] = $money;
	}
	else {
		$sql_user = "`user_money` = `user_money` - '{$money}'";
		$sql_set['moneylog_out'] = $money;
	}
	if ($db->pe_update('user', array('user_id'=>$user_id), $sql_user)) {
		$user = $db->pe_select('user', array('user_id'=>$user_id));
		$sql_set['moneylog_text'] = $text;
		$sql_set['moneylog_now'] = $user['user_money'];
		$sql_set['moneylog_atime'] = $time ? $time : time();
		$sql_set['moneylog_type'] = $type;
		$sql_set['user_id'] = $user['user_id'];
		$sql_set['user_name'] = $user['user_name'];
		$db->pe_insert('moneylog', pe_dbhold($sql_set, array('moneylog_text')));
		return true;
	}
	else {
		return false;
	}
}

//增加积分
function add_pointlog($user_id, $type, $point = 0, $text = null) {
	global $db, $cache_setting;
	if (!$cache_setting['point_state']) return false;
	$point = intval($point);
	if (!$point) return false;	
	if (in_array($type, array('give', 'add', 'back'))) {
		$sqlset_user = " `user_point` = `user_point` + '{$point}', `user_point_all` = `user_point_all` + '{$point}'";
		$sqlset_pointlog['pointlog_in'] = $point;
	}
	else {
		$sqlset_user = " `user_point` = `user_point` - '{$point}', `user_point_all` = `user_point_all` - '{$point}'";
		$sqlset_pointlog['pointlog_out'] = $point;
	}
	if ($db->pe_update('user', array('user_id'=>$user_id), $sqlset_user)) {
		$user = $db->pe_select('user', array('user_id'=>$user_id));
		if (!$user['user_id']) return false;
		$sqlset_pointlog['pointlog_text'] = $text;
		$sqlset_pointlog['pointlog_now'] = $user['user_point'];
		$sqlset_pointlog['pointlog_atime'] = time();
		$sqlset_pointlog['pointlog_type'] = $type;
		$sqlset_pointlog['user_id'] = $user['user_id'];
		$sqlset_pointlog['user_name'] = $user['user_name'];
		$db->pe_insert('pointlog', pe_dbhold($sqlset_pointlog, array('pointlog_text')));
		return true;
	}
	else {
		return false;
	}
}

//获取用户积分
function user_point($user_id, $type = '') {
	global $db, $cache_setting;
	$user = $db->pe_select('user', array('user_id'=>$user_id), "`user_point`");
	//冻结积分
	$order = $db->pe_select('order', array('user_id'=>$user_id, 'order_state'=>array('notpay', 'paid', 'send')), "sum(`order_point_use`) as `point`");
	//冻结金额
	$user_lock = $order['point'];	
	$user_real = round($user['user_point'] - $user_lock, 1);
	$user_money = $cache_setting['point_money'] ? round($user_real/$cache_setting['point_money'], 1) : 0;
	$point_arr = array('all'=>$user['user_point'], 'real'=>$user_real, 'lock'=>$user_lock, 'money'=>$user_money);
	if ($type) {
		return $point_arr[$type];
	}
	else {
		return $point_arr;
	}
}

//获取用户金额
function user_money($user_id, $type = '') {
	global $db;
	$user = $db->pe_select('user', array('user_id'=>$user_id), "`user_money`");
	//申请提现中金额
	$cashout = $db->pe_select('cashout', array('user_id'=>$user_id, 'cashout_state'=>0), "sum(`cashout_money`) as `money`");
	//冻结金额
	$user_lock = round($cashout['money'], 1);	
	$user_real = round($user['user_money'], 1);
	//浮点数精度问题，相减round后等于-0(2015-08-19修正)
	if ($user_real == '-0') $user_real = 0;
	$money_arr = array('all'=>$user['user_money'], 'real'=>$user_real, 'lock'=>$user_lock);
	if ($type) {
		return $money_arr[$type];
	}
	else {
		return $money_arr;
	}
}

//检测优惠券是否过期
function user_quancheck() {
	global $db;
	$db->pe_update('quanlog', " and `quanlog_state` = 0 and `quan_edate` < '".date('Y-m-d')."'", array('quanlog_state'=>2));
}
//获取可用优惠券
function user_quanlist() {
	global $db;
	$info_list = $db->index('quanlog_id')->pe_selectall('quanlog', array('user_id'=>$_SESSION['user_id'], 'quanlog_state'=>0));
	$quan_list = array();
	$cart_list = cart_list(unserialize($_COOKIE['cart_list']));
	foreach ($info_list as $k=>$v) {
		if ($v['product_id']) {
			$quan_limit = 0;
			foreach ($cart_list['list'] as $vv) {
				if (in_array($vv['product_id'], explode(',', $v['product_id']))) {
					$quan_limit += $vv['product_money'] * $vv['product_num'];
				}
			}
			if ($quan_limit >= $v['quan_limit']) $quan_list[$k] = $v;
		}
		else {
			if ($cart_list['money']['order_product_money'] >= $v['quan_limit']) $quan_list[$k] = $v;
		}
	}	
	return $quan_list;
}
//更新优惠券状态
function user_quanupdate($quanlog_id, $state) {
	global $db;
	if (!$quanlog_id) return false;
	$sql_set['quanlog_utime'] = $state == 1 ? time() : 0;
	$sql_set['quanlog_state'] = intval($state);	
	$db->pe_update('quanlog', array('quanlog_id'=>intval($quanlog_id)), $sql_set);
	//统计领取数和使用数
	$info = $db->pe_select('quanlog', array('quanlog_id'=>intval($quanlog_id)));
	$tongji = $db->index('quanlog_state')->pe_selectall('quanlog', array('quan_id'=>$info['quan_id'], 'group by'=>'quanlog_state'), "count(1) as `num`, `quanlog_state`");
	$quan_num_get = intval($tongji[0]['num'] + $tongji[1]['num'] + $tongji[2]['num']);
	$quan_num_use = intval($tongji[1]['num']);
	$db->pe_update('quan', array('quan_id'=>$info['quan_id']), array('quan_num_get'=>$quan_num_get, 'quan_num_use'=>$quan_num_use));
	user_quancheck();
}

//获取购物车商品数
function user_cartnum() {
	global $db, $_c_cart_list;
	$user_id = pe_login('user') ? $_SESSION['user_id'] : pe_user_id();
	$info_list = $db->pe_selectall('cart', array('user_id'=>$user_id));
	foreach ($info_list as $v) {
		$cartnum += $v['product_num'];
	}
	return intval($cartnum);
}

//显示收款账号
function userbank_num($val) {
	if (preg_match("/^1[34578]{1}\d{9}$/", $val)) {
		$val = substr($val, 0, 3).'**'.substr($val, -4);
	}
	elseif (stripos($val, '@') !== false) {
		$val = substr($val, 0, 3).'**'.stristr($val, '@');
	}
	else {
		$val = substr($val, 0, 4).'**'.substr($val, -4);
	}
	return $val;
}

//检测游客购买
function user_checkguest() {
	global $cache_setting;
	if ($cache_setting['web_guestbuy'] == 0 && !pe_login('user')) {
		return false;
	}
	else {
		return true;
	}
}

//发送邮件/短信通知
function add_noticelog($id, $type) {
	global $db, $ini;
	$setting = cache::get('setting');
	$cache_notice = cache::get('notice');
	$notice = $cache_notice[$type];
	if ($type == 'reg') {
		$user = $db->pe_select('user', array('user_id'=>$id));
	}
	else {
		$info = $db->pe_select('order', array('order_id'=>pe_dbhold($id)));
		$user = $db->pe_select('user', array('user_id'=>$info['user_id']));
	}
	foreach ($ini['notice_tpl'] as $k=>$v) {
		if ($type == 'reg') $info[$k] = $user['user_name'];
		//$notice['user']['notice_emailname'] = str_ireplace("{order_id}", $info[$k], $notice['user']['notice_emailname']);
		$notice['user']['notice_sms_text'] = str_ireplace("{{$k}}", $info[$k], $notice['user']['notice_sms_text']);
		$notice['user']['notice_email_name'] = str_ireplace("{{$k}}", $info[$k], $notice['user']['notice_email_name']);
		$notice['user']['notice_email_text'] = str_ireplace("{{$k}}", $info[$k], $notice['user']['notice_email_text']);
		$notice['admin']['notice_sms_text'] = str_ireplace("{{$k}}", $info[$k], $notice['admin']['notice_sms_text']);
		$notice['admin']['notice_email_name'] = str_ireplace("{{$k}}", $info[$k], $notice['admin']['notice_email_name']);
		$notice['admin']['notice_email_text'] = str_ireplace("{{$k}}", $info[$k], $notice['admin']['notice_email_text']);
	}
	/*if ($cache_notice[$type]['user']['notice_state']) {
		$_SESSION['notice'][] = array('type'=>'sms', 'user'=>$info['user_phone'], 'text'=>$notice['smstpl_user']);		
	}
	if ($cache_notice[$type]['admin']['notice_state']) {
		$_SESSION['notice'][] = array('type'=>'sms', 'user'=>$setting['sms_admin'], 'text'=>$notice['smstpl_admin']);		
	}*/
	if ($notice['user']['notice_email_state'] && $user['user_email']) {
		$info_list['noticelog_type'] = 'email';
		$info_list['noticelog_user'] = pe_dbhold($user['user_email']);
		$info_list['noticelog_name'] = pe_dbhold($notice['user']['notice_email_name']);
		$info_list['noticelog_text'] = $notice['user']['notice_email_text'];
		$info_list['noticelog_atime'] = time();
		$sql_set[] = $info_list;
	}
	if ($notice['admin']['notice_email_state'] && $setting['email_admin']) {
		foreach (explode(',', $setting['email_admin']) as $v) {
			$info_list['noticelog_type'] = 'email';
			$info_list['noticelog_user'] = pe_dbhold($v);
			$info_list['noticelog_name'] = pe_dbhold($notice['admin']['notice_email_name']);
			$info_list['noticelog_text'] = $notice['admin']['notice_email_text'];
			$info_list['noticelog_atime'] = time();
			$sql_set[] = $info_list;	
		}		
	}
	if ($notice['user']['notice_sms_state'] && $info['user_phone']) {
		$info_list['noticelog_type'] = 'sms';
		$info_list['noticelog_user'] = pe_dbhold($info['user_phone']);
		$info_list['noticelog_name'] = '';
		$info_list['noticelog_text'] = "【{$setting['sms_sign']}】{$notice['user']['notice_sms_text']}";
		$info_list['noticelog_atime'] = time();
		$sql_set[] = $info_list;
	}
	if ($notice['admin']['notice_sms_state'] && $setting['sms_admin']) {
		foreach (explode(',', $setting['sms_admin']) as $v) {
			$info_list['noticelog_type'] = 'sms';
			$info_list['noticelog_user'] = pe_dbhold($v);
			$info_list['noticelog_name'] = '';
			$info_list['noticelog_text'] = "【{$setting['sms_sign']}】{$notice['admin']['notice_sms_text']}";
			$info_list['noticelog_atime'] = time();
			$sql_set[] = $info_list;	
		}		
	}
	$db->pe_insert('noticelog', $sql_set);
}
?>