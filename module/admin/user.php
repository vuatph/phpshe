<?php
/**
 * @copyright   2008-2014 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
$menumark = 'user';
pe_lead('hook/user.hook.php');
switch ($act) {
	//#####################@ 会员修改 @#####################//
	case 'edit':
		$user_id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$_p_user_pw && $_p_info['user_pw'] = md5($_p_user_pw);
			if ($db->pe_update('user', array('user_id'=>$user_id), pe_dbhold($_p_info))) {
				pe_success('修改成功!', $_g_fromto);
			}
			else {
				pe_error('修改失败...');
			}
		}
		$info = $db->pe_select('user', array('user_id'=>$user_id));
		$seo = pe_seo($menutitle='修改会员', '', '', 'admin');
		include(pe_tpl('user_add.html'));
	break;
	//#####################@ 会员删除 @#####################//
	case 'del':
		pe_token_match();
		if ($db->pe_delete('user', array('user_id'=>is_array($_p_user_id) ? $_p_user_id : intval($_g_id)))) {
			pe_success('会员删除成功!');
		}
		else {
			pe_error('会员删除失败...');
		}
	break;
	//#####################@ 充值(扣除)金额 @#####################//
	case 'addmoney':
	case 'delmoney':
		$user_id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if (!$_g_id || !$_p_money) pe_error('参数错误...', '', 'dialog');
			$user_money = intval($_p_money);
			$type = $act == 'delmoney' ? 'del' : 'add';
			if (add_moneylog($user_id, $type, $user_money, $_p_text)) {
				pe_success('操作成功!', '', 'dialog');
			}
			else {
				pe_error('操作成功...', '', 'dialog');
			}
		}
		$info = $db->pe_select('user', array('user_id'=>$user_id));
		$cashout = $db->pe_select('cashout', array('user_id'=>$user_id, 'cashout_state'=>0));
		$seo = pe_seo($menutitle='充值(扣除)金额', '', '', 'admin');
		include(pe_tpl('user_addmoney.html'));
	break;
	//#####################@ 增加(扣除)积分 @#####################//
	case 'addpoint':
	case 'delpoint':
		$user_id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if (!$_g_id || !$_p_point) pe_error('参数错误...', '', 'dialog');
			$user_point = intval($_p_point);
			$type = $act == 'delpoint' ? 'del' : 'add';
			if (add_pointlog($user_id, $type, $user_point, $_p_text)) {
				pe_success('操作成功!', '', 'dialog');
			}
			else {
				pe_error('操作成功...', '', 'dialog');
			}
		}
		$info = $db->pe_select('user', array('user_id'=>$user_id));
		$seo = pe_seo($menutitle='增加(扣除)积分', '', '', 'admin');
		include(pe_tpl('user_addpoint.html'));
	break;
	//#####################@ 发送邮件 @#####################//
	case 'email':
		if (isset($_p_pesubmit)) {
			pe_token_match();
			!$_p_email_user && pe_error('收件人必须填写...');
			!$_p_email_name && pe_error('邮件标题必须填写...');
			!$_p_email_text && pe_error('邮件内容必须填写...');
			$email_user = explode(',', $_p_email_user);
			foreach ($email_user as $k=>$v) {
				if (!$v) continue;
				$noticelog_list[$k]['noticelog_user'] = pe_dbhold($v);
				$noticelog_list[$k]['noticelog_name'] = pe_dbhold($_p_email_name);
				$noticelog_list[$k]['noticelog_text'] = $_p_email_text;
				$noticelog_list[$k]['noticelog_atime'] = time();			
			}
			if ($db->pe_insert('noticelog', $noticelog_list)) {
				pe_success('发送成功!', '', 'dialog');
			}
			else {
				pe_error('发送失败...');
			}
		}
		$info_list = $db->pe_selectall('user', array('user_id'=>explode(',', $_g_id)));
		$email_user = array();
		foreach ($info_list as $v) {
			$v['user_email'] && $email_user[] = $v['user_email'];
		}
		$seo = pe_seo($menutitle='发送邮件', '', '', 'admin');
		include(pe_tpl('user_email.html'));
	break;
	//#####################@ 会员列表 @#####################//
	default:
		$_g_name && $sqlwhere .= " and `user_name` like '%{$_g_name}%'";
		$_g_phone && $sqlwhere .= " and `user_phone` like '%{$_g_phone}%'";
		$_g_email && $sqlwhere .= " and `user_email` like '%{$_g_email}%'";
		if (in_array($_g_orderby, array('ltime|desc', 'point|desc', 'ordernum|desc'))) {
			$orderby = explode('|', $_g_orderby);
			$sqlwhere .= " order by `user_{$orderby[0]}` {$orderby[1]}";
		}
		else {
			$sqlwhere .= " order by `user_id` desc";
		}
		$info_list = $db->pe_selectall('user', $sqlwhere, '*', array(20, $_g_page));

		$tongji['user'] = $db->pe_num('user');
		$tongji['useraddr'] = $db->pe_num('useraddr');
		$tongji['userbank'] = $db->pe_num('userbank');
		$seo = pe_seo($menutitle='会员列表', '', '', 'admin');
		include(pe_tpl('user_list.html'));
	break;
}
?>