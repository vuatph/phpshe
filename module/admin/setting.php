<?php
pe_lead('hook/cache.hook.php');
switch ($act) {
	//#####################@ 支付接口 @#####################//
	case 'pay':
		$menumark = 'setting_pay';
		$info = $db->index('setting_key')->pe_selectall('setting');

		$seo = pe_seo('支付接口', '', '', 'admin');
		$action = 'admin.php?mod=setting&act=paysql';
		include(pe_tpl('setting_pay.html'));
	break;
	//#####################@ 支付接口设置sql @#####################//
	case 'paysql':
		$sql = "update `".dbpre."setting` set `setting_value` = case `setting_key`
			when 'alipay_name' then '".pe_dbhold($_p_info['alipay_name'])."'
			when 'alipay_pid' then '".pe_dbhold($_p_info['alipay_pid'])."'
			when 'alipay_key' then '".pe_dbhold($_p_info['alipay_key'])."' end
			where `setting_key` in ('alipay_name','alipay_pid','alipay_key')";
		if ($db->sql_update($sql)) {
			cache_write('setting');
			pe_success('支付接口设置成功!');
		}
		else {
			pe_error('支付接口设置失败...');
		}
	break;
	//#####################@ 基本信息设置sql @#####################//
	case 'basesql':
		$sql = "update `".dbpre."setting` set `setting_value` = case `setting_key`
			when 'web_title' then '".pe_dbhold($_p_info['web_title'])."'
			when 'web_keywords' then '".pe_dbhold($_p_info['web_keywords'])."'
			when 'web_description' then '".pe_dbhold($_p_info['web_description'])."'
			when 'web_tpl' then '".pe_dbhold($_p_info['web_tpl'])."'
			when 'web_copyright' then '".pe_dbhold($_p_info['web_copyright'])."'
			when 'web_icp' then '".pe_dbhold($_p_info['web_icp'])."'
			when 'web_weibo' then '".pe_dbhold($_p_info['web_weibo'])."'
			when 'web_tongji' then '".pe_dbhold($_p_info['web_tongji'], 'all')."' end
			where `setting_key` in ('web_title','web_keywords','web_description','web_tpl','web_copyright','web_icp','web_weibo','web_tongji')";
		if ($db->sql_update($sql)) {
			cache_write('setting');
			pe_success('基本信息设置成功!');
		}
		else {
			pe_error('基本信息设置失败...');
		}
	break;
	//#####################@ 基本信息 @#####################//
	default:
		$menumark = 'setting_base';

		$tpl_arr = glob("{$pe['path_root']}template/*");
		foreach ($tpl_arr as $k => $v) {
			$tpl_arr[$k] = trim(substr(stristr($v, 'template/'), 9), '/');
		}
		$info = $db->index('setting_key')->pe_selectall('setting');

		$seo = pe_seo('基本信息', '', '', 'admin');
		$action = 'admin.php?mod=setting&act=basesql';
		include(pe_tpl('setting_base.html'));
	break;
}
pe_result();
?>