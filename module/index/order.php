<?php
/**
 * @copyright   2008-2014 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
pe_lead('hook/order.hook.php');
$cache_payway = cache::get('payway');
$payway_list = payway_list('order');
$user_id = pe_login('user') ? $_s_user_id : pe_user_id();
switch ($act) {
	//#####################@ 购物车商品加入 @#####################//
	case 'cart_add':
		if (!user_checkguest()) pe_jsonshow(array('result'=>false, 'show'=>'请先登录'));
		$product_id = intval($_g_id);
		$product_num = intval($_g_num);
		$prorule_key = pe_dbhold($_g_rule);
		$product_guid = md5("{$product_id},{$prorule_key}");
		//检测库存
		$product = $db->pe_select('product', array('product_id'=>$product_id), '`product_num`, `product_rule`');
		if ($product['product_rule']) {
			$prorule = $db->pe_select('prorule', array('product_id'=>$product_id, 'prorule_key'=>$prorule_key), '`product_num`');
			$product['product_num'] = $prorule['product_num'];
		}
		if ($product['product_num'] < $product_num) pe_jsonshow(array('result'=>false, 'show'=>'库存不足'));
		$cart = $db->pe_select('cart', array('user_id'=>$user_id, 'product_guid'=>$product_guid));
		if ($cart['cart_id']) {
			$sql_set['product_num'] = $cart['product_num'] + $product_num;			
			$result = $db->pe_update('cart', array('cart_id'=>$cart['cart_id']), $sql_set) ? true : false;
		}
		else {
			$sql_set['product_id'] = $product_id;
			$sql_set['product_guid'] = $product_guid;
			$sql_set['product_num'] = $product_num;
			$sql_set['prorule_key'] = $prorule_key;
			$sql_set['user_id'] = $user_id;
			$sql_set['cart_atime'] = time();
			$result = $db->pe_insert('cart', $sql_set) ? true : false;		
		}
		if (!$result) pe_jsonshow(array('result'=>false, 'show'=>'异常请重新操作'));
		pe_jsonshow(array('result'=>true, 'cart_num'=>user_cartnum()));
	break;
	//#####################@ 购物车商品更改数量(为零就删除吧) @#####################//
	case 'cart_edit':
		if (!user_checkguest()) pe_jsonshow(array('result'=>false, 'show'=>'请先登录'));
		$product_guid = pe_dbhold($_g_guid);
		$product_num = intval($_g_num);
		$sql_where['user_id'] = $user_id;
		$sql_where['product_guid'] = $product_guid;
		if ($product_num) {
			$result = $db->pe_update('cart', $sql_where, array('product_num'=>$product_num)) ? true : false;
		}
		else {
			$result = $db->pe_delete('cart', $sql_where) ? true : false;			
		}
		$cart_list = cart_list();
		//读取优惠券
		$quan_list = user_quanlist();
		$quan_html = "<option value='0' quan_money='0.0'>不使用优惠券</option>";
		foreach ($quan_list as $v) {
			$quan_html .= "<option value='{$v['quanlog_id']}' quan_money='{$v['quan_money']}'>省{$v['quan_money']}元：{$v['quan_name']}</option>";	
		}
		echo json_encode(array('result'=>$result, 'cart_num'=>user_cartnum(), 'money'=>$cart_list['money'], 'quan_html'=>$quan_html));
	break;
	//#####################@ 订单增加 @#####################//
	case 'add':
		$cart_list = cart_list();
		$info_list = $cart_list['list'];
		$money = $cart_list['money'];
		$user = $db->pe_select('user', array('user_id'=>$_s_user_id));
		$user['user_point'] = $user['user_point'] ? $user['user_point'] : 0;
		$user['user_money'] = pe_num($user['user_money'], 'round', 1, true);
		$user_point_money = $cache_setting['point_money'] ? round($user['user_point']/$cache_setting['point_money'], 1) : 0;
		user_quancheck();
		$quan_list = user_quanlist();
		if (isset($_p_pesubmit)) {
			$order_quan_id = intval($_p_order_quan_id);
			$order_point_use = intval($_p_order_point_use);
			if (!user_checkguest()) pe_error('请先登录...', "{$pe['host_root']}user.php?mod=do&act=login");
 			if (!count($info_list)) pe_error('购物车商品为空...');
			if (!$_p_order_payway) pe_error('请选择付款方式...');
			if ($order_quan_id && !$quan_list[$order_quan_id]['quan_id']) pe_error('优惠券无效...');
			if ($order_point_use > $user['user_point']) pe_error('积分余额不足...');
			$address = useraddr_info($_p_address_id);
			if (!$address['address_id']) pe_error('请选择收货地址...');
			$sql_order['order_id'] = $order_id = order_setid();			
			$sql_order['order_product_money'] = $money['order_product_money'];
			$sql_order['order_wl_money'] = $money['order_wl_money'];
			$sql_order['order_money'] = $money['order_money'];
			$sql_order['order_point_get'] = $money['order_point_get'];
			$sql_order['order_atime'] = time();
			$sql_order['order_payway'] = $_p_order_payway;
			$sql_order['order_state'] = $_p_order_payway == 'cod' ? 'wsend' : 'wpay';
			$sql_order['order_text'] = $_p_order_text;
			$sql_order['user_id'] = $_s_user_id;
			$sql_order['user_name'] = $_s_user_name;
			$sql_order['user_address'] = "{$address['address_province']}{$address['address_city']}{$address['address_area']}{$address['address_text']}";
			$sql_order['user_tname'] = $address['user_tname'];
			$sql_order['user_phone'] = $address['user_phone'];
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
					$sql_orderdata['product_guid'] = $v['product_guid'];
					$sql_orderdata['product_name'] = $v['product_name'];
					$sql_orderdata['product_logo'] = $v['product_logo'];
					$sql_orderdata['product_money'] = $v['product_money'];
					$sql_orderdata['product_num'] = $v['product_num'];
					$sql_orderdata['prorule_key'] = $v['prorule_key'];
					$sql_orderdata['prorule_name'] = $v['prorule_name'];
					$sql_orderdata['order_id'] = $order_id;
					$db->pe_insert('orderdata', pe_dbhold($sql_orderdata, array('prorule_name')));
					$order_name[] = $v['product_name'];
				}
				$db->pe_update('order', array('order_id'=>$order_id), array('order_name'=>implode(';', $order_name)));
				order_calback_add($order_id);
				pe_success('订单提交成功！', "{$pe['host_root']}index.php?mod=order&act=pay&id={$order_id}");
			}
			else {
				pe_error('订单提交失败...');
			}	
		}
		$seo = pe_seo($menutitle='我的购物车');
		include(pe_tpl('order_add.html'));
	break;
	//#####################@ 订单支付 @#####################//
	case 'pay':
		$order_id = pe_dbhold($_g_id);
		$user = $db->pe_select('user', array('user_id'=>$_s_user_id), 'user_money');
		$user['user_money'] = pe_num($user['user_money'], 'round', 1, true);
		$info = $db->pe_select('order', array('order_id'=>$order_id, 'order_state'=>array('wpay', 'wsend')));
		!$info['order_id'] && pe_error('订单号错误...');
		if (isset($_p_pesubmit)) {
			if ($info['order_pstate']) pe_error('请勿重复支付...');
			$order_payway = $_p_order_payway ? pe_dbhold($_p_order_payway) : $info['order_payway'];
			if ($order_payway == 'cod') pe_error('支付方式错误...');
			if (!array_key_exists($order_payway, $cache_payway)) pe_error('支付方式错误...');
			//使用余额支付/或订单金额为0直接付款
			if ($order_payway == 'balance' or $info['order_money'] == 0) {
				if ($user['user_money'] < $info['order_money']) pe_error('账户余额不足...');
				order_callback_pay($order_id, '', $order_payway);
				pe_success('支付成功！', "{$pe['host_root']}user.php?mod=order&act=view&id={$order_id}");
			}
			echo '正在为您连接支付网站，请稍后...';
			pe_goto("{$pe['host_root']}include/plugin/payway/{$order_payway}/order_pay.php?id={$order_id}");
		}
		$seo = pe_seo($menutitle="支付订单");
		include(pe_tpl('order_pay.html'));
	break;
	//#####################@ 快递查询跳转 @#####################//
	case 'kuaidi':
		$json = json_decode(file_get_contents("http://www.kuaidi100.com/autonumber/autoComNum?text={$_g_id}"), true);
		$wl_code = $json['auto'][0]['comCode'];
		pe_goto("http://www.kuaidi100.com/chaxun?com={$wl_code}&nu={$_g_id}");
	break;
}
?>