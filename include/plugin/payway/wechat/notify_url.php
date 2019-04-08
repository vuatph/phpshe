<?php
include('../../../../common.php');
pe_lead('hook/order.hook.php');
pe_lead('hook/wechat.hook.php');
$cache_payway = cache::get('payway');
$payway = $cache_payway['wechat']['payway_config'];

$xml = wechat_getxml();
//商户订单号
$order_id = substr(pe_dbhold($xml['out_trade_no']), 0, -4);
//微信订单号
$order_outid = pe_dbhold($xml['transaction_id']);
if ($xml['sign'] == wechat_sign($xml, $payway['wechat_key'])) {
	if ($xml['return_code'] == 'SUCCESS' && $xml['result_code'] == 'SUCCESS') {
		order_callback_pay($order_id, $order_outid, 'wechat');
		echo wechat_sendxml(array('return_code'=>'SUCCESS', 'return_msg'=>''));
	}
}
else {
	echo wechat_sendxml(array('return_code'=>'FAIL', 'return_msg'=>''));
}
?>