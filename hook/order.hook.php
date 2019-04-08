<?php
function order_state($info)
{
	global $db;
	if ($info['order_state'] == 'notpay') {
		$result = $info['order_payway'] == 'cod' ? 'paid' : 'notpay';
	}
	else {
		$result = $info['order_state'];	
	}
	return $result;
}
//订单后续更新操作
function order_callback($type, $order_id) {
	global $db, $cache_setting;
	$order_id = pe_dbhold($order_id);
	$info = $db->pe_select('order', array('order_id'=>$order_id));
	if (!$info['order_id']) return false;
	switch ($type) {
		case 'add':
			pe_lead('hook/product.hook.php');
			pe_lead('hook/user.hook.php');
			pe_lead('hook/qunfa.hook.php');
			product_num('delnum', $order_id);
			notice_add('order_add', $order_id);
			user_quanupdate($info['order_quan_id'], 1);
			add_pointlog($info['user_id'], 'order_use', $info['order_point_use'], "订单【{$order_id}】交易使用");
			//清空购物车
			if (pe_login('user')) {
				$db->pe_delete('cart', array('user_id'=>$_SESSION['user_id']));
			}
			else {
				setcookie('cart_list', '', 0, '/');
			}
		break;
		case 'pay':
			pe_lead('hook/product.hook.php');
			pe_lead('hook/qunfa.hook.php');
			product_num('sellnum', $order_id);
			notice_add('order_pay', $order_id);
		break;
		case 'send':
			pe_lead('hook/qunfa.hook.php');
			notice_add('order_send', $order_id);
		break;
		case 'success':
			if ($info['order_payway'] == 'cod') {
				pe_lead('hook/product.hook.php');
				product_num('sellnum', $order_id);
			}
			pe_lead('hook/user.hook.php');
			add_pointlog($info['user_id'], 'order_get', $info['order_point_get'], "订单【{$order_id}】交易获得");
		break;
		case 'close':
			pe_lead('hook/product.hook.php');
			pe_lead('hook/user.hook.php');
			pe_lead('hook/qunfa.hook.php');
			product_num('addnum', $order_id);
			user_quanupdate($info['order_quan_id'], 0);
			add_pointlog($info['user_id'], 'order_back', $info['order_point_use'], "订单【{$order_id}】交易取消");
			notice_add('order_close', $order_id);
		break;
		case 'del':
			$db->pe_delete('orderdata', array('order_id'=>$order_id));
		break;
		case 'comment':
			pe_lead('hook/product.hook.php');
			pe_lead('hook/user.hook.php');
			$db->pe_update('order', array('order_id'=>$order_id), array('order_comment'=>1));
			$info_list = $db->pe_selectall('orderdata', array('order_id'=>$order_id));
			foreach ($info_list as $k=>$v) {
				product_num('commentnum', $v['product_id']);
			}
			add_pointlog($info['user_id'], 'comment', $cache_setting['point_comment'], "订单【{$order_id}】评价获得");
		break;
	}
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

function order_setid() {
	global $db;
	$order_id = date('ymdHis').mt_rand(0,9).mt_rand(0,9).mt_rand(0,9);
	if ($db->pe_num('order', array('order_id'=>$order_id))) {
		return order_setid();
	}
	else {
		return $order_id;
	}
}
?>