<?php
function payway_ini() {
	$paytype['alipay'] = '支付宝付款';
	$paytype['alipay_js'] = '支付宝-即时到帐';
	$paytype['alipay_db'] = '支付宝-担保交易';
	$paytype['bank'] = '银行转账/汇款';
	$paytype['cod'] = '货到付款';
	return $paytype;
}
?>