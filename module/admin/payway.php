<?php
/**
 * @copyright   2008-2014 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-1116 koyshe <koyshe@gmail.com>
 */
$menumark = 'payway';
pe_lead('hook/cache.hook.php');
//支付宝模版
$alipay['alipay_name']['name']='支付宝账户';
$alipay['alipay_name']['form_type']='text';
$alipay['alipay_pid']['name']='合作者身份Pid';
$alipay['alipay_pid']['form_type']='text';
$alipay['alipay_key']['name']='安全校验码Key';
$alipay['alipay_key']['form_type']='text';
//银行转账付款模版
$bank['bank_text']['name'] = '收款信息';
$bank['bank_text']['form_type']='textarea';
//网银在线付款模版
$ebank['ebank_id']['name'] = '商户号';
$ebank['ebank_id']['form_type']='text';
$ebank['ebank_md5']['name'] = 'MD5私钥';
$ebank['ebank_md5']['form_type']='text';
//var_dump(serialize($alipay));
switch ($act) {
	//#####################@ 支付修改 @#####################//
	case 'edit':
		$payway_id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$_p_info['payway_config'] = $_p_config ? serialize($_p_config) : '';
			if ($db->pe_update('payway', array('payway_id'=>$payway_id), $_p_info)) {
				cache_write('payway');
				pe_success('修改成功!', 'admin.php?mod=payway');
			}
			else {
				pe_error('修改失败...' );
			}
		}
		$info = $db->pe_select('payway', array('payway_id'=>$payway_id));
		$info['payway_model'] = $info['payway_model'] ? unserialize($info['payway_model']) : array();
		$info['payway_config'] = $info['payway_config'] ? unserialize($info['payway_config']) : array();
		$seo = pe_seo($menutitle='修改支付方式', '', '', 'admin');
		include(pe_tpl('payway_add.html'));
	break;
	//#####################@ 支付删除 @#####################//
	case 'del':
		pe_token_match();
		if ($db->pe_delete('payway', array('payway_id'=>is_array($_p_payway_id) ? $_p_payway_id : $_g_id))) {
			cache_write('payway');
			pe_success('删除成功!');
		}
		else {
			pe_error('删除失败...');
		}
	break;
	//#####################@ 支付状态 @#####################//
	case 'state':
		pe_token_match();
		if ($db->pe_update('payway', array('payway_id'=>is_array($_p_payway_id) ? $_p_payway_id : $_g_id), array('payway_state'=>$_g_state))) {
			cache_write('payway');
			pe_success("操作成功!");
		}
		else {
			pe_error("操作失败...");
		}
	break;
	//#####################@ 支付排序 @#####################//
	case 'order':
		pe_token_match();
		foreach ($_p_payway_order as $k => $v) {
			$result = $db->pe_update('payway', array('payway_id'=>$k), array('payway_order'=>$v));
		}
		if ($result) {
			cache_write('payway');
			pe_success('排序成功!');
		}
		else {
			pe_error('排序失败...');
		}
	break;
	//#####################@ 支付列表 @#####################//
	default:
		$info_list = $db->pe_selectall('payway', array('order by'=>'`payway_order` asc, `payway_id` asc'), '*', array(20, $_g_page));
		$tongji['all'] = $db->pe_num('payway');
		$seo = pe_seo($menutitle='支付方式', '', '', 'admin');
		include(pe_tpl('payway_list.html'));
	break;
}
?>