<?php
/**
 * @copyright   2008-2014 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
switch ($act) {
	//#####################@ 购物车商品加入 @#####################//
	case 'cartadd':
		$info['cart_atime'] = time();
		$info['product_id'] = intval($_g_product_id);
		$info['product_num'] = intval($_g_product_num);
		$info['prorule_key'] = pe_dbhold($_g_prorule_key);
		$product = $db->pe_select('product', array('product_id'=>$info['product_id']), '`product_num`, `rule_id`');
		if ($product['rule_id']) {
			$prorule = $db->pe_select('prorule', array('product_id'=>$info['product_id'], 'prorule_key'=>$info['prorule_key']), '`product_num`');
			$product['product_num'] = $prorule['product_num'];
		}
		$result = '-1';
		if ($product['product_num'] >= $info['product_num']) {
			if (pe_login('user')) {
				$info['user_id'] = $_s_user_id;	
				$cart = $db->pe_select('cart', array('product_id'=>$info['product_id'], 'prorule_key'=>$info['prorule_key'], 'user_id'=>$_s_user_id));
				if ($cart['product_num']) {
					$result = $db->pe_update('cart', array('cart_id'=>$cart['cart_id']), array('product_num'=>$cart['product_num']+$info['product_num'])) ? true : false;
				}
				else {
					$result = $db->pe_insert('cart', $info) ? true : false;		
				}
				$cart_num = user_cartnum();
			}
			else {
				$cart_list = unserialize($_c_cart_list);
				$product_index = $info['prorule_key'] ? "{$info['product_id']}---{$info['prorule_key']}" : $info['product_id'];
				if (is_array($cart_list[$product_index])) {
					$cart_list[$product_index]['product_num'] = $cart_list[$product_index]['product_num'] + $info['product_num'];
				}
				else {
					$cart_list[$product_index] = $info;
				}
				$result = is_array($cart_list[$product_index]) ? true : false;
				setcookie('cart_list', serialize($cart_list), 0, '/');
				$cart_num = user_cartnum($cart_list);
			}
		}
		echo json_encode(array('result'=>$result, 'cart_num'=>$cart_num));
	break;
	//#####################@ 购物车商品更改数量(为零就删除吧) @#####################//
	case 'cartnum':
		$product_id = pe_dbhold($_g_product_id);
		$product_num = intval($_g_product_num);
		if (pe_login('user')) {
			$product_id = explode('---', $product_id);
			$sql_where['user_id'] = $_s_user_id;
			$sql_where['product_id'] = intval($product_id[0]);
			if ($product_id[1]) $sql_where['prorule_key'] = $product_id[1];
			$result = $product_num ? $db->pe_update('cart', pe_dbhold($sql_where), array('product_num'=>$product_num)) : $db->pe_delete('cart', pe_dbhold($sql_where));
			$cart_num = user_cartnum();
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
			$cart_num = user_cartnum($cart_list);
		}
		$cart_list = cart_list($cart_list);
		//读取优惠券
		$quan_list = user_quanlist();
		$quan_html = "<option value='0' quan_money='0.0'>不使用优惠券</option>";
		foreach ($quan_list as $v) {
			$quan_html .= "<option value='{$v['quanlog_id']}' quan_money='{$v['quan_money']}'>【{$v['quan_money']}元】{$v['quan_name']}</option>";	
		}
		echo json_encode(array('result'=>$result, 'cart_num'=>$cart_num, 'money'=>$cart_list['money'], 'quan_html'=>$quan_html));
	break;
	//#####################@ 订单增加 @#####################//
	case 'add':
		pe_lead('hook/order.hook.php');
		$cache_payway = cache::get('payway');
		$cart_list = cart_list(unserialize($_c_cart_list));
		$info_list = $cart_list['list'];
		$money = $cart_list['money'];
		//调用用户个人信息里的收货地址
		$info = $db->pe_select('user', array('user_id'=>$_s_user_id));
		$info['user_point'] = $info['user_point'] ? $info['user_point'] : 0;
		$user_point_money = $cache_setting['point_money'] ? round($info['user_point']/$cache_setting['point_money'], 1) : 0;
		user_quancheck();
		$quan_list = user_quanlist();
		if (isset($_p_pesubmit)) {
			$order_quan_id = intval($_p_order_quan_id);
			$order_point_use = intval($_p_order_point_use);
			if (!$cache_setting['web_guestbuy'] && !pe_login('user')) pe_error('请先登录...', "{$pe['host_root']}user.php?mod=do&act=login");
 			!count($info_list) && pe_error('购物车商品为空...');
			!$_p_order_payway && pe_error('请选择付款方式...');
			if ($order_quan_id && !$quan_list[$order_quan_id]['quan_id']) pe_error('优惠券无效...');
			if ($order_point_use > $info['user_point']) pe_error('账户积分不足...');
			//$order = $db->pe_select('order', array('order by'=>'order_id desc'));
			//substr($order['order_id'], 0 , 6) != date('ymd') && $sql_order['order_id'] = $order_id = date('ymd').'0001';
			$sql_order['order_id'] = $order_id = order_setid();			
			$sql_order['order_product_money'] = $money['order_product_money'];
			$sql_order['order_wl_money'] = $money['order_wl_money'];
			$sql_order['order_money'] = $money['order_money'];
			$sql_order['order_point_get'] = $money['order_point_get'];
			$sql_order['order_atime'] = time();
			$sql_order['order_payway'] = $_p_order_payway;
			$sql_order['order_text'] = $_p_order_text;
			$sql_order['user_id'] = $_s_user_id;
			$sql_order['user_name'] = $_s_user_name;
			$sql_order['user_address'] = "{$_p_province}{$_p_city}{$_p_user_address}";
			$sql_order['user_tname'] = $_p_user_tname;
			$sql_order['user_phone'] = $_p_user_phone;
			if ($order_quan_id) {
				$sql_order['order_quan_id'] = $order_quan_id;
				$sql_order['order_quan_name'] = $quan_list[$order_quan_id]['quan_name'];
				$sql_order['order_quan_money'] = $quan_list[$order_quan_id]['quan_money'];
			}
			if ($order_point_use) {
				$sql_order['order_point_use'] = $order_point_use;
				$sql_order['order_point_money'] = $cache_setting['point_money'] ? round($order_point_use/$cache_setting['point_money'], 1) : 0;
			}
			$sql_order['order_money'] = $sql_order['order_money'] - $sql_order['order_quan_money'] - $sql_order['order_point_money'];
			if ($sql_order['order_money'] < 0) $sql_order['order_money'] = 0;
			if ($db->pe_insert('order', pe_dbhold($sql_order))) {
				foreach ($info_list as $v) {
					$sql_orderdata['product_id'] = $v['product_id'];
					$sql_orderdata['product_name'] = $v['product_name'];
					$sql_orderdata['product_logo'] = $v['product_logo'];
					$sql_orderdata['product_money'] = $v['product_money'];
					$sql_orderdata['product_num'] = $v['product_num'];
					$sql_orderdata['prorule_key'] = $v['prorule_key'];
					$sql_orderdata['prorule_name'] = $v['prorule_name'];
					$sql_orderdata['order_id'] = $order_id;
					$db->pe_insert('orderdata', pe_dbhold($sql_orderdata, array('prorule_name')));
				}
				order_callback('add', $order_id);
				pe_success('订单提交成功！', "{$pe['host_root']}index.php?mod=order&act=pay&id={$order_id}");
			}
			else {
				pe_error('订单提交失败...');
			}	
		}
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
	//#####################@ 快递查询跳转 @#####################//
	case 'kuaidi':
		$json = json_decode(file_get_contents("http://www.kuaidi100.com/autonumber/autoComNum?text={$_g_id}"), true);
		$wl_code = $json['auto'][0]['comCode'];
		pe_goto("http://www.kuaidi100.com/chaxun?com={$wl_code}&nu={$_g_id}");
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
function cart_list($_c_cart_list = array()) {
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
		$v['prorule_key'] = pe_dbhold($v['prorule_key']);
		if ($v['prorule_key']) {
			$sql = "select a.`product_id`,a.`product_name`, a.`product_logo`, a.`product_money`, a.`product_smoney`, b.`product_money` as `prorule_money`, a.`product_wlmoney`, a.`product_point`, b.`product_num` as `product_maxnum`, a.`rule_id` from `".dbpre."product` a, `".dbpre."prorule` b where a.`product_id` = b.`product_id` and b.`product_id` = '{$v['product_id']}' and b.`prorule_key` = '{$v['prorule_key']}'";
			$product = $db->sql_select($sql);
			//检测活动价格
			$product['product_money'] = $product['product_money'] == $product['product_smoney'] ? $product['prorule_money'] : $product['product_money'];
			//如果管理后台已经把购物者中这个商品的规格或者变更了
			if (!$product['product_id']) continue;
		}
		else {
			$product = $db->pe_select('product', array('product_id'=>$v['product_id']), "`product_id`, `product_name`, `product_logo`, `product_money`, `product_wlmoney`, `product_point`, `product_num` as `product_maxnum`, `rule_id`");
			//如果管理后台已经把购物者中这个商品的规格或者变更了
			if (!$product['product_id'] or $product['rule_id']) continue;
		}
		$product_index = $v['prorule_key'] ? "{$v['product_id']}---{$v['prorule_key']}" : $v['product_id'];
		$info_list[$product_index] = $product;
		$info_list[$product_index]['product_num'] = intval($v['product_num']);
		$info_list[$product_index]['prorule_key'] = $v['prorule_key'];
		if ($product['rule_id']) {
			$prorule_name = '';
			$prorule_keyarr = explode(',', $v['prorule_key']);
			foreach (explode(',', $product['rule_id']) as $kk=>$vv) {
				$prorule_name[] = array('name'=>$cache_rule[$vv]['rule_name'], 'value'=>$cache_rule[$vv]['list'][$prorule_keyarr[$kk]]['ruledata_name']);
			}
			$info_list[$product_index]['prorule_name'] = serialize($prorule_name);
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
?>