<?php
/**
 * @copyright   2008-2014 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
$menumark = 'quan';
pe_lead('hook/order.hook.php');
switch ($act) {
	//#####################@ 优惠券列表 @#####################//
	case 'list':
		user_quancheck();
		$info_list = $db->pe_selectall('quan', " and `quan_edate` > '".date('Y-m-d')."' order by `quan_id` desc", '*', array(20, $_g_page));
		$nowpath = " > <a href='".pe_url("quan")."' title='优惠券列表'>优惠券列表</a>";
		$seo = pe_seo('优惠券');
		include(pe_tpl('quan_list.html'));
	break;
	//#####################@ 订单选择优惠券 @#####################//
	case 'select':
		$quanlog_id = intval($_g_id);
		user_quancheck();
		$info_list = user_quanlist($_g_cart_id);
		if ($quanlog_id) {
			$info = $info_list[$quanlog_id];
			$result = is_array($info) ? true : false; 
			pe_jsonshow(array('result'=>$result, 'info'=>$info));		
		}
		else {
			pe_jsonshow(array('result'=>true, 'list'=>array_values($info_list)));
		}
	break;
	//#####################@ 优惠券兑换 @#####################//
	case 'duihuan':
		if (isset($_p_pesubmit)) {
			$quan_key = pe_dbhold($_p_quan_key);
			if (!pe_login('user')) pe_jsonshow(array('result'=>false, 'show'=>'请先登录'));
			if (!$quan_key) pe_jsonshow(array('result'=>false, 'show'=>'请输入券码'));
			$info = $db->sql_select("select `quanlog_id` from `".dbpre."quanlog` where `quan_key` = '{$quan_key}' and `user_id` = 0 and `quanlog_state` = 0 and `quan_edate` >= '".date('Y-m-d')."'");
			if ($info['quanlog_id']) {
				$sql_set['user_id'] = $_s_user_id;
				$sql_set['user_name'] = $_s_user_name;
				$sql_set['quanlog_atime'] = time();				
				if ($db->pe_update('quanlog', array('quanlog_id'=>$info['quanlog_id']), pe_dbhold($sql_set))) {
					pe_jsonshow(array('result'=>true, 'show'=>'兑换成功'));
				}
				else {
					pe_jsonshow(array('result'=>false, 'show'=>'兑换失败'));
				}
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'券码无效'));
			}
		}
	break;
	//#####################@ 优惠券领取 @#####################//
	default:
		$info = $db->pe_select('quan', array('quan_id'=>intval($act)));
		if (!$info['quan_id']) pe_404();
		$quanlog_num = $db->pe_num('quanlog', array('quan_id'=>$info['quan_id'], 'user_id'=>$_s_user_id));
		if (isset($_p_pesubmit)) {
			if (!pe_login('user')) pe_jsonshow(array('result'=>false, 'show'=>'请先登录'));
			if (!$info['quan_id']) pe_jsonshow(array('result'=>false, 'show'=>'优惠券不存在'));
			if ($info['quan_type'] == 'offline') pe_jsonshow(array('result'=>false, 'show'=>'参数错误'));
			if ($info['quan_num'] <= $info['quan_num_get']) pe_jsonshow(array('result'=>false, 'show'=>'优惠券已领完'));	
			if ($info['quan_edate'] < date('Y-m-d')) pe_jsonshow(array('result'=>false, 'show'=>'优惠券已过期'));
			if ($quanlog_num) pe_jsonshow(array('result'=>false, 'show'=>'请勿重复领取'));
			$sql_set['quan_id'] = $info['quan_id'];
			$sql_set['quan_name'] = $info['quan_name'];
			$sql_set['quan_money'] = $info['quan_money'];
			$sql_set['quan_limit'] = $info['quan_limit'];
			$sql_set['quan_sdate'] = $info['quan_sdate'];
			$sql_set['quan_edate'] = $info['quan_edate'];
			$sql_set['product_id'] = $info['product_id'];
			$sql_set['quanlog_atime'] = time();
			$sql_set['user_id'] = $_s_user_id;
			$sql_set['user_name'] = $_s_user_name;
			if ($quanlog_id = $db->pe_insert('quanlog', pe_dbhold($sql_set))) {
				user_quanupdate($quanlog_id, 0);
				pe_jsonshow(array('result'=>true, 'show'=>'领取成功'));
			}
			else {
				pe_jsonshow(array('result'=>false, 'show'=>'领取失败'));	
			}
		}
		if ($info['product_id']) {
			$info_list = $db->pe_selectall('product', array('product_id'=>explode(',', $info['product_id'])));		
		}
		else {
			$info_list = $db->pe_selectall('product', array('order by'=>'product_istuijian desc, product_sellnum desc'), '*', array(20));
		}
		$seo = pe_seo($menutitle='领取优惠券');
		include(pe_tpl('quan_view.html'));
	break;
}
?>