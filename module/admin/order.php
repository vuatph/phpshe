<?php
/**
 * @copyright   2008-2012 简好技术 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
$menumark = 'order';
pe_lead('hook/payway.hook.php');
$ini_payway = payway_ini();
//$ini_wllist = array('顺丰快递','申通快递','圆通快递','韵达快递','中通快递','天天快递','宅急送','EMS快递','百事汇通','全峰快递','德邦物流');
$wlname_list = is_array(unserialize($cache_setting['web_wlname']['setting_value'])) ? unserialize($cache_setting['web_wlname']['setting_value']) : array();
$cache_payway = cache::get('payway');
switch ($act) {
	//#####################@ 订单修改 @#####################//
	case 'edit':
		$order_id = pe_dbhold($_g_id);
		if (isset($_p_pesubmit)) {
			$_p_info['order_money'] = $_p_info['order_productmoney'] + $_p_info['order_wlmoney'];
			if ($db->pe_update('order', array('order_id'=>$order_id), pe_dbhold($_p_info))) {
				pe_success('订单修改成功!');
			}
			else {
				pe_error('订单修改失败...');
			}
		}	
		$info = $db->pe_select('order', array('order_id'=>$order_id));
		$product_list = $db->pe_selectall('orderdata', array('order_id'=>$order_id));

		$seo = pe_seo($menutitle='修改订单', '', '', 'admin');
		include(pe_tpl('order_add.html'));
	break;
	//#####################@ 订单删除 @#####################//
	case 'del':
		$order_id = is_array($_p_order_id) ? $_p_order_id : $_g_id;
		if ($db->pe_delete('order', array('order_id'=>$order_id))) {
			//更新商品库存数
			pe_lead('hook/product.hook.php');
			product_num('addnum', $order_id);
			//删除订单子表数据
			$db->pe_delete('orderdata', array('order_id'=>$order_id));
			pe_success('订单删除成功!');
		}
		else {
			pe_error('订单删除失败...');
		}
	break;
	//#####################@ 订单状态更改 @#####################//
	case 'state':
		$order_id = pe_dbhold($_g_id);
		switch ($_g_state) {
			case 'paid':
				$order = $db->pe_select('order', array('order_id'=>$order_id));
				$_p_info['order_state'] = $order['order_payway'] == 'cod' ? 'success': 'paid';
				$_p_info['order_ptime'] = time();
				if ($db->pe_update('order', array('order_id'=>$order_id), $_p_info)) {
					pe_success('订单付款成功!');
				}
				else {
					pe_error('订单付款失败...');
				}
			break;
			case 'send':
				if (isset($_p_pesubmit)) {
					$order = $db->pe_select('order', array('order_id'=>$order_id));
					//$order['order_wlname'] = $_p_info['order_wlname'];
					//$order['order_wlid'] = $_p_info['order_wlid'];
					$_p_info['order_stime'] = time();
					//货到付款
					if ($order['order_payway'] == 'cod') {
						$_p_info['order_state'] = 'send';
					}
					//担保交易
					elseif ($order['order_payway'] == 'alipay_db') {
						include("{$pe['path_root']}include/plugin/payway/alipay/order_send.php");
						$_p_info['order_state'] = 'send';
					}
					//即时到帐
					else {
						$_p_info['order_state'] = 'success';//即时到帐就不让用户确认了
					}
					if ($db->pe_update('order', array('order_id'=>$order_id), $_p_info)) {
						//更新商品售出数
						pe_lead('hook/product.hook.php');
						product_num('sellnum', $order_id);
						pe_success('商品发货成功!', '', 'dialog');
					}
					else {
						pe_error('商品发货失败!', '', 'dialog');
					}
				}
				include(pe_tpl('order_send.html'));
			break;
		}
	break;
	//#####################@ 订单列表 @#####################//
	default:
		$_g_state && $sqlwhere .= " and `order_state` = '{$_g_state}'"; 
		$_g_id && $sqlwhere .= " and `order_id` = '{$_g_id}'";
		$_g_user_tname && $sqlwhere .= " and `user_tname` = '{$_g_user_tname}'";
		$_g_user_phone && $sqlwhere .= " and `user_phone` = '{$_g_user_phone}'";
		$sqlwhere .= " order by `order_id` desc";
		$info_list = $db->pe_selectall('order', $sqlwhere, '*', array(10, $_g_page));
		foreach ($info_list as $k => $v) {
			$info_list[$k]['product_list'] = $db->pe_selectall('orderdata', array('order_id'=>$v['order_id']));
		}
		$seo = pe_seo($menutitle='订单列表', '', '', 'admin');
		include(pe_tpl('order_list.html'));
	break;
}
?>