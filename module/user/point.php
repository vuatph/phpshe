<?php
$menumark = 'point';
switch($act) {
	//#####################@ 积分明细 @#####################//
	default:
		$info_list = $db->pe_selectall('pointlog', array('user_id'=>$_s_user_id, 'order by'=>'pointlog_id desc'), '*', array(20, $_g_page));
		$seo = pe_seo($menutitle='积分明细');
		include(pe_tpl('point_list.html'));
	break;
}
?>