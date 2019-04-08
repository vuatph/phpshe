<?php
//记录交易明细
function add_moneylog($user_id, $type, $money, $text=null, $time='') {
	global $db;
	if (in_array($type, array('recharge'))) {
		$sql_user = " `user_money` = `user_money` - '{$money}'";
		$sql_set['moneylog_in'] = $money;
	}
	else {
		$sql_user = " `user_money` = `user_money` - '{$money}'";
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
	if (in_array($type, array('reg', 'comment', 'add', 'order_get', 'order_back'))) {
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
function user_cartnum($cart_list = null) {
	global $db, $_c_cart_list;
	$cart_list = isset($cart_list) ? $cart_list : (unserialize($_c_cart_list) ? unserialize($_c_cart_list) : array());
	$info_list = pe_login('user') ? $db->pe_selectall('cart', array('user_id'=>$_SESSION['user_id'])) : $cart_list;
	foreach ($info_list as $v) {
		$cartnum += $v['product_num'];
	}
	return intval($cartnum);
}
?>