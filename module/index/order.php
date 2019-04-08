<?php
/**
 * @copyright   2008-2014 简好技术 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
switch ($act) {
	//#####################@ 购物车商品加入 @#####################//
	case 'cartadd':
		$info['cart_atime'] = time();
		$info['product_id'] = intval($_g_product_id);
		$info['product_num'] = intval($_g_product_num);
		$info['prorule_id'] = pe_dbhold($_g_prorule_id);
		$product = $db->pe_select('product', array('product_id'=>$info['product_id']), '`product_num`, `rule_id`');
		if ($product['rule_id']) {
			$prorule = $db->pe_select('prorule', array('product_id'=>$info['product_id'], 'prorule_id'=>$info['prorule_id']), '`product_num`');
			$product['product_num'] = $prorule['product_num'];
		}
		$result = '-1';
		if ($product['product_num'] >= $info['product_num']) {
			if (pe_login('user')) {
				$info['user_id'] = $_s_user_id;	
				$cart = $db->pe_select('cart', array('product_id'=>$info['product_id'], 'prorule_id'=>$info['prorule_id'], 'user_id'=>$_s_user_id));
				if ($cart['product_num']) {
					$result = $db->pe_update('cart', array('cart_id'=>$cart['cart_id']), array('product_num'=>$cart['product_num']+$info['product_num'])) ? true : false;
				}
				else {
					$result = $db->pe_insert('cart', $info) ? true : false;		
				}
			}
			else {
				$cart_list = unserialize($_c_cart_list);
				$product_index = $info['prorule_id'] ? "{$info['product_id']}---{$info['prorule_id']}" : $info['product_id'];
				if (is_array($cart_list[$product_index])) {
					$cart_list[$product_index]['product_num'] = $cart_list[$product_index]['product_num'] + $info['product_num'];
				}
				else {
					$cart_list[$product_index] = $info;
				}
				$result = is_array($cart_list[$product_index]) ? true : false;
				setcookie('cart_list', serialize($cart_list), 0, '/');
			}
		}
		echo json_encode(array('result'=>$result));
	break;
	//#####################@ 购物车商品更改数量(为零就删除吧) @#####################//
	case 'cartnum':
		$product_id = pe_dbhold($_g_product_id);
		$product_num = intval($_g_product_num);
		if (pe_login('user')) {
			$product_id = explode('---', $product_id);
			$sql_where['user_id'] = $_s_user_id;
			$sql_where['product_id'] = intval($product_id[0]);
			if ($product_id[1]) $sql_where['prorule_id'] = $product_id[1];
			$result = $product_num ? $db->pe_update('cart', pe_dbhold($sql_where), array('product_num'=>$product_num)) : $db->pe_delete('cart', pe_dbhold($sql_where));
		}
		else {
			$cart_list = unserialize($_c_cart_list);
			if ($product_num) {
				$cart_list[$_g_product_id]['product_num'] = $product_num;
				$result = is_array($cart_list[$_g_product_id]) ? true : false;
			}
			else {
				unset($cart_list[$product_id]);
				$result = is_array($cart_list[$_g_product_id]) ? false : true;
			}
			setcookie('cart_list', serialize($cart_list), 0, '/');
		}
		$cart_list = cart_list($cart_list);
		echo json_encode(array('result'=>$result, 'money'=>$cart_list['money']));
	break;
	//#####################@ 订单增加 @#####################//
	case 'add':
		$cache_payway = cache::get('payway');
		$cart_list = cart_list(unserialize($_c_cart_list));
		$info_list = $cart_list['list'];
		$money = $cart_list['money'];
		if (isset($_p_pesubmit)) {
 			!count($info_list) && pe_error('购物车商品为空...');
			!$_p_order_payway && pe_error('请选择付款方式...');
			$order = $db->pe_select('order', array('order by'=>'order_id desc'));
			substr($order['order_id'], 0 , 6) != date('ymd') && $sql_order['order_id'] = $order_id = date('ymd').'0001';
			$sql_order['order_productmoney'] = $money['order_productmoney'];
			$sql_order['order_wlmoney'] = $money['order_wlmoney'];
			$sql_order['order_money'] = $money['order_money'];
			$sql_order['order_atime'] = time();
			$sql_order['order_payway'] = $_p_order_payway;
			$sql_order['order_text'] = $_p_order_text;
			$sql_order['user_id'] = $_s_user_id;
			$sql_order['user_name'] = $_s_user_name;
			$sql_order['user_address'] = "{$_p_province}{$_p_city}{$_p_user_address}";
			$sql_order['user_tname'] = $_p_user_tname;
			$sql_order['user_phone'] = $_p_user_phone;
			if ($order_id = $db->pe_insert('order', pe_dbhold($sql_order))) {
				foreach ($info_list as $v) {
					$sql_orderdata['product_id'] = $v['product_id'];
					$sql_orderdata['product_name'] = $v['product_name'];
					$sql_orderdata['product_logo'] = $v['product_logo'];
					$sql_orderdata['product_money'] = $v['product_money'];
					$sql_orderdata['product_num'] = $v['product_num'];
					$sql_orderdata['prorule_id'] = $v['prorule_id'];
					$sql_orderdata['prorule_name'] = $v['prorule_name'];
					$sql_orderdata['order_id'] = $order_id;
					$db->pe_insert('orderdata', pe_dbhold($sql_orderdata, array('prorule_name')));
				}
				pe_lead('hook/product.hook.php');
				product_num('delnum', $order_id);
				//清空购物车
				if (pe_login('user')) {
					$db->pe_delete('cart', array('user_id'=>$_s_user_id));
				}
				else {
					setcookie('cart_list', '', 0, '/');
				}
				pe_success('订单提交成功！', "{$pe['host_root']}index.php?mod=order&act=pay&id={$order_id}");
			}
			else {
				pe_error('订单提交失败...');
			}	
		}
		//调用用户个人信息里的收货地址
		$info = $db->pe_select('user', array('user_id'=>$_s_user_id));
		$seo = pe_seo('填写收货信息');
		include(pe_tpl('order_add.html'));
	break;
	//#####################@ 选择支付方式 @#####################//
	case 'pay':
		$order_id = pe_dbhold($_g_id);
		$cache_payway = cache::get('payway');
		foreach($cache_payway as $k => $v) {
			$cache_payway[$k]['payway_config'] = unserialize($cache_payway[$k]['payway_config']);
		}
		$order = $db->pe_select('order', array('order_id'=>$order_id, 'order_state'=>'notpay'));
		!$order['order_id'] && pe_error('订单号错误...');
		if (isset($_p_pesubmit)) {
			$info_list = $db->pe_selectall('orderdata', array('order_id'=>$order_id));
			//订单金额为零直接支付成功
			if ($order['order_money'] == 0.0) {
				if ($db->pe_update('order', array('order_id'=>$order_id), array('order_state'=>'success', 'order_payway'=>'alipay_js', 'order_ptime'=>time(), 'order_stime'=>time()))) {
					pe_lead('hook/product.hook.php');
					product_num('sellnum', $order_id);
					pe_success('订单支付成功！', pe_url("product-{$info_list[0]['product_id']}"));
				}
				else {
					pe_error('订单支付失败...', "index.php?mod=order&act=pay&id={$order_id}");
				}
			}
			foreach ($info_list as $v) {
				$order['order_name'] .= "{$v['product_name']};";			
			}
			echo '正在为您连接支付网站，请稍后...';
			include("{$pe['path_root']}include/plugin/payway/{$order['order_payway']}/order_pay.php");
			die();
		}
		$seo = pe_seo('选择支付方式');
		include(pe_tpl('order_pay.html'));
	break;
	//#####################@ 订单查询 @#####################//
	case 'list':
		$info = $db->pe_select('order', array('order_id'=>intval($_g_order_id), 'user_phone'=>pe_dbhold($_g_user_phone)));
		$product_list = $db->pe_selectall('orderdata', array('order_id'=>intval($_g_order_id)));

		$seo = pe_seo('订单查询');
		include(pe_tpl('order_list.html'));
	break;
}
//购物车商品列表和价格
function cart_list($_c_cart_list=array()) {
	global $db;
	$cache_rule = cache::get('rule');
	if (pe_login('user')) {
		$cart_list = $db->pe_selectall('cart', array('user_id'=>$_SESSION['user_id']));
	}
	else {
		$cart_list = is_array($_c_cart_list) ? $_c_cart_list : array();
	}
	foreach ($cart_list as $k=>$v) {
		$v['product_id'] = intval($v['product_id']);
		$v['prorule_id'] = pe_dbhold($v['prorule_id']);
		if ($v['prorule_id']) {
			$sql = "select a.`product_id`,a.`product_name`, a.`product_logo`, b.`product_money`, a.`product_wlmoney`, b.`product_num` as `product_maxnum`, a.`rule_id` from `".dbpre."product` a, `".dbpre."prorule` b where a.`product_id` = b.`product_id` and b.`product_id` = '{$v['product_id']}' and b.`prorule_id` = '{$v['prorule_id']}'";
			$product = $db->sql_select($sql);
			//如果管理后台已经把购物者中这个商品的规格或者变更了
			if (!$product['product_id']) continue;
		}
		else {
			$product = $db->pe_select('product', array('product_id'=>$v['product_id']), "`product_id`, `product_name`, `product_logo`, `product_money`, `product_wlmoney`, `product_num` as `product_maxnum`, `rule_id`");
			//如果管理后台已经把购物者中这个商品的规格或者变更了
			if (!$product['product_id'] or $product['rule_id']) continue;
		}
		$product_index = $v['prorule_id'] ? "{$v['product_id']}---{$v['prorule_id']}" : $v['product_id'];
		$info_list[$product_index] = $product;
		$info_list[$product_index]['product_num'] = intval($v['product_num']);
		$info_list[$product_index]['prorule_id'] = $v['prorule_id'];
		if ($product['rule_id']) {
			$prorule_name = '';
			$prorule_idarr = explode(',', $v['prorule_id']);
			foreach (explode(',', $product['rule_id']) as $kk=>$vv) {
				$prorule_name[] = array('name'=>$cache_rule[$vv]['rule_name'], 'value'=>$cache_rule[$vv]['list'][$prorule_idarr[$kk]]['ruledata_name']);
			}
			$info_list[$product_index]['prorule_name'] = serialize($prorule_name);
		}
		$money['order_productmoney'] += $v['product_num'] * $product['product_money'];
		$money['order_wlmoney'] += $product['product_wlmoney'];
	}

	$money['order_money'] = number_format($money['order_wlmoney'] + $money['order_productmoney'], 1, '.', '');
	$money['order_productmoney'] = number_format($money['order_productmoney'], 1, '.', '');
	$money['order_wlmoney'] = number_format($money['order_wlmoney'], 1, '.', '');
	return array('list'=>(array)$info_list, 'money'=>$money);
}
?>