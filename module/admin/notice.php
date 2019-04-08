<?php
/**
 * @copyright   2008-2015 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
$menumark = 'setting';
pe_lead('hook/cache.hook.php');
switch ($act) {
	//#####################@ 通知修改 @#####################//
	case 'edit':
		$notice_id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if ($db->pe_update('notice', array('notice_id'=>$notice_id), pe_dbhold($_p_info, array('notice_email_text')))) {
				cache_write('notice');
				pe_success('修改成功!', 'admin.php?mod=notice', 'dialog');
			}
			else {
				pe_error('修改失败...' );
			}
		}
		$info = $db->pe_select('notice', array('notice_id'=>$notice_id));
		$seo = pe_seo($menutitle='修改通知', '', '', 'admin');
		include(pe_tpl('notice_add.html'));
	break;
	//#####################@ 通知状态 @#####################//
	case 'sms_state':
	case 'email_state':
		pe_token_match();
		$notice_id = is_array($_p_notice_id) ? $_p_notice_id : $_g_id;
		if ($db->pe_update('notice', array('notice_id'=>$notice_id), array("notice_{$act}"=>$_g_state))) {
			cache_write('notice');
			pe_success("操作成功!");
		}
		else {
			pe_error("操作失败...");
		}
	break;
	//#####################@ 发送记录 @#####################//
	case 'log':
		$info_list = $db->pe_selectall('noticelog', array('order by'=>'noticelog_id desc'), '*', array(50, $_g_page));
		$tongji['all'] = $db->pe_num('noticelog');
		$seo = pe_seo($menutitle='发送记录', '', '', 'admin');
		include(pe_tpl('notice_log.html'));
	break;
	//#####################@ 链接列表 @#####################//
	default:
		$info_list = $db->index('notice_obj|notice_mark')->pe_selectall('notice');
		$tongji['all'] = $db->pe_num('noticelog');
		$seo = pe_seo($menutitle='通知设置', '', '', 'admin');
		include(pe_tpl('notice_list.html'));
	break;
}
?>