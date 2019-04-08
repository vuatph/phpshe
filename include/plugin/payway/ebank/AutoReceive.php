<?php
include('../../../../common.php');
$cache_payway = cache::get('payway');
$payway = unserialize($cache_payway['ebank']['payway_config']);
$key   = $payway['ebank_md5'];

$v_oid     =trim($_POST['v_oid']);      
$v_pmode   =trim($_POST['v_pmode']);      
$v_pstatus =trim($_POST['v_pstatus']);      
$v_pstring =trim($_POST['v_pstring']);      
$v_amount  =trim($_POST['v_amount']);     
$v_moneytype  =trim($_POST['v_moneytype']);     
$remark1   =trim($_POST['remark1']);     
$remark2   =trim($_POST['remark2']);     
$v_md5str  =trim($_POST['v_md5str']);     
/**
 * 重新计算md5的值
 */
                           
$md5string=strtoupper(md5($v_oid.$v_pstatus.$v_amount.$v_moneytype.$key)); //拼凑加密串
if ($v_md5str==$md5string)
{
   if($v_pstatus=="20")
	{
		$info = $db->pe_select('order', array('order_id'=>$v_oid));
		if ($info['order_state'] == 'notpay') {
			$order['order_outid'] = $v_pmode;
			$order['order_payway'] = 'ebank';
			$order['order_state'] = 'paid';
			$order['order_ptime'] = time();					
			$db->pe_update('order', array('order_id'=>$v_oid), $order);
		}
		
	}
  echo "ok";
	
}else{
	echo "error";
}
?>