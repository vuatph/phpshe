<?php
//购物车商品列表和价格
function cart_list() {
	global $db;
	$user_id = pe_login('user') ? $_SESSION['user_id'] : pe_user_id();
	$cart_list = $db->pe_selectall('cart', array('user_id'=>$user_id));
	foreach ($cart_list as $k=>$v) {
		$v['product_id'] = intval($v['product_id']);
		$v['prorule_key'] = pe_dbhold($v['prorule_key']);
		$product_guid = pe_dbhold($v['product_guid']);
		if ($v['prorule_key']) {
			$sql = "select a.`product_id`, a.`product_name`, a.`product_logo`, a.`product_money`, a.`product_smoney`, b.`product_money` as `prorule_money`, a.`product_wlmoney`, a.`product_point`, b.`product_num` as `product_maxnum`, a.`product_rule`, b.`prorule_name` from `".dbpre."product` a, `".dbpre."prorule` b where a.`product_id` = b.`product_id` and b.`product_id` = '{$v['product_id']}' and b.`prorule_key` = '{$v['prorule_key']}'";
			$product = $db->sql_select($sql);
			//检测活动价格
			$product['product_money'] = $product['product_money'] == $product['product_smoney'] ? $product['prorule_money'] : $product['product_money'];
			//如果管理后台已经把购物者中这个商品的规格或者变更了
			if (!$product['product_id']) continue;
		}
		else {
			$product = $db->pe_select('product', array('product_id'=>$v['product_id']), "`product_id`, `product_name`, `product_logo`, `product_money`, `product_wlmoney`, `product_point`, `product_num` as `product_maxnum`, `product_rule`");
			//如果管理后台已经把购物者中这个商品的规格或者变更了
			if (!$product['product_id'] or $product['product_rule']) continue;
		}
		$info_list[$product_guid] = $product;
		$info_list[$product_guid]['product_guid'] = $product_guid;
		$info_list[$product_guid]['product_num'] = intval($v['product_num']);
		$info_list[$product_guid]['prorule_key'] = $v['prorule_key'];
		if ($product['product_rule']) {
			$prorule_name = '';
			$prorule_name_arr = explode(',', $product['prorule_name']);
			$product_rule = unserialize($product['product_rule']);
			foreach ($product_rule as $kk=>$vv) {
				$prorule_name[] = array('name'=>$vv['name'], 'value'=>$prorule_name_arr[$kk]);
			}
			$info_list[$product_guid]['prorule_name'] = serialize($prorule_name);
		}
		$money['order_product_money'] += $v['product_num'] * $product['product_money'];
		$money['order_wl_money'] += $product['product_wlmoney'];
		$money['order_point_get'] += $v['product_num'] * $product['product_point'];
	}
	$money['order_money'] = number_format($money['order_wl_money'] + $money['order_product_money'], 1, '.', '');
	$money['order_product_money'] = number_format($money['order_product_money'], 1, '.', '');
	$money['order_wl_money'] = number_format($money['order_wl_money'], 1, '.', '');
	$money['order_point_get'] = intval($money['order_point_get']);
	return array('list'=>(array)$info_list, 'money'=>$money);
}

//订单支付方式
function payway_list($type = 'order') {
	$cache_payway = cache::get('payway');
	$payway_list = array();
	$user_login = pe_login('user');
	foreach ($cache_payway as $k=>$v) {
		if (!$v['payway_state']) continue;
		if ($v['payway_mark'] == 'balance' && !$user_login) continue;
		if ($type == 'order') {
			$payway_list[$k]['payway_name'] = $v['payway_name'];		
			$payway_list[$k]['payway_mark'] = $v['payway_mark'];
		}
		elseif ($type == 'pay' && !in_array($v['payway_mark'], array('cod', 'balance', 'bank'))) {
			$payway_list[$k]['payway_name'] = $v['payway_name'];		
			$payway_list[$k]['payway_mark'] = $v['payway_mark'];
		}
		elseif ($type == 'admin' && !in_array($v['payway_mark'], array('cod', 'bank'))) {
			$payway_list[$k]['payway_name'] = $v['payway_name'];		
			$payway_list[$k]['payway_mark'] = $v['payway_mark'];
		}
	}
	return $payway_list;
}

//订单状态计算
function order_stateshow($info, $type = 'html') {
	if ($info['order_state'] == 'wpay') {
		$text = '等待付款';
		$html = "<span class=\"corg\">{$text}</span>";
	}
	elseif ($info['order_state'] == 'wsend') {
		$text = '等待发货';
		$html = "<span class=\"corg\">{$text}</span>";
	}
	elseif ($info['order_state'] == 'wget') {
		$text = '已发货';
		$html = "<span class=\"corg\">{$text}</span>";
	}
	elseif ($info['order_state'] == 'success') {
		$text = '交易完成';
		$html = "<span class=\"cgreen\">{$text}</span>";
	}
	elseif ($info['order_state'] == 'close') {
		$text = '交易关闭';
		$html = "<del class=\"corg\">{$text}</del>";
	}
	return $type == 'html' ? $html : $text;
}

function order_money_yh($money) {
	if ($money > 0) {
		return '+'.round($money, 1);
	}
	elseif ($money < 0) {
		return round($money, 1);
	}
	return '';
}

//生成订单id
function order_setid($table = null) {
	global $db;
	$order_id = date('ymdHis').mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);
	if ($table) {
		$order_id = "{$table}_{$order_id}";
		$table = "order_{$table}";
	}
	else {
		$table = 'order';
	}
	if ($db->pe_num($table, array('order_id'=>$order_id))) {
		return order_setid();
	}
	else {
		return $order_id;
	}
}

//获取订单对应表名
function order_table($id) {
	if (stripos($id, '_') !== false) {
		$id_arr = explode('_', $id);
		return "order_{$id_arr[0]}";
	}
	else {
		return "order";	
	}
}

//订单创建操作
function order_calback_add($order_id) {
	global $db;
	pe_lead('hook/user.hook.php');
	pe_lead('hook/product.hook.php');
	$info = $db->pe_select('order', array('order_id'=>$order_id));
	//扣除交易使用积分
	add_pointlog($info['user_id'], 'order_pay', $info['order_point_use'], "订单支付抵现，单号【{$order_id}】");
	user_quanupdate($info['order_quan_id'], 1);
	product_num($order_id, 'delnum');
	add_noticelog($order_id, 'order_add');
	//统计用户订单数
	$user_ordernum = $db->pe_num('order', array('user_id'=>$info['user_id']));
	$db->pe_update('user', array('user_id'=>$info['user_id']), array('user_ordernum'=>$user_ordernum));
	//清空购物车
	$user_id = pe_login('user') ? $_SESSION['user_id'] : pe_user_id();
	$db->pe_delete('cart', array('user_id'=>$user_id));
	return true;
}

//订单付款操作
function order_callback_pay($order_id, $order_outid = '', $order_payway = '') {
	global $db;
	pe_lead('hook/user.hook.php');
	pe_lead('hook/product.hook.php');
	$cache_payway = cache::get('payway');
	if (order_table($order_id) == 'order_pay') {
		$info = $db->pe_select('order_pay', array('order_id'=>$order_id));
		if ($info['order_state'] != 'wpay') return;
		$sql_set['order_outid'] = $order_outid;
		$sql_set['order_payway'] = $order_payway;
		$sql_set['order_state'] = 'success';
		$sql_set['order_pstate'] = 1;
		$sql_set['order_ptime'] = time();					
		$db->pe_update('order_pay', array('order_id'=>$order_id), pe_dbhold($sql_set));
		add_moneylog($info['user_id'], 'recharge', $info['order_money'], "账户充值{$info['order_money']}元 - {$cache_payway[$order_payway]['payway_name']}");
	}
	else {
		$info = $db->pe_select('order', array('order_id'=>$order_id));
		if (!$info['order_id']) return false;
		if ($order_outid) $sql_set['order_outid'] = $order_outid;
		if ($order_payway) $sql_set['order_payway'] = $info['order_payway'] = $order_payway;
		$sql_set['order_state'] = 'wsend';
		$sql_set['order_pstate'] = 1;
		$sql_set['order_ptime'] = time();	
		if ($db->pe_update('order', array('order_id'=>$order_id), pe_dbhold($sql_set))) {
			if ($info['order_payway'] == 'balance') {
				add_moneylog($info['user_id'], 'order_pay', $info['order_money'], "支付订单扣除，单号【{$order_id}】");
			}
			product_num($order_id, 'sellnum');
			add_noticelog($order_id, 'order_pay');
			return true;
		}
		else {
			return false;
		}
	}
}

//订单发货操作
function order_callback_send($order_id, $order_wl_id='', $order_wl_name='') {
	global $db;
	pe_lead('hook/user.hook.php');
	$info = $db->pe_select('order', array('order_id'=>$order_id));
	if (!$info['order_id']) return false;
	//担保交易（自动同步支付宝）
	if ($info['order_payway'] == 'alipay_db') {
		include("{$pe['path_root']}include/plugin/payway/alipay/order_send.php");	
	}
	if ($order_wl_id) $sql_set['order_wl_id'] = $order_wl_id;
	if ($order_wl_name) $sql_set['order_wl_name'] = $order_wl_name;
	$sql_set['order_state'] = 'wget';
	$sql_set['order_sstate'] = 1;
	$sql_set['order_stime'] = time();
	if ($db->pe_update('order', array('order_id'=>$order_id), pe_dbhold($sql_set))) {
		add_noticelog($order_id, 'order_send');
		return true;
	}
	else {
		return false;
	}
}

//订单收货操作
function order_callback_success($order_id) {
	global $db;
	pe_lead('hook/user.hook.php');
	pe_lead('hook/product.hook.php');
	$info = $db->pe_select('order', array('order_id'=>$order_id));
	//if (in_array($info['order_payway'], array('alipay_db', 'cod'))) return array('result'=>false, 'show'=>'订单无需确认...');
	$sql_set['order_state'] = 'success';
	if ($info['order_payway'] == 'cod') {
		$sql_set['order_pstate'] = 1;
		$sql_set['order_ptime'] = time();
	}
	$sql_set['order_ftime'] = time();
	if ($db->pe_update('order', array('order_id'=>$order_id), pe_dbhold($sql_set))) {
		add_pointlog($info['user_id'], 'give', $info['order_point_get'], "交易完成获得，单号【{$order_id}】");
		if ($info['order_payway'] == 'cod') {
			product_num($order_id, 'sellnum');
		}
		return true;
	}
	else {
		return false;
	}
}
//订单关闭操作
function order_callback_close($order_id, $order_closetext) {
	global $db;
	pe_lead('hook/user.hook.php');
	pe_lead('hook/product.hook.php');
	$info = $db->pe_select('order', array('order_id'=>$order_id));
	$sql_set['order_ftime'] = time();
	$sql_set['order_state'] = 'close';
	$sql_set['order_closetext'] = $order_closetext;
	if ($db->pe_update('order', array('order_id'=>$order_id), pe_dbhold($sql_set))) {
		add_pointlog($info['user_id'], 'back', $info['order_point_use'], "订单取消退还，单号【{$order_id}】");
		if ($info['order_pstate']) {
			add_moneylog($info['user_id'], 'back', $info['order_money'], "订单取消退款，单号【{$order_id}】");
		}
		user_quanupdate($info['order_quan_id'], 0);
		product_num($order_id, 'addnum');
		add_noticelog($order_id, 'order_close');				
		return true;
	}
	else {
		return false;
	}
}

//订单评价操作
function order_callback_comment($order_id) {
	global $db, $cache_setting;
	pe_lead('hook/user.hook.php');
	pe_lead('hook/product.hook.php');
	$info = $db->pe_select('order', array('order_id'=>$order_id));
	if ($db->pe_update('order', array('order_id'=>$order_id), array('order_comment'=>1))) {
		$info_list = $db->pe_selectall('orderdata', array('order_id'=>$order_id));
		foreach ($info_list as $k=>$v) {
			product_num($v['product_id'], 'commentnum');
		}
		add_pointlog($info['user_id'], 'give', $cache_setting['point_comment'], "发表评价获得，单号【{$order_id}】");	
		return true;
	}
	else {
		return false;
	}
}

//订单支付后跳转
function order_pay_goto($order_id, $jump = 1) {
	global $db, $pe;
	if (order_table($order_id) == 'order_pay') {
		$show = '充值成功！';
		$url = "{$pe['host_root']}user.php?mod=moneylog";	
	}
	else {
		$show = '支付成功！';
		$url = "{$pe['host_root']}user.php?mod=order&act=view&id={$order_id}";
	}
	if ($jump) {
		pe_success($show, $url);
	}
	else {
		return array('show'=>$show, 'url'=>$url);
	}
}

//添加下单收货地址
function useraddr_add($info) {
	global $db, $_s_user_id, $_c_pe_useraddr;
	if (pe_login('user')) {
		if ($info['address_default'] == 1) {
			$db->pe_update('useraddr', array('user_id'=>$_s_user_id), array('address_default'=>0));
		}
		$result = $address_id = $db->pe_insert('useraddr', pe_dbhold($info));
	}
	else {
		$useraddr_list = pe_getcookie('pe_useraddr', 'array');
		if ($info['address_default'] == 1) {
			foreach ($useraddr_list as $k=>$v) {
				$useraddr_list[$k]['address_default'] = 0; 
			}
		}
		$info['address_id'] = $address_id = md5(time().rand(1,99999));
		$address_new = array($address_id=>$info);
		$useraddr_list = count($useraddr_list) ? array_merge($address_new, $useraddr_list) : $address_new;
		pe_setcookie('pe_useraddr', $useraddr_list);
		$result = true;
	}
	if ($result) {
		pe_jsonshow(array('result'=>true, 'show'=>'添加成功！', 'id'=>$address_id));
	}
	else {
		pe_jsonshow(array('result'=>false, 'show'=>'添加失败'));
	}
}

//获取下单收货地址
function useraddr_list($address_id) {
	global $db, $_s_user_id, $_c_pe_useraddr;
	if (pe_login('user')) {
		$info_list = $db->pe_selectall('useraddr', array('user_id'=>$_s_user_id, 'order by'=>'address_default desc, address_id desc'));
	}
	else {
		$useraddr_list = pe_getcookie('pe_useraddr', 'array');
		foreach ($useraddr_list as $k=>$v) {
			if ($v['address_default']) {
				unset($useraddr_list[$k]);
				$address_new = array($k=>$v);
			} 
		}
		$info_list = is_array($address_new) ? array_merge($address_new, $useraddr_list) : $useraddr_list;
	}
	$one = key($info_list);
	foreach ($info_list as $k=>$v) {
		if ($address_id && $address_id == $v['address_id']) {
			$info_list[$k]['sel'] = 1;
		}
		elseif (!$address_id && $k == $one) {
			$info_list[$k]['sel'] = 1;			
		}
	}
	pe_jsonshow(array('result'=>true, 'list'=>$info_list));
}
//获取下单地址详情
function useraddr_info($address_id) {
	global $db, $_s_user_id, $_c_pe_useraddr;
	if (pe_login('user')) {
		$info = $db->pe_select('useraddr', array('user_id'=>$_s_user_id, 'address_id'=>intval($address_id)));
	}
	else {
		$useraddr_list = pe_getcookie('pe_useraddr', 'array');
		foreach ($useraddr_list as $k=>$v) {
			if ($v['address_id'] == $address_id) {
				$info = $v;
				break;
			}
		}
	}
	return $info;
}
?>