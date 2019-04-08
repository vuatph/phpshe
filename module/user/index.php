<?php
$menumark = 'index';
pe_lead('hook/order.hook.php');
$cache_payway = cache::get('payway');
switch($act) {
	//#####################@ 个人中心 @#####################//
	default:
		$info = $db->pe_select('user', array('user_id'=>$_s_user_id));
		//统计订单数量
		$tongji['wpay'] = $db->pe_num('order', array('user_id'=>$_s_user_id, 'order_state'=>'wpay'));
		$tongji['wsend'] = $db->pe_num('order', array('user_id'=>$_s_user_id, 'order_state'=>'wsend'));

		$info_list = $db->pe_selectall('order', array('user_id'=>$_s_user_id, 'order by'=>'order_id desc'), '*', array(5));
		foreach ($info_list as $k => $v) {
			$info_list[$k]['product_list'] = $db->pe_selectall('orderdata', array('order_id'=>$v['order_id']));
		}

		$seo = pe_seo($menutitle='个人中心');
		include(pe_tpl('index.html'));
	break;
}
?>