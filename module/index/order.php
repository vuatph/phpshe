<?php
switch ($act) {
	//#####################@ 购物车加入sql @#####################//
	case 'cartaddsql':
		$info['cart_atime'] = time();
		$info['product_id'] = intval($_g_product_id);
		$info['product_num'] = intval($_g_product_num);
		$product = $db->pe_select('product', array('product_id'=>$info['product_id']), '`product_num`');
		if ($product['product_num']) {
			if ($_s_user_id_key) {
				$info['user_id'] = $_s_user_id;	
				$cart = $db->pe_select('cart', array('product_id'=>$info['product_id'], 'user_id'=>$_s_user_id));
				if ($cart['product_num']) {
					$result = $db->pe_update('cart', array('cart_id'=>$cart['cart_id']), array('product_num'=>$cart['product_num']+$info['product_num'])) ? true : false;
				}
				else {
					$result = $db->pe_insert('cart', $info) ? true : false;		
				}
			}
			else {
				$cart_list = unserialize($_c_cart_list);
				if (is_array($cart_list[$info['product_id']])) {
					$cart_list[$info['product_id']]['product_num'] = $cart_list[$info['product_id']]['product_num'] + $info['product_num'];
				}
				else {
					$cart_list[$info['product_id']] = $info;
				}
				$result = is_array($cart_list[$info['product_id']]) ? true : false;
				setcookie('cart_list', serialize($cart_list));
			}
		}
		echo json_encode(array('result'=>$result));
	break;
	//#####################@ 购物车列表 @#####################//
	case 'cartlist':
		$info_list = array();
		if ($_s_user_id_key) {
			$sql = "select a.*, b.`product_name`, b.`product_logo`, b.`product_smoney`, b.`product_num` as `product_maxnum` from `".dbpre."cart` a, `".dbpre."product` b where a.`product_id` = b.`product_id` and a.`user_id` = '".intval($_s_user_id)."'";
			$info_list = $db->sql_selectall($sql);
		}
		else {
			if (is_array($cart_list = unserialize($_c_cart_list))) {
				foreach ($cart_list as $k => $v) {
					$product_rows = $db->pe_select('product', array('product_id'=>$k), '`product_name`, `product_logo`, `product_smoney`, `product_num` as `product_maxnum`');
					$info_list[] = array_merge($v, $product_rows);
				}
			}
		}

		$cart_money = 0;
		foreach ($info_list as $v) {
			$cart_money += $v['product_num'] * $v['product_smoney'];
		}
		$seo = pe_seo('我的购物车');
		include(pe_tpl('order_cartlist.html'));
	break;
	//#####################@ 购物车更改商品数量 @#####################//
	case 'cartnumsql':
		if ($result = $db->pe_update('cart', array('user_id'=>$_s_user_id, 'product_id'=>$_g_product_id), array('product_num'=>$_g_product_num))) {
			$sql = "select a.`product_num`, b.`product_smoney` from `".dbpre."cart` a, `".dbpre."product` b where a.`product_id` = b.`product_id` and a.`user_id` = '{$_s_user_id}'";
			$rows = $db->sql_selectall($sql);
			foreach ($rows as $v) {
				$cart_money += $v['product_num'] * $v['product_smoney'];
			}
		}
		echo json_encode(array('result'=>$result, 'cart_money'=>$cart_money));
	break;
	//#####################@ 购物车删除sql @#####################//
	case 'cartdelsql':
		$_g_cart_id != 'all' && $sqlwhere['cart_id'] = $_g_cart_id;
		$sqlwhere['user_id'] = $_s_user_id;
		if ($result = $db->pe_delete('cart', $sqlwhere)) {
			$sql = "select a.`product_num`, b.`product_smoney` from `".dbpre."cart` a, `".dbpre."product` b where a.`product_id` = b.`product_id` and a.`user_id` = '{$_s_user_id}'";
			$rows = $db->sql_selectall($sql);
			foreach ($rows as $v) {
				$cart_money += $v['product_num'] * $v['product_smoney'];
			}
		}
		echo json_encode(array('result'=>$result, 'cart_money'=>$cart_money));
	break;
	//#####################@ 订单增加 @#####################//
	case 'add':
		!$_s_user_id_key && pe_goto(pe_url('user-login', 'from='.urlencode("{$pe['host_root']}index.php?mod=order&act=cartlist")));
		$sql = "select a.*, b.`product_name`,b.`product_smoney`,b.`product_wlmoney` from `".dbpre."cart` a, `".dbpre."product` b where a.`product_id` = b.`product_id` and a.`user_id` = '".intval($_s_user_id)."'";
		$info_list = $db->sql_selectall($sql);
		foreach ($info_list as $v) {
			$order_wlmoney += $v['product_wlmoney'];
			$order_money += $v['product_num'] * $v['product_smoney'];
		}
		//调用用户个人信息里的收货地址
		$info = $db->pe_select('user', array('user_id'=>$_s_user_id));

		$seo = pe_seo('填写收货信息');
		$action = "index.php?mod=order&act=addsql";
		include(pe_tpl('order_add.html'));
	break;
	//#####################@ 订单增加sql @#####################//
	case 'addsql':
		$sql = "select a.`product_num`,b.`product_id`,b.`product_name`,b.`product_smoney`,b.`product_wlmoney` from `".dbpre."cart` a, `".dbpre."product` b where a.`product_id` = b.`product_id` and a.`user_id` = '{$_s_user_id}'";
		$cart_list = $db->sql_selectall($sql);
		foreach ($cart_list as $v) {
			$_p_info['order_money'] += $v['product_num'] * $v['product_smoney'] + $v['product_wlmoney'];
			$_p_info['order_productmoney'] += $v['product_num'] * $v['product_smoney'];
			$_p_info['order_wlmoney'] += $v['product_wlmoney'];			
		}
		$_p_info['user_address'] = $_p_province.$_p_city.$_p_info['user_address'];
		$_p_info['user_id'] = $_s_user_id;
		$_p_info['user_name'] = $_s_user_name;
		$_p_info['order_atime'] = time();
		if ($order_id = $db->pe_insert('order', $_p_info)) {
			//清空购物车
			$db->pe_delete('cart', array('user_id'=>$_s_user_id));
			foreach ($cart_list as $v) {
				$orderdata['product_id'] = $v['product_id'];
				$orderdata['product_name'] = $v['product_name'];
				$orderdata['product_smoney'] = $v['product_smoney'];
				$orderdata['product_num'] = $v['product_num'];
				$orderdata['order_id'] = $order_id;
				$db->pe_insert('orderdata', $orderdata);
				//更新商品库存数量
				$db->pe_update('product', array('product_id'=>$v['product_id']), "`product_num`=`product_num`-{$v['product_num']}");
			}
			pe_goto("{$pe['host_root']}index.php?mod=order&act=pay&id={$order_id}");
		}
		else {
			pe_error('...');
		}
	break;
	//#####################@ 连接支付网站 @#####################//
	case 'pay':
		$order = $db->pe_select('order', array('user_id'=>$_s_user_id, 'order_id'=>$_g_id, 'order_state'=>'notpay'));
		if ($order['order_id']) {
			$info_list = $db->pe_selectall('orderdata', array('order_id'=>$order['order_id']));
			foreach ($info_list as $v) {
				$order['order_name'] .= $v['product_name'] . ';';			
			}
			echo '正在为您连接支付网站，请稍后...';
			include("{$pe['path_root']}include/plugin/pay/alipay/order_pay.php");
		}
		else {
			pe_error('订单号错误...');
		}
	break;
}
pe_result();
?>