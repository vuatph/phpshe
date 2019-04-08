<?php
/**
 * @copyright   2008-2014 简好网络 <http://www.phpshe.com>
 * @creatdate   2016-0101 koyshe <koyshe@gmail.com>
 */
$menumark = 'pay';
pe_lead('hook/order.hook.php');
$payway_list = payway_list('pay');
switch($act) {
	//#####################@ 在线充值 @#####################//
	default:
		$info = $db->pe_select('user', array('user_id'=>$_s_user_id));
		if (isset($_p_pesubmit)) {
			if (!is_array($payway_list[$_p_order_payway])) pe_error('请选择支付方式');
			if ($_p_order_money < 0.1) pe_error('最低充值0.1元');
			$sql_set['order_id'] = $order_id = order_setid('pay');
			$sql_set['order_money'] = pe_num($_p_order_money, 'floor', 1);
			$sql_set['order_name'] = "商城用户【{$_s_user_name}】账户充值{$sql_set['order_money']}元";
			$sql_set['order_payway'] = $_p_order_payway;
			$sql_set['order_atime'] = time();
			$sql_set['user_id'] = $_s_user_id;
			$sql_set['user_name'] = $_s_user_name;
			if ($db->pe_insert('order_pay', pe_dbhold($sql_set))) {
				echo '正在为您连接支付网站！';
				pe_goto("{$pe['host_root']}include/plugin/payway/{$_p_order_payway}/order_pay.php?id={$order_id}");
			}
			else {
				pe_error('充值失败');
			}
		}
		$seo = pe_seo($menutitle='账户充值');
		include(pe_tpl('pay.html'));
	break;
}
?>