<?php
$menumark = 'order_list';
include("{$pe['path_root']}include/ini/paytype.ini.php");
$ini_wllist = array('顺丰快递','申通快递','圆通快递','韵达快递','中通快递','EMS快递');
switch ($act) {
	//#################=====订单修改=====#################//
	case 'edit':
		include("{$pe['path_root']}include/ini/paytype.ini.php");
	
		$info = $db->pe_select('order', array('order_id'=>$_g_id));
		$product_list = $db->pe_selectall('orderdata', array('order_id'=>$_g_id));

		$seo = pe_seo('修改订单', '', '', 'admin');
		$action = "admin.php?mod=order&act=editsql&id={$_g_id}";
		include(pe_tpl('order_add.html'));
	break;
	//#################=====订单修改sql=====#################//
	case 'editsql':
		if ($db->pe_update('order', array('order_id'=>$_g_id), pe_dbhold($_p_info))) {
			pe_success('订单修改成功!');
		}
		else {
			pe_error('订单修改失败!' );
		}
	break;
	//#################=====订单删除sql=====#################//
	case 'delsql':
		$order_id = is_array($_p_order_id) ? $_p_order_id : $_g_id;
		if ($db->pe_delete('order', array('order_id' => $order_id))) {
			//更新商品库存数
			pe_lead('hook/product.hook.php');
			product_num('num', $order_id, 'add');
			//删除订单子表数据
			$db->pe_delete('orderdata', array('order_id'=>$order_id));
			pe_success('订单删除成功!');
		}
		else {
			pe_error('订单删除失败!' );
		}
	break;
	//#################=====商品状态更改=====#################//
	case 'state':
		switch ($_g_state) {
			case 'paidsql':
				if ($db->pe_update('order', array('order_id'=>$_g_id), array('order_state'=>'paid', 'order_ptime'=>time()))) {
					pe_success('订单付款成功!');
				}
				else {
					pe_error('订单付款失败!');
				}
			break;
			case 'send':
				$action = "admin.php?mod=order&act=state&state=sendsql&id={$_g_id}";
				include(pe_tpl('order_send.html'));
			break;
			case 'sendsql':
				$order = $db->pe_select('order', array('order_id'=>$_g_id));
				$order['order_wlname'] = $_p_info['order_wlname'];
				$order['order_wlid'] = $_p_info['order_wlid'];
				$_p_info['order_state'] = 'send';	
				$_p_info['order_stime'] = time();
				//担保交易
				if ($order['order_paytype'] == 'alipay_db') {
					include("{$pe['path_root']}include/plugin/pay/alipay/order_send.php");
					//var_dump($doc->getElementsByTagName('is_success')->item(0)->nodeValue);
					//var_dump($doc->getElementsByTagName('trade_status')->item(0)->nodeValue);
					//var_dump($parameter);
					if ($doc->getElementsByTagName('is_success')->item(0)->nodeValue == 'T' && $doc->getElementsByTagName('trade_status')->item(0)->nodeValue == 'WAIT_BUYER_CONFIRM_GOODS') {
						$result = $db->pe_update('order', array('order_id'=>$_g_id), $_p_info);
					}
				}
				//即时到帐
				else {
					$_p_info['order_state'] = 'success';//即时到帐就不让用户确认了
					$result = $db->pe_update('order', array('order_id'=>$_g_id), $_p_info);
				}
				if ($result) {
					//更新商品售出数
					pe_lead('hook/product.hook.php');
					product_num('sellnum', $_g_id);
					pe_success('商品发货成功!', '', 'dialog');
				}
				else {
					pe_error('商品发货失败!', '', 'dialog');
				}
			break;
		}
	break;
	//#################=====订单列表=====#################//
	default:
		$_g_state && $sqlwhere .= " and `order_state` = '{$_g_state}'"; 
		$_g_id && $sqlwhere .= " and `order_id` = '{$_g_id}'";
		$sqlwhere .= " order by `order_id` desc";
		$info_list = $db->pe_selectall('order', $sqlwhere, '*', array(20, $_g_page));
		foreach ($info_list as $k => $v) {
			$info_list[$k]['product_list'] = $db->pe_selectall('orderdata', array('order_id'=>$v['order_id']));
		}

		$seo = pe_seo('订单列表', '', '', 'admin');
		include(pe_tpl('order_list.html'));
	break;
}
pe_result();
?>