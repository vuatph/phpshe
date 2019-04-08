<?php
/**
 * @copyright   2008-2014 简好网络 <http://www.phpshe.com>
 * @creatdate   2015-0320 koyshe <koyshe@gmail.com>
 */
pe_lead('hook/qunfa.hook.php');
if (!$cache_setting['email_smtp'] or !$cache_setting['email_port'] or !$cache_setting['email_name']) die('');
$db->query("lock tables `".dbpre."noticelog` write");
$info_list = $db->index('noticelog_id')->pe_selectall('noticelog', array('noticelog_state'=>0, 'order by'=>'noticelog_id asc'), '*', array(10));
$db->pe_update('noticelog', array('noticelog_id'=>array_keys($info_list)), array('noticelog_stime'=>time(), 'noticelog_state'=>1));
$db->query("unlock tables");
foreach ($info_list as $v) {
	qunfa_emaildiy(array('qunfa_name'=>$v['noticelog_name'], 'qunfa_text'=>$v['noticelog_text']), $v['noticelog_user']);
}
?>