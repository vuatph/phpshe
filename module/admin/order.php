<?php
/**
 * @copyright   2008-2015 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
$menumark = 'order';
pe_lead('hook/order.hook.php');
$wlname_list = is_array(unserialize($cache_setting['web_wlname'])) ? unserialize($cache_setting['web_wlname']) : array();
$cache_payway = cache::get('payway');
switch ($act) {
	//#####################@ 订单修改 @#####################//
	case 'edit':
		$order_id = pe_dbhold($_g_id);	
		$info = $db->pe_select('order', array('order_id'=>$order_id));
		$product_list = $db->pe_selectall('orderdata', array('order_id'=>$order_id));

		$seo = pe_seo($menutitle='订单详情', '', '', 'admin');
		include(pe_tpl('order_add.html'));
	break;
	//#####################@ 订单删除 @#####################//
	case 'del':
		pe_token_match();
		$order_id = pe_dbhold($_g_id);
		$info = $db->pe_select('order', array('order_id'=>$order_id));
		if ($info['order_state'] != 'close') pe_error('未关闭订单不能删除...');
		if ($db->pe_delete('order', array('order_id'=>$order_id))) {
			$db->pe_delete('orderdata', array('order_id'=>$order_id));
			pe_success('删除成功!');
		}
		else {
			pe_error('删除失败...');
		}
	break;
	//#####################@ 订单付款 @#####################//
	case 'pay':
		$order_id = pe_dbhold($_g_id);
		$info = $db->pe_select('order', array('order_id'=>$order_id));
		if ($info['order_state'] != 'wpay') pe_error('请勿重复付款...', '', 'dialog');
		$payway_list = payway_list('admin');
		$user = $db->pe_select('user', array('user_id'=>$info['user_id']), 'user_money');
		$user_money = pe_num($user['user_money'], 'round', 1);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if ($_p_order_payway == 'balance') {
				if ($user_money < $info['order_money']) pe_error('账户余额不足...');
			}
			if (order_callback_pay($order_id, '', $_p_order_payway)) {
				pe_success('付款成功!', '', 'dialog');
			}
			else {
				pe_error('付款失败...', '', 'dialog');
			}
		}
		include(pe_tpl('order_pay.html'));
	break;
	//#####################@ 订单发货 @#####################//
	case 'send':
		$order_id = pe_dbhold($_g_id);
		$info = $db->pe_select('order', array('order_id'=>$order_id));
		if ($info['order_state'] != 'wsend') pe_error('请勿重复发货...', '', 'dialog');
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if (order_callback_send($order_id, $_p_order_wl_id, $_p_order_wl_name)) {
				pe_success('发货成功!', '', 'dialog');
			}
			else {
				pe_error('发货失败!', '', 'dialog');
			}
		}
		include(pe_tpl('order_send.html'));
	break;
	//#####################@ 订单确认收货 @#####################//
	case 'success':
		pe_token_match();
		$order_id = pe_dbhold($_g_id);
		$info = $db->pe_select('order', array('order_id'=>$order_id));
		if ($info['order_state'] != 'wget') pe_error('请勿重复确认...');
		if (order_callback_success($order_id)) {
			pe_success('交易完成!');
		}
		else {
			pe_error('确认收货失败...');
		}
	break;
	//#####################@ 订单关闭 @#####################//
	case 'close':
		$order_id = pe_dbhold($_g_id);
		$info = $db->pe_select('order', array('order_id'=>$order_id));
		if ($info['order_state'] == 'close') pe_error('请勿重复关闭...', '', 'dialog');
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if (order_callback_close($order_id, $_p_order_closetext)) {
				pe_success('关闭成功!', '', 'dialog');
			}
			else {
				pe_error('关闭失败...', '', 'dialog');
			}
		}
		include(pe_tpl('order_close.html'));
	break;
	//#####################@ 订单改价格 @#####################//
	case 'money':		
		$order_id = pe_dbhold($_g_id);
		$info = $db->pe_select('order', array('order_id'=>$order_id));
		$product_list = $db->pe_selectall('orderdata', array('order_id'=>$order_id));
		if (isset($_p_pesubmit)) {
			pe_token_match();
			foreach ($_p_product_money_yh as $k=>$v) {
				$sql_set['product_money_yh'] = round($v, 1);
				$db->pe_update('orderdata', array('order_id'=>$order_id, 'product_id'=>$k), pe_dbhold($sql_set));
				$order_product_money += $_p_product_money[$k] + $sql_set['product_money_yh'];
			}
			$sql_order['order_product_money'] = $order_product_money;
			$sql_order['order_wl_money'] = $_p_order_wl_money;
			$sql_order['order_money'] = $order_product_money + $_p_order_wl_money - $info['order_quan_money'] - $info['order_point_money'];
			if ($db->pe_update('order', array('order_id'=>$order_id), pe_dbhold($sql_order))) {
				pe_success('操作成功!', '', 'dialog');
			}
			else {
				pe_error('操作失败...', '', 'dialog');
			}
		}
		include(pe_tpl('order_money.html'));
	break;
	//#####################@ 订单改地址 @#####################//
	case 'address':
		$order_id = pe_dbhold($_g_id);
		if (isset($_p_pesubmit)) {
			pe_token_match();			
			if ($db->pe_update('order', array('order_id'=>$order_id), pe_dbhold($_p_info))) {
				pe_success('修改成功!', '', 'dialog');
			}
			else {
				pe_error('修改失败...', '', 'dialog');
			}
		}
		$info = $db->pe_select('order', array('order_id'=>$order_id));
		include(pe_tpl('order_address.html'));
	break;
	//#####################@ 订单列表 @#####################//
	default:
		$_g_state && $sql_where .= " and `order_state` = '{$_g_state}'";	
		$_g_id && $sql_where .= " and `order_id` = '{$_g_id}'";
		$_g_user_id && $sql_where .= " and `user_id` = '{$_g_user_id}'";
		$_g_user_tname && $sql_where .= " and `user_tname` = '{$_g_user_tname}'";
		$_g_user_phone && $sql_where .= " and `user_phone` = '{$_g_user_phone}'";
		$_g_user_name && $sql_where .= " and `user_name` = '{$_g_user_name}'";
		$_g_date1 && $sql_where .= " and `order_atime` >= '".strtotime($_g_date1)."'";
		$_g_date2 && $sql_where .= " and `order_atime` < '".(strtotime($_g_date2) + 86400)."'";
		if ($_g_state == 'wsend') {
			$sql_where .= " order by `order_ptime` desc";	
		}
		elseif ($_g_state == 'wget') {
			$sql_where .= " order by `order_stime` desc";
		}
		elseif (in_array($_g_state, array('success', 'close'))) {
			$sql_where .= " order by `order_ftime` desc";
		}
		else {
			$sql_where .= " order by `order_id` desc";		
		}	
		$info_list = $db->pe_selectall('order', $sql_where, '*', array(20, $_g_page));
		foreach ($info_list as $k => $v) {
			$info_list[$k]['product_list'] = $db->pe_selectall('orderdata', array('order_id'=>$v['order_id']));
		}
		//统计订单数量
		$tongji['all'] = $db->pe_num('order');
		$tongji['wpay'] = $db->pe_num('order', array('order_state'=>'wpay'));
		$tongji['wsend'] = $db->pe_num('order', array('order_state'=>'wsend'));
		$tongji['wget'] = $db->pe_num('order', array('order_state'=>'wget'));
		$tongji['success'] = $db->pe_num('order', array('order_state'=>'success'));
		$tongji['close'] = $db->pe_num('order', array('order_state'=>'close'));

		$seo = pe_seo($menutitle='订单列表', '', '', 'admin');
		include(pe_tpl('order_list.html'));
	break;
}
?>