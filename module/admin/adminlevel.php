<?php
/**
 * @copyright   2008-2014 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
$menumark = 'adminlevel';
$modact_list['商品中心'] = array('product-index'=>'商品列表', 'product-add|product-edit|product-ask|product-comment|product-sell'=>'商品添加/修改', 'product-del'=>'商品删除' , 'product-tuijian'=>'商品推荐', 'product-state'=>'商品上下架', 'product-move|'=>'商品转移',
	'category-index'=>'分类列表', 'category-add|category-edit|category-order'=>'分类添加/修改', 'category-del'=>'分类删除',
	'brand-index'=>'品牌列表', 'brand-add|brand-edit|brand-order'=>'品牌添加/修改', 'brand-del'=>'品牌删除', 
	'rule-index'=>'规格列表', 'rule-add|rule-edit'=>'规格添加/修改', 'rule-del'=>'规格删除', 'comment'=>'评价管理', 'quan'=>'优 惠 券', 'huodong'=>'促销活动');
$modact_list['交易中心'] = array('order-index'=>'订单列表', 'order-edit'=>'订单详情', 'order-pay'=>'订单付款', 'order-send'=>'订单发货', 'order-success'=>'订单确认收货', 'order-close'=>'订单取消', 'order-del'=>'订单删除', 'order-money'=>'订单修改价格', 'order-address'=>'订单修改地址', 'moneylog'=>'资金明细', 'pointlog'=>'积分明细', 'order_pay'=>'充值记录', 'cashout'=>'提现管理');
$modact_list['用户中心'] = array('user-index'=>'会员列表', 'user-edit'=>'会员修改', 'user-del'=>'会员删除', 'user-addmoney|user-delmoney'=>'会员资金管理', 'user-delpoint|user-delpoint'=>'会员积分管理', 'user-email'=>'会员发送邮件', 'userbank'=>'收款账户管理', 'useraddr'=>'收货地址管理', 'admin-index'=>'管理列表', 'admin-add|admin-edit'=>'管理添加/修改', 'admin-del'=>'管理删除', 'adminlevel-index'=>'权限列表', 'adminlevel-add|adminlevel-edit'=>'权限添加/修改', 'adminlevel-del'=>'权限删除');
$modact_list['文章中心'] = array('class-index'=>'分类列表', 'class-add|class-edit|class-order'=>'分类添加/修改', 'class-del'=>'分类删除', 'article-index'=>'文章列表', 'article-add|article-edit'=>'文章添加/修改', 'article-del'=>'文章删除');
$modact_list['控制面板'] = array('setting|notice'=>'网站设置', 'wechat'=>'微信设置', 'payway'=>'支付设置', 'menu'=>'导航管理', 'ad'=>'广告管理', 'link'=>'友情链接', 'noticelog'=>'短/邮记录', 'moban'=>'模板管理', 'tongji'=>'数据统计', 'db'=>'数据备份', 'cache'=>'缓存管理');
switch ($act) {
	//#####################@ 管理添加 @#####################//
	case 'add':
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$_p_info['adminlevel_modact'] = serialize($_p_modact);
			if ($db->pe_insert('adminlevel', $_p_info)) {
				cache::write('adminlevel');
				pe_success('添加成功!', 'admin.php?mod=adminlevel');
			}
			else {
				pe_error('添加失败...');
			}
		}
		$info['adminlevel_modact'] = array();
		$seo = pe_seo($menutitle='添加权限', '', '', 'admin');
		include(pe_tpl('adminlevel_add.html'));
	break;
	//#####################@ 管理修改 @#####################//
	case 'edit':
		$adminlevel_id = intval($_g_id);
		$_g_id == 1 && pe_error('总管理员不能修改...');
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$_p_info['adminlevel_modact'] = serialize($_p_modact);
			if ($db->pe_update('adminlevel', array('adminlevel_id'=>$adminlevel_id), $_p_info)) {
				cache::write('adminlevel');
				pe_success('修改成功!', 'admin.php?mod=adminlevel');
			}
			else {
				pe_error('修改失败...');
			}
		}
		$info = $db->pe_select('adminlevel', array('adminlevel_id'=>$adminlevel_id));
		$info['adminlevel_modact'] = unserialize($info['adminlevel_modact']);		
		$seo = pe_seo($menutitle='修改权限', '', '', 'admin');
		include(pe_tpl('adminlevel_add.html'));
	break;
	//#####################@ 管理删除 @#####################//
	case 'del':
		pe_token_match();
		$_g_id == 1 && pe_error('总管理员不可删除...');
		if ($db->pe_delete('adminlevel', array('adminlevel_id'=>$_g_id))) {
			cache::write('adminlevel');
			pe_success('删除成功!');
		}
		else {
			pe_error('删除失败...');
		}
	break;
	//#####################@ 管理列表 @#####################//
	default:
		$info_list = $db->pe_selectall('adminlevel', '', '*', array(20, $_g_page));
		$tongji['all'] = $db->pe_num('adminlevel');
		$seo = pe_seo($menutitle='管理权限', '', '', 'admin');
		include(pe_tpl('adminlevel_list.html'));
	break;
}
?>