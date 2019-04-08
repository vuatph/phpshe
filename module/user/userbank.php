<?php
/**
 * @copyright   2008-2014 简好网络 <http://www.phpshe.com>
 * @creatdate   2016-0101 koyshe <koyshe@gmail.com>
 */
$menumark = 'userbank';
switch ($act) {
	//#####################@ 账户增加 @#####################//
	case 'add':
		$user = $db->pe_select('user', array('user_id'=>$_s_user_id));
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if (!in_array($_p_userbank_type, array('alipay', 'tenpay')) && !$_p_userbank_address) pe_error('请填写开户行');
			if (!$_p_userbank_num) pe_error('请填写收款帐号');
			if ($db->pe_num('userbank', array('userbank_num'=>pe_dbhold($_p_userbank_num)))) pe_error('收款帐号已存在');
			if (!$_p_userbank_tname) pe_error('请填写收款人');
			$sql_set['userbank_type'] = $_p_userbank_type;
			$sql_set['userbank_name'] = $ini['userbank_type'][$_p_userbank_type];
			$sql_set['userbank_address'] = $_p_userbank_address;
			$sql_set['userbank_tname'] = $_p_userbank_tname;
			$sql_set['userbank_num'] = $_p_userbank_num;
			$sql_set['userbank_atime'] = time();
			$sql_set['user_id'] = $_s_user_id;
			$sql_set['user_name'] = $_s_user_name;
			if ($db->pe_insert('userbank', pe_dbhold($sql_set))) {
				$url = ($_g_fromto == 'cashout') ? 'user.php?mod=cashout&act=add' : 'user.php?mod=userbank';				
				pe_success('添加成功!', $url);
			}
			else {
				pe_error('添加失败');
			}
		}
		$seo = pe_seo($menutitle='新增账户');
		include(pe_tpl('userbank_add.html'));
	break;
	//#####################@ 账户删除 @#####################//
	case 'del':
		pe_token_match();
		$userbank_id = intval($_g_id);
		if ($db->pe_delete('userbank', array('userbank_id'=>$userbank_id, 'user_id'=>$_s_user_id))) {
			pe_success('删除成功!');
		}
		else {
			pe_error('删除失败');
		}
	break;
	//#####################@ 账户列表 @#####################//
	default:
		$info_list = $db->pe_selectall('userbank', array('user_id'=>$_s_user_id, 'order by'=>'userbank_id desc'), '*', array(30, $_g_page));

		$tongji['all'] = $db->pe_num('userbank', array('user_id'=>$_s_user_id));
		$seo = pe_seo($menutitle='收款账户');
		include(pe_tpl('userbank_list.html'));
	break;
}
?>