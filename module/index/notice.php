<?php
/**
 * @copyright   2008-2014 简好网络 <http://www.phpshe.com>
 * @creatdate   2015-0320 koyshe <koyshe@gmail.com>
 */
session_write_close();
//检测活动信息
$nowtime = time();
$hd_list = $db->index('product_id')->sql_selectall("select * from `".dbpre."huodongdata` where `huodong_stime` <= '{$nowtime}' and `huodong_etime` > '{$nowtime}' group by `product_id`");
$hd_id = count($hd_list) ? implode(',', array_keys($hd_list)) : "''";
//恢复已过期活动
$db->pe_update('product', " and `product_id` not in ({$hd_id}) and `product_money` != `product_smoney`", "product_money = product_smoney, product_hd_tag = '', product_hd_stime = 0, product_hd_etime = 0");
$db->pe_update('prorule', " and `product_id` not in ({$hd_id}) and `product_money` != `product_smoney`", "product_money = product_smoney");
//更新进行中活动
foreach ($hd_list as $k=>$v) {
	$db->pe_update('product', array('product_id'=>$k), "product_money = product_smoney * {$v['huodong_zhe']}, product_hd_tag = '{$v['huodong_tag']}', product_hd_stime = '{$v['huodong_stime']}', product_hd_etime = '{$v['huodong_etime']}'");	
	$db->pe_update('prorule', array('product_id'=>$k), "product_money = product_smoney * {$v['huodong_zhe']}");	
}
//删除10天以上购物车商品
$db->pe_delete('cart', "and `cart_atime` <= ".($nowtime-864000));
//检测邮件/短信通知
pe_lead('hook/qunfa.hook.php');
//if (!$cache_setting['email_smtp'] or !$cache_setting['email_port'] or !$cache_setting['email_name']) die();
$db->query("lock tables `".dbpre."noticelog` write");
$info_list = $db->index('noticelog_id')->pe_selectall('noticelog', array('noticelog_state'=>'new', 'order by'=>'noticelog_id asc'), '*', array(5));
$db->pe_update('noticelog', array('noticelog_id'=>array_keys($info_list)), array('noticelog_stime'=>time(), 'noticelog_state'=>'send'));
$db->pe_update('noticelog', "and `noticelog_state` = 'send' and `noticelog_stime` <='".(time()-60)."'", array('noticelog_state'=>'new'));
$db->query("unlock tables");
foreach ($info_list as $k=>$v) {
	if ($v['noticelog_type'] == 'sms') {
		qunfa_sms($v['noticelog_user'], $v['noticelog_text'], $v['noticelog_id']);		
	}
	else {
		qunfa_email(array('qunfa_name'=>$v['noticelog_name'], 'qunfa_text'=>$v['noticelog_text']), $v['noticelog_user'], $v['noticelog_id']);		
	}
}
?>