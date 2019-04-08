<?php
/**
 * @copyright   2008-2014 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
pe_lead('hook/cache.hook.php');
$menumark = 'setting';
switch ($act) {
	//#####################@ 积分设置 @#####################//
	case 'point':
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$sql = "update `".dbpre."setting` set `setting_value` = case `setting_key`
				when 'point_state' then '".pe_dbhold($_p_info['point_state'])."'
				when 'point_money' then '".pe_dbhold($_p_info['point_money'])."'
				when 'point_reg' then '".pe_dbhold($_p_info['point_reg'])."'
				when 'point_login' then '".pe_dbhold($_p_info['point_login'])."'
				when 'point_comment' then '".pe_dbhold($_p_info['point_comment'])."' else `setting_value` end";
			if ($db->sql_update($sql)) {
				cache_write('setting');
				pe_success('积分设置成功!');
			}
			else {
				pe_error('积分设置失败...');
			}
		}
		$info = $db->index('setting_key')->pe_selectall('setting');		
		$seo = pe_seo($menutitle='积分设置', '', '', 'admin');
		include(pe_tpl('setting_point.html'));		
	break;
	//#####################@ 邮箱设置 @#####################//
	case 'email':
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$sql = "update `".dbpre."setting` set `setting_value` = case `setting_key`
				when 'email_smtp' then '".pe_dbhold($_p_info['email_smtp'])."'
				when 'email_port' then '".pe_dbhold($_p_info['email_port'])."'
				when 'email_name' then '".pe_dbhold($_p_info['email_name'])."'
				when 'email_pw' then '".pe_dbhold($_p_info['email_pw'])."'
				when 'email_nname' then '".pe_dbhold($_p_info['email_nname'])."'
				when 'email_admin' then '".pe_dbhold($_p_info['email_admin'])."' else `setting_value` end";
			if ($db->sql_update($sql)) {
				cache_write('setting');
				pe_success('邮箱设置成功!');
			}
			else {
				pe_error('邮箱设置失败...');
			}
		}
		$info = $db->index('setting_key')->pe_selectall('setting');		
		$seo = pe_seo($menutitle='邮箱设置', '', '', 'admin');
		include(pe_tpl('setting_email.html'));		
	break;
	//#####################@ 邮件测试 @#####################//
	case 'email_test':
		pe_token_match();
		if (!$_g_user) pe_error('管理员邮箱未填写...');
		foreach (explode(',', $_g_user) as $k=>$v) {
			if (!$v) continue;
			$noticelog_list[$k]['noticelog_user'] = pe_dbhold($v);
			$noticelog_list[$k]['noticelog_name'] = 'PHPSHE商城系统测试邮件';
			$noticelog_list[$k]['noticelog_text'] = '尊敬的用户：您好，欢迎使用简好网络旗下软件 - PHPSHE商城系统<br/><br/>简好网络官网：http://www.phpshe.com<br/><br/>邮件发送日期：'.pe_date(time());
			$noticelog_list[$k]['noticelog_atime'] = time();			
		}
		if ($db->pe_insert('noticelog', $noticelog_list)) {
			pe_success('发送成功!');
		}
		else {
			pe_error('发送失败...');
		}	
	break;
	//#####################@ 快递设置 @#####################//
	case 'kuaidi':
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$sql = "update `".dbpre."setting` set `setting_value` = case `setting_key`
				when 'web_wlname' then '".pe_dbhold(serialize($_p_web_wlname), 'all')."' else `setting_value` end";
			if ($db->sql_update($sql)) {
				cache_write('setting');
				pe_success('快递设置成功!');
			}
			else {
				pe_error('快递设置失败...');
			}
		}
		$info = $db->index('setting_key')->pe_selectall('setting');		
		$seo = pe_seo($menutitle='快递设置', '', '', 'admin');
		include(pe_tpl('setting_kuaidi.html'));		
	break;
	//#####################@ 短信接口 @#####################//
	case 'sms':
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$sql = "update `".dbpre."setting` set `setting_value` = case `setting_key`
				when 'sms_key' then '".pe_dbhold($_p_info['sms_key'])."'
				when 'sms_admin' then '".pe_dbhold($_p_info['sms_admin'])."' else `setting_value` end";
			if ($db->sql_update($sql)) {
				cache_write('setting');
				pe_success('接口设置成功!');
			}
			else {
				pe_error('接口设置失败...');
			}
		}
		$info = $db->index('setting_key')->pe_selectall('setting');
		$seo = pe_seo($menutitle='短信接口', '', '', 'admin');
		include(pe_tpl('setting_sms.html'));
	break;
	//#####################@ 网站设置 @#####################//
	default:
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if ($_FILES['web_logo']['size']) {
				pe_lead('include/class/upload.class.php');
				$upload = new upload($_FILES['web_logo']);
				$_p_info['web_logo'] = $upload->filehost;
				$sqlset = "when 'web_logo' then '{$upload->filehost}'";
			}
			$sql = "update `".dbpre."setting` set `setting_value` = case `setting_key` {$sqlset}
				when 'web_title' then '".pe_dbhold($_p_info['web_title'])."'
				when 'web_keywords' then '".pe_dbhold($_p_info['web_keywords'])."'
				when 'web_description' then '".pe_dbhold($_p_info['web_description'])."'
				when 'web_copyright' then '".pe_dbhold($_p_info['web_copyright'])."'
				when 'web_icp' then '".pe_dbhold($_p_info['web_icp'])."'
				when 'web_phone' then '".pe_dbhold($_p_info['web_phone'])."'
				when 'web_qq' then '".pe_dbhold($_p_info['web_qq'])."'
				when 'web_guestbuy' then '".intval($_p_info['web_guestbuy'])."'
				when 'web_hotword' then '".pe_dbhold($_p_info['web_hotword'])."'
				when 'web_tongji' then '".pe_dbhold($_p_info['web_tongji'], 'all')."' else `setting_value` end";
			if ($db->sql_update($sql)) {
				cache_write('setting');
				pe_success('网站设置成功!');
			}
			else {
				pe_error('网站设置失败...');
			}
		}
		$info = $db->index('setting_key')->pe_selectall('setting');
		$seo = pe_seo($menutitle='网站设置', '', '', 'admin');
		include(pe_tpl('setting_base.html'));
	break;
}
?>