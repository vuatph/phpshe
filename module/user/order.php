<?php
$menumark = 'order';
pe_lead('hook/order.hook.php');
pe_lead('hook/product.hook.php');
$cache_payway = cache::get('payway');
switch($act) {
	//#####################@ 订单详情 @#####################//
	case 'view':
		$order_id = pe_dbhold($_g_id);
		$info = $db->pe_select('order', array('order_id'=>$order_id, 'user_id'=>$_s_user_id));
		if (!$info['order_id']) pe_error('参数错误...');
		$product_list = $db->pe_selectall('orderdata', array('order_id'=>$order_id));
		$order_state = order_state($info);
		$seo = pe_seo($menutitle='订单详情');
		include(pe_tpl('order_view.html'));
	break;
	//#####################@ 订单关闭 @#####################//
	case 'close':
		$order_id = pe_dbhold($_g_id);
		$info = $db->pe_select('order', array('user_id'=>$_s_user_id, 'order_id'=>$order_id));
		if (!$info['order_id']) pe_error('参数错误...');
		if ($info['order_state'] == 'close') pe_error('该订单已取消，请勿重复操作...', '', 'dialog');
		if (in_array($info['order_state'], array('paid', 'send', 'success'))) pe_error('已付款订单不能取消...', '', 'dialog');
		if (isset($_p_pesubmit)) {
			if (!$_p_order_closetext) pe_error('请填写订单取消原因...');
			$sql_set['order_ftime'] = time();
			$sql_set['order_state'] = 'close';
			$sql_set['order_closetext'] = $_p_order_closetext;
			if ($db->pe_update('order', array('order_id'=>$order_id), pe_dbhold($sql_set))) {
				order_callback('close', $order_id);
				pe_success('订单取消成功!', '', 'dialog');
			}
			else {
				pe_error('订单取消失败...', '', 'dialog');
			}
		}
		$seo = pe_seo($menutitle='订单关闭');
		include(pe_tpl('order_close.html'));
	break;
	//#####################@ 订单确认收货 @#####################//
	case 'success':
		$order_id = pe_dbhold($_g_id);
		$info = $db->pe_select('order', array('user_id'=>$_s_user_id, 'order_id'=>$order_id));
		if (!$info['order_id']) pe_error('参数错误...');
		if ($info['order_state'] != 'send') pe_error('未发货订单不能确认...');
		if (in_array($info['order_payway'], array('alipay_db', 'cod'))) pe_error('参数错误...');
		$sql_set['order_ftime'] = time();
		$sql_set['order_state'] = 'success';
		if ($db->pe_update('order', array('order_id'=>$order_id), pe_dbhold($sql_set))) {
			order_callback('success', $order_id);
			pe_success('操作成功!');
		}
		else {
			pe_error('操作失败...');
		}
	break;
	//#####################@ 订单评价 @#####################//
	case 'comment':
		$order_id = pe_dbhold($_g_id);
		$info = $db->pe_select('order', array('order_id'=>$order_id, 'user_id'=>$_s_user_id));
		if (!$info['order_id']) pe_error('参数错误...');
		$info_list = $db->pe_selectall('orderdata', array('order_id'=>$order_id));
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if ($info['order_comment']) pe_error('请勿重复评价...');
			foreach ($info_list as $k=>$v) {
				$sql_set[$k]['comment_star'] = intval($_p_comment_star[$v['product_id']]);
				$sql_set[$k]['comment_text'] = pe_dbhold($_p_comment_text[$v['product_id']]);
				$sql_set[$k]['comment_atime']= time();
				$sql_set[$k]['product_id'] = $v['product_id'];
				$sql_set[$k]['order_id'] = $order_id;
				$sql_set[$k]['user_ip'] = pe_dbhold(pe_ip());
				$sql_set[$k]['user_id'] = $_s_user_id;
				$sql_set[$k]['user_name'] = $_s_user_name;
				if (!$sql_set[$k]['comment_text']) pe_error('评价内容必须填写...');
			}
			if ($db->pe_insert('comment', $sql_set)) {
				order_callback('comment', $order_id);
				pe_success('评价成功!');
			}
			else {
				pe_error('评价失败...');
			}
		}
		$seo = pe_seo($menutitle='订单评价', '', '', 'admin');
		include(pe_tpl('order_comment.html'));
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
		$sqlwhere .= " and `user_id` = '{$_s_user_id}' order by `order_id` desc";
		$info_list = $db->pe_selectall('order', $sqlwhere, '*', array(10, $_g_page));
		foreach ($info_list as $k => $v) {
			$info_list[$k]['product_list'] = $db->pe_selectall('orderdata', array('order_id'=>$v['order_id']));
		}
		//统计订单数量
		$tongji['all'] = $db->pe_num('order', array('user_id'=>$_s_user_id));
		$tongji['notpay'] = $db->pe_num('order', " and `user_id` = '{$_s_user_id}' and `order_state` = 'notpay' and `order_payway` != 'cod'");
		$tongji['paid'] = $db->pe_num('order', " and `user_id` = '{$_s_user_id}' and (`order_state` = 'paid' or (`order_state` = 'notpay' and `order_payway` = 'cod'))");
		$tongji['send'] = $db->pe_num('order', array('user_id'=>$_s_user_id, 'order_state'=>'send'));
		$tongji['success'] = $db->pe_num('order', array('user_id'=>$_s_user_id, 'order_state'=>'success'));
		$tongji['close'] = $db->pe_num('order', array('user_id'=>$_s_user_id, 'order_state'=>'close'));

		$seo = pe_seo($menutitle='我的订单');
		include(pe_tpl('order_list.html'));
	break;
}
?>