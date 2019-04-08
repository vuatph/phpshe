<?php
$menumark = 'quan';
switch($act) {
	//#####################@ 优惠券列表 @#####################//
	default:
		user_quancheck();
		$info_list = $db->pe_selectall('quanlog', array('user_id'=>$_s_user_id, 'order by'=>'quanlog_id desc'), '*', array(20, $_g_page));

		$tongji['all'] = $db->pe_num('quanlog', array('user_id'=>$_s_user_id));	
		$seo = pe_seo($menutitle='我的优惠券');
		include(pe_tpl('quan_list.html'));
	break;
}
?>