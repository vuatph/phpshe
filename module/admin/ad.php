<?php
/**
 * @copyright   2008-2014 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
$menumark = 'ad';
pe_lead('hook/cache.hook.php');
$ad_position = array('index_jdt'=>'首页焦点图广告(700*300)', 'index_header'=>'首页顶部广告(1200*80)','index_footer'=>'首页底部广告(1200*80)', 'header'=>'整站顶部广告(1200*80)','footer'=>'整站底部广告(1200*80)');
switch ($act) {
	//#####################@ 添加广告 @#####################//
	case 'add':
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if ($_FILES['ad_logo']['size']) {
				pe_lead('include/class/upload.class.php');
				$upload = new upload($_FILES['ad_logo']);
				$_p_info['ad_logo'] = $upload->filehost;
			}
			if ($db->pe_insert('ad', pe_dbhold($_p_info))) {
				cache_write('ad');
				pe_success('广告添加成功!', 'admin.php?mod=ad');
			}
			else {
				pe_error('广告添加失败...');
			}
		}
		$info['ad_state'] = 1;
		$seo = pe_seo($menutitle='添加广告', '', '', 'admin');
		include(pe_tpl('ad_add.html'));
	break;
	//#####################@ 修改广告 @#####################//
	case 'edit':
		$ad_id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if ($_FILES['ad_logo']['size']) {
				pe_lead('include/class/upload.class.php');
				$upload = new upload($_FILES['ad_logo']);
				$_p_info['ad_logo'] = $upload->filehost;
			}
			if ($db->pe_update('ad', array('ad_id'=>$ad_id), pe_dbhold($_p_info))) {
				cache_write('ad');
				pe_success('广告修改成功!', 'admin.php?mod=ad');
			}
			else {
				pe_error('广告修改失败...');
			}
		}
		$info = $db->pe_select('ad', array('ad_id'=>$ad_id));
		$seo = pe_seo($menutitle='修改广告', '', '', 'admin');
		include(pe_tpl('ad_add.html'));
	break;
	//#####################@ 广告排序 @#####################//
	case 'order':
		pe_token_match();
		foreach ($_p_ad_order as $k=>$v) {
			$result = $db->pe_update('ad', array('ad_id'=>$k), array('ad_order'=>$v));
		}
		if ($result) {
			cache_write('ad');
			pe_success('广告排序成功!');
		}
		else {
			pe_error('广告排序失败...');
		}
	break;
	//#####################@ 广告删除 @#####################//
	case 'del':
		pe_token_match();
		if ($db->pe_delete('ad', array('ad_id'=>is_array($_p_ad_id) ? $_p_ad_id : $_g_id))) {
			cache_write('ad');
			pe_success('广告删除成功!');
		}
		else {
			pe_error('广告删除失败...');
		}
	break;
	//#####################@ 广告状态 @#####################//
	case 'state':
		pe_token_match();
		if ($db->pe_update('ad', array('ad_id'=>is_array($_p_ad_id) ? $_p_ad_id : $_g_id), array('ad_state'=>$_g_state))) {
			cache_write('ad');
			pe_success("操作成功!");
		}
		else {
			pe_error("操作失败...");
		}
	break;
	//#####################@ 广告列表 @#####################//
	default :
		$info_list = $db->pe_selectall('ad', array('order by'=>'`ad_order` asc, `ad_id` asc'), '*', array(10, $_g_page));
		$seo = pe_seo($menutitle='广告列表', '', '', 'admin');
		include(pe_tpl('ad_list.html'));
	break;
}
?>