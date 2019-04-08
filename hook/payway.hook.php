<?php
function payway_ini() {
	$paytype['alipay'] = '支付宝付款';
	$paytype['alipay_js'] = '支付宝-即时到帐';
	$paytype['alipay_db'] = '支付宝-担保交易';
	$paytype['bank'] = '线下转账/汇款';
	$paytype['cod'] = '货到付款';
	$paytype['ebank'] = '网银在线';
	return $paytype;
}
?>