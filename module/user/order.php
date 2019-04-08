<?php
$menumark = 'order';
pe_lead('hook/order.hook.php');
$cache_payway = cache::get('payway');
switch($act) {
	//#####################@ 订单详情 @#####################//
	case 'view':
		$order_id = pe_dbhold($_g_id);
		$info = $db->pe_select('order', array('order_id'=>$order_id, 'user_id'=>$_s_user_id));
		if (!$info['order_id']) pe_error('参数错误...');
		$product_list = $db->pe_selectall('orderdata', array('order_id'=>$order_id));
		$seo = pe_seo($menutitle='订单详情');
		include(pe_tpl('order_view.html'));
	break;
	//#####################@ 订单取消 @#####################//
	case 'close':
		$order_id = pe_dbhold($_g_id);
		$info = $db->pe_select('order', array('order_id'=>$order_id, 'user_id'=>$_s_user_id));
		if (!$info['order_id']) pe_error('参数错误', '', 'dialog');
		if ($info['order_state'] == 'close') pe_error('订单已关闭，请勿重复操作', '', 'dialog');
		if (in_array($info['order_state'], array('wget', 'success'))) pe_error('已发货订单不能取消', '', 'dialog');
		if (isset($_p_pesubmit)) {
			if (!$_p_order_closetext) pe_error('请填写订单取消原因');
			if (order_callback_close($order_id, $_p_order_closetext)) {
				pe_success('取消成功!', '', 'dialog');
			}
			else {
				pe_error('取消失败', '', 'dialog');
			}
		}
		$seo = pe_seo($menutitle='订单取消');
		include(pe_tpl('order_close.html'));
	break;
	//#####################@ 订单确认收货 @#####################//
	case 'success':
		$order_id = pe_dbhold($_g_id);
		$info = $db->pe_select('order', array('order_id'=>$order_id, 'user_id'=>$_s_user_id));
		if (!$info['order_id']) pe_error('参数错误');
		if ($info['order_state'] != 'wget') pe_error('未发货订单不能确认');
		if (in_array($info['order_payway'], array('alipay_db', 'cod'))) pe_error('参数错误');
		if (order_callback_success($order_id)) {
			pe_success('操作成功!');
		}
		else {
			pe_error('操作失败');
		}
	break;
	//#####################@ 订单评价 @#####################//
	case 'comment':
		$order_id = pe_dbhold($_g_id);
		$info = $db->pe_select('order', array('order_id'=>$order_id, 'user_id'=>$_s_user_id));
		if (!$info['order_id']) pe_error('参数错误', '', 'dialog');
		if ($info['order_state'] != 'success') pe_error('订单未未完成', '', 'dialog');
		if ($info['order_comment']) pe_error('请勿重复评价', 'user.php?mod=comment', 'dialog');
		$info_list = $db->pe_selectall('orderdata', array('order_id'=>$order_id));
		if (isset($_p_pesubmit)) {
			pe_token_match();
			foreach ($info_list as $k=>$v) {
				$sql_set[$k]['comment_star'] = intval($_p_comment_star[$v['product_id']]);
				$sql_set[$k]['comment_text'] = pe_dbhold($_p_comment_text[$v['product_id']]);
				$sql_set[$k]['comment_atime']= time();
				$sql_set[$k]['product_id'] = $v['product_id'];
				$sql_set[$k]['product_name'] = $v['product_name'];
				$sql_set[$k]['product_logo'] = $v['product_logo'];
				$sql_set[$k]['order_id'] = $order_id;
				$sql_set[$k]['user_ip'] = pe_dbhold(pe_ip());
				$sql_set[$k]['user_id'] = $_s_user_id;
				$sql_set[$k]['user_name'] = $_s_user_name;
				if (!$sql_set[$k]['comment_text']) pe_error('请填写评价内容');
			}
			if ($db->pe_insert('comment', $sql_set)) {
				order_callback_comment($order_id);
				pe_success('评价成功!', 'user.php?mod=comment', 'dialog');
			}
			else {
				pe_error('评价失败');
			}
		}
		$seo = pe_seo($menutitle='订单评价', '', '', 'user');
		include(pe_tpl('order_comment.html'));
	break;
	//#####################@ 订单列表 @#####################//
	default:
		if ($_g_state == 'wpj') {
			$sql_where .= " and `order_state` = 'success' and `order_comment` = 0";
		}
		elseif (in_array($_g_state, array('wpay', 'wsend', 'wget', 'success'))) {
			$sql_where .= " and `order_state` = '".pe_dbhold($_g_state)."'";	
		}
		$sql_where .= " and `user_id` = '{$_s_user_id}' order by `order_id` desc";
		$info_list = $db->pe_selectall('order', $sql_where, '*', array(20, $_g_page));
		foreach ($info_list as $k => $v) {
			$info_list[$k]['product_list'] = $db->pe_selectall('orderdata', array('order_id'=>$v['order_id']));
		}
		//统计订单数量
		$tj = $db->index('order_state')->pe_selectall('order', array('user_id'=>$_s_user_id, 'group by'=>'order_state'), '`order_state`, count(1) as `num`');
		$tongji['all'] = intval($tj['wpay']['num'] + $tj['wsend']['num'] + $tj['wget']['num'] + $tj['success']['num'] + $tj['close']['num']);
		$tongji['wpay'] = intval($tj['wpay']['num']);
		$tongji['wsend'] = intval($tj['wsend']['num']);
		$tongji['wget'] = intval($tj['wget']['num']);
		$tongji['success'] = intval($tj['success']['num']);
		$tongji['wpj'] = $db->pe_num('order', array('user_id'=>$_s_user_id, 'order_state'=>'success', 'order_comment'=>0));

		$seo = pe_seo($menutitle='我的订单');
		include(pe_tpl('order_list.html'));
	break;
}
?>