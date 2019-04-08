<?php
/**
 * @copyright   2008-2014 简好网络 <http://www.phpshe.com>
 * @creatdate   2015-0320 koyshe <koyshe@gmail.com>
 */
session_write_close();
//检测活动信息
$db->pe_update('product', " and `product_hd_etime` > 0 and `product_hd_etime` <= '".time()."'", "product_money = product_smoney, product_hd_tag = '', product_hd_stime = 0, product_hd_etime = 0");
$table_huodong = "(select `product_id` from `".dbpre."huodongdata` where `huodong_stime` <= '".time()."' and `huodong_etime` > '".time()."' group by `product_id`)";
$sql = "update `".dbpre."product` a left join {$table_huodong} b on a.`product_id` = b.`product_id` set a.`product_money` = a.`product_smoney`, a.`product_hd_tag` = '', a.`product_hd_stime` = 0, a.`product_hd_etime` = 0 where b.`product_id` is null";
$db->sql_update($sql);
$table_huodong = "(select * from (select * from `".dbpre."huodongdata` where `huodong_stime` <= '".time()."' and `huodong_etime` > '".time()."' order by `huodong_stime` asc) aa group by `product_id`)";
$sql = "update `".dbpre."product` a, {$table_huodong} b set a.`product_money` = b.`huodong_money`, a.`product_hd_tag` = b.`huodong_tag`, a.`product_hd_stime` = b.`huodong_stime`, a.`product_hd_etime` = b.`huodong_etime` where a.`product_id` = b.`product_id`";
$db->sql_update($sql);
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