<?php
/**
 * @copyright   2008-2015 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
$menumark = 'order_pay';
$cache_payway = cache::get('payway');
switch ($act) {
	//#####################@ 充值记录 @#####################//
	default:
		$_g_id && $sql_where .= " and `order_id` = '{$_g_id}'";
		$_g_user_name && $sql_where .= " and `user_name` like '%{$_g_user_name}%'";
		$_g_state && $sql_where .= " and `order_state` = '{$_g_state}'";
		$sql_where .= ' order by `order_id` desc';

		$info_list = $db->pe_selectall('order_pay', $sql_where, '*', array(50, $_g_page));
		$tongji_arr = $db->index('order_state')->pe_selectall('order_pay', array('group by'=>'order_state'), 'count(1) as `num`, `order_state`');
		$tongji['wpay'] = intval($tongji_arr['wpay']['num']);
		$tongji['success'] = intval($tongji_arr['success']['num']);		
		$tongji['all'] = $tongji['wpay'] + $tongji['success'];		
		
		$seo = pe_seo($menutitle='充值记录');
		include(pe_tpl('order_pay_list.html'));
	break;
}
?>