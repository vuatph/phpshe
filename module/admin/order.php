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
		$order_state = order_state($info);

		$seo = pe_seo($menutitle='订单详情', '', '', 'admin');
		include(pe_tpl('order_add.html'));
	break;
	//#####################@ 订单删除 @#####################//
	case 'del':
		pe_token_match();
		$order_id = pe_dbhold($_g_id);
		if ($db->pe_delete('order', array('order_id'=>$order_id))) {
			order_callback('del', $order_id);
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
		if ($info['order_state'] != 'notpay') pe_error('请勿重复付款...', '', 'dialog');
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$_p_info['order_state'] = 'paid';
			$_p_info['order_ptime'] = time();
			if ($db->pe_update('order', array('order_id'=>$order_id), pe_dbhold($_p_info))) {
				order_callback('pay', $order_id);
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
		if (!in_array($info['order_state'], array('notpay', 'paid'))) pe_error('请勿重复发货...', '', 'dialog');
		if (isset($_p_pesubmit)) {
			pe_token_match();
			//担保交易（自动同步支付宝）
			if ($info['order_payway'] == 'alipay_db') {
				include("{$pe['path_root']}include/plugin/payway/alipay/order_send.php");	
			}
			$_p_info['order_state'] = 'send';
			$_p_info['order_stime'] = time();
			if ($db->pe_update('order', array('order_id'=>$order_id), pe_dbhold($_p_info))) {
				order_callback('send', $order_id);
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
		if ($info['order_state'] != 'send') pe_error('请勿重复确认...');
		//货到付款（同时更新付款时间）
		if ($info['order_payway'] == 'cod') $_p_info['order_ptime'] = time();	
		$_p_info['order_ftime'] = time();
		$_p_info['order_state'] = 'success';
		if ($db->pe_update('order', array('order_id'=>$order_id), pe_dbhold($_p_info))) {
			order_callback('success', $order_id);
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
			$_p_info['order_ftime'] = time();
			$_p_info['order_state'] = 'close';
			if ($db->pe_update('order', array('order_id'=>$order_id), pe_dbhold($_p_info))) {
				order_callback('close', $order_id);
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
			$sql_order['order_payway'] = $_p_order_payway;
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
		if ($_g_state == 'notpay') {
			$sqlwhere .= " and `order_state` = 'notpay' and `order_payway` != 'cod'";
		}
		elseif ($_g_state == 'paid') {
			$sqlwhere .= " and (`order_state` = 'paid' or (`order_state` = 'notpay' and `order_payway` = 'cod'))";
		}
		elseif ($_g_state) {
			$sqlwhere .= " and `order_state` = '{$_g_state}'";	
		}
		$_g_id && $sqlwhere .= " and `order_id` = '{$_g_id}'";
		$_g_user_tname && $sqlwhere .= " and `user_tname` = '{$_g_user_tname}'";
		$_g_user_phone && $sqlwhere .= " and `user_phone` = '{$_g_user_phone}'";
		$_g_user_name && $sqlwhere .= " and `user_name` = '{$_g_user_name}'";
		$_g_date1 && $sqlwhere .= " and `order_atime` >= '".strtotime($_g_date1)."'";
		$_g_date2 && $sqlwhere .= " and `order_atime` < '".(strtotime($_g_date2) + 86400)."'";
		$sqlwhere .= " order by `order_id` desc";
		$info_list = $db->pe_selectall('order', $sqlwhere, '*', array(20, $_g_page));
		foreach ($info_list as $k => $v) {
			$info_list[$k]['product_list'] = $db->pe_selectall('orderdata', array('order_id'=>$v['order_id']));
		}
		//统计订单数量
		$tongji['all'] = $db->pe_num('order');
		$tongji['notpay'] = $db->pe_num('order', " and `order_state` = 'notpay' and `order_payway` != 'cod'");
		$tongji['paid'] = $db->pe_num('order', " and (`order_state` = 'paid' or (`order_state` = 'notpay' and `order_payway` = 'cod'))");
		$tongji['send'] = $db->pe_num('order', array('order_state'=>'send'));
		$tongji['success'] = $db->pe_num('order', array('order_state'=>'success'));
		$tongji['close'] = $db->pe_num('order', array('order_state'=>'close'));

		$seo = pe_seo($menutitle='订单列表', '', '', 'admin');
		include(pe_tpl('order_list.html'));
	break;
}
?>