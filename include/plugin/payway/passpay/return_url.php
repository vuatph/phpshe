<?php
/* *
 * 功能：服务器同步通知页面
 */
include('../../../../common.php');
pe_lead('hook/order.hook.php');
require_once("shanpayconfig.php");
require_once("lib/shanpayfunction.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>云通付接口</title>
</head>
<body>
<?php
//计算得出通知验证结果
$shanNotify = md5VerifyShan($_REQUEST['out_order_no'],$_REQUEST['total_fee'],$_REQUEST['trade_status'],$_REQUEST['sign'],$shan_config['key'],$shan_config['partner']);
//验证成功
if ($shanNotify) {
	if ($_REQUEST['trade_status'] == 'TRADE_SUCCESS') {
	    /*
		加入您的入库及判断代码;
		判断返回金额与实金额是否想同;
		判断订单当前状态;
		完成以上才视为支付成功
		*/
		//商户订单号
		$order_id = $_REQUEST['out_order_no'];
		//云通付交易号
		$order_outid = $_REQUEST['trade_no'];
		order_callback_pay($order_id, $order_outid, 'passpay');
		order_pay_goto($order_id);
		//echo "支付成功";
	}
	else {
		echo "支付失败";
	}
}
//验证失败
else {
	echo "验证失败";
}
?>
</body>
</html>