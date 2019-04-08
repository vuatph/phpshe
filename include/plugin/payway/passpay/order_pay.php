<?php
include('../../../../common.php');
pe_lead('hook/order.hook.php');
require_once("shanpayconfig.php");
require_once("lib/shanpayfunction.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>支付跳转中...</title>
</head>
<?php
$order_id = pe_dbhold($_g_id);
$order = $db->pe_select(order_table($order_id), array('order_id'=>$order_id));

/**************************请求参数**************************/

//商户订单号
$out_order_no = $order['order_id'];//商户网站订单系统中唯一订单号，必填

//订单名称
$subject = $order['order_name'];//必填

//付款金额
$total_fee = $order['order_money'];//必填 需为整数

//订单描述
$body = $order['order_text'];

/************************************************************/

//构造要请求的参数数组，无需改动
$parameter = array(
		"partner" => $shan_config['partner'],
        "user_seller"  => $shan_config['user_seller'],
		"out_order_no"	=> $out_order_no,
		"subject"	=> $subject,
		"total_fee"	=> $total_fee,
		"body"	=> $body,
		"notify_url"	=> $shan_config['notify_url'],
		"return_url"	=> $shan_config['return_url']
);

//建立请求
$html = buildRequestFormShan($parameter, $shan_config['key']);
echo $html;
?>
</body>
</html>