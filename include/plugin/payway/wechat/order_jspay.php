<?php
include('../../../../common.php');
pe_lead('hook/order.hook.php');
pe_lead('hook/wechat.hook.php');

$order_id = pe_dbhold($_g_id);
$order = $db->pe_select(order_table($order_id), array('order_id'=>$order_id));
$json = wechat_jspay($order_id);
pe_jsonshow($json);
?>