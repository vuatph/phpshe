<?php
/**
 * @copyright   2008-2015 简好网络 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
$menumark = 'product';
pe_lead('hook/cache.hook.php');
pe_lead('hook/category.hook.php');
$category_treelist = category_treelist();
$cache_brand = cache::get('brand');
$cache_rule = cache::get('rule');
$cache_ruledata = cache::get('ruledata');
switch ($act) {
	//#####################@ 商品添加 @#####################//
	case 'add':
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$_p_info['product_money'] = $_p_info['product_smoney'];
			$_p_info['product_atime'] = $_p_info['product_atime'] ? strtotime($_p_info['product_atime']) : time();
			if ($product_id = $db->pe_insert('product', pe_dbhold($_p_info, array('product_text')))) {
				product_callback($product_id);
				cache_write('category');
				pe_success('添加成功!', 'admin.php?mod=product&state=1');
			}
			else {
				pe_error('添加失败...');
			}
		}
		$album_list = array();
		$seo = pe_seo($menutitle='添加商品', '', '', 'admin');
		include(pe_tpl('product_add.html'));
	break;
	//#####################@ 商品修改 @#####################//
	case 'edit':
		$product_id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$_p_info['product_money'] = $_p_info['product_smoney'];
			if ($db->pe_update('product', array('product_id'=>$product_id), pe_dbhold($_p_info, array('product_text')))) {
				product_callback($product_id);
				cache_write('category');
				pe_success('修改成功!', $_g_fromto);
			}
			else {
				pe_error('修改失败!' );
			}
		}
		$info = $db->pe_select('product', array('product_id'=>$product_id));	
		$album_list = explode(',', $info['product_album']);	
		$seo = pe_seo($menutitle='修改商品', '', '', 'admin');
		include(pe_tpl('product_add.html'));
	break;
	//#####################@ 商品删除 @#####################//
	case 'del':
		pe_token_match();
		$product_id = is_array($_p_product_id) ? $_p_product_id : $_g_id;
		if ($db->pe_delete('product', array('product_id'=>$product_id))) {
			$db->pe_delete('prorule', array('product_id'=>$product_id));
			cache_write('category');
			pe_success('删除成功!');
		}
		else {
			pe_error('删除失败...');
		}
	break;
	//#####################@ 商品排序 @#####################//
	case 'order':
		pe_token_match();
		foreach ($_p_product_order as $k=>$v) {
			$result = $db->pe_update('product', array('product_id'=>$k), array('product_order'=>$v));
		}
		if ($result) {
			pe_success('排序成功!');
		}
		else {
			pe_error('排序失败...');
		}
	break;
	//#####################@ 商品上下架 @#####################//
	case 'state':
		pe_token_match();
		$product_id = is_array($_p_product_id) ? $_p_product_id : $_g_id;
		if ($db->pe_update('product', array('product_id'=>$product_id), array('product_state'=>$_g_state))) {
			pe_success("操作成功!");
		}
		else {
			pe_error("操作失败...");
		}
	break;
	//#####################@ 商品批量推荐 @#####################//
	case 'tuijian':
		pe_token_match();
		foreach ($_p_product_id as $v) {
			$result = $db->pe_update('product', array('product_id'=>$v), array('product_istuijian'=>$_g_tuijian));
		}
		if ($result) {
			pe_success("操作成功!");
		}
		else {
			pe_error("操作失败...");
		}
	break;
	//#####################@ 商品批量转移 @#####################//
	case 'move':
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if (!$_p_category_newid) pe_alert('您需要转移到哪个分类呢？请选择...');
			if ($_g_category_id) {
				$result = $db->pe_update('product', array('category_id'=>intval($_p_category_id)), array('category_id'=>$_p_category_newid));
			}
			else {
				$result = $db->pe_update('product', array('product_id'=>explode(',', $_g_id)), array('category_id'=>$_p_category_newid));
			}
			if ($result) {
				cache_write('category');
				pe_success('商品转移成功!', '', 'dialog');
			}
			else {
				pe_error('商品转移失败...' );
			}
		}
		$seo = pe_seo($menutitle='转移商品', '', '', 'admin');
		include(pe_tpl('product_move.html'));
	break;
	//#####################@ 选择规格 @#####################//
	case 'rule':
		$ruledata_id = $_g_id ? explode(',', $_g_id) : array();
		$seo = pe_seo($menutitle='选择规格', '', '', 'admin');
		include(pe_tpl('product_rule.html'));
	break;
	//#####################@ 生成规格 @#####################//
	case 'rule_list':
		if ($_g_type == 'init') {
			$product_id = intval($_g_id);
			$info = $db->pe_select('product', array('product_id'=>$product_id));
			if ($info['product_rule']) {
				$info['product_rule'] = unserialize($info['product_rule']);
				foreach ($info['product_rule'] as $k=>$v) {
					$rule_list[] = array('id'=>$v['id'], 'name'=>$v['name']);
				}
				$prorule_list = $db->pe_selectall('prorule', array('product_id'=>$product_id, 'order by'=>'prorule_id asc'));
				foreach ($prorule_list as $k=>$v) {
					$ruledata_list[$k]['id'] = $v['prorule_key'];
					$ruledata_list[$k]['name'] = $v['prorule_name'];
					$ruledata_list[$k]['name_list'] = explode(',', $v['prorule_name']);
					$ruledata_list[$k]['smoney'] = $v['product_smoney'];
					$ruledata_list[$k]['mmoney'] = $v['product_mmoney'];				
					$ruledata_list[$k]['num'] = $v['product_num'];	
				}
			}
		}
		else {
			$ruledata_id = $_g_id ? explode(',', $_g_id) : array();
			$rule_ids = array();
			foreach($cache_ruledata as $k=>$v) {
				if (!in_array($v['ruledata_id'], $ruledata_id)) continue;
				if (!in_array($v['rule_id'], $rule_ids)) {
					$rule_list[] = array('id'=>$v['rule_id'], 'name'=>$cache_rule[$v['rule_id']]['rule_name']);
					$rule_ids[] = $v['rule_id'];
				}
				$ruledata_idarr[$v['rule_id']][] = $v['ruledata_id'];
			}
			$ruledata_list = ruledata_list($ruledata_idarr);
		}
		$result = is_array($rule_list) ? true : false;
		pe_jsonshow(array('result'=>$result, 'rule_list'=>$rule_list, 'ruledata_list'=>$ruledata_list));
	break;
	//#####################@ 快速咨询 @#####################//
	case 'ask':
		pe_lead('hook/product.hook.php');
		$product_id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$info = $db->pe_select('product', array('product_id'=>$product_id), 'product_id, product_name, product_logo');
			$sql_set['ask_text'] = $_p_ask_text;
			$sql_set['ask_atime']= $_p_ask_atime ? strtotime($_p_ask_atime) : time();
			$sql_set['product_id'] = $info['product_id'];
			$sql_set['product_name'] = $info['product_name'];
			$sql_set['product_logo'] = $info['product_logo'];
			$sql_set['user_name'] = $_p_user_name;
			$sql_set['user_ip'] = pe_ip();
			$user = $db->pe_select('user', array('user_name'=>pe_dbhold($_p_user_name)));
			if ($user['user_id']) {
				$sql_set['user_id'] = $user['user_id'];	
			}
			if ($_p_ask_replytext) {
				$sql_set['ask_replytext'] = $_p_ask_replytext;				
				$sql_set['ask_replytime'] = $sql_set['ask_atime'] + rand(300, 600);
				$sql_set['ask_state'] = 1;			
			}
			if ($db->pe_insert('ask', pe_dbhold($sql_set))) {
				product_num($product_id, 'asknum');
				pe_success('添加成功!');
			}
			else {
				pe_error('添加失败...');
			}
		}
		$info = $db->pe_select('product', array('product_id'=>$product_id));
		$seo = pe_seo($menutitle='添加咨询', '', '', 'admin');
		include(pe_tpl('product_ask.html'));
	break;
	//#####################@ 快速评价 @#####################//
	case 'comment':
		pe_lead('hook/product.hook.php');
		$product_id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$info = $db->pe_select('product', array('product_id'=>$product_id), 'product_id, product_name, product_logo');
			$sql_set['comment_star'] = intval($_p_comment_star);
			$sql_set['comment_text'] = $_p_comment_text;
			$sql_set['comment_logo'] = implode(',', array_filter($_p_comment_logo));		
			$sql_set['comment_atime']= $_p_comment_atime ? strtotime($_p_comment_atime) : time();
			$sql_set['product_id'] = $info['product_id'];
			$sql_set['product_name'] = $info['product_name'];
			$sql_set['product_logo'] = $info['product_logo'];
			$sql_set['user_name'] = $_p_user_name;
			$sql_set['user_ip'] = pe_ip();
			$user = $db->pe_select('user', array('user_name'=>pe_dbhold($sql_set['user_name'])));
			if ($user['user_id']) {
				$sql_set['user_id'] = $user['user_id'];	
			}
			if ($db->pe_insert('comment', pe_dbhold($sql_set))) {
				product_num($product_id, 'commentnum');
				pe_success('添加成功!');
			}
			else {
				pe_error('添加失败...');
			}
		}
		$info = $db->pe_select('product', array('product_id'=>$product_id));
		$seo = pe_seo($menutitle='添加评价', '', '', 'admin');
		include(pe_tpl('product_comment.html'));
	break;
	//#####################@ 设置销量 @#####################//
	case 'sell':
		$product_id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if ($db->pe_update('product', array('product_id'=>$product_id), "`product_sellnum` = ".intval($_p_product_sellnum))) {
				pe_success('销量设置成功!', '', 'dialog');
			}
			else {
				pe_error('商销量设置失败...', '', 'dialog');
			}
		}
		$info = $db->pe_select('product', array('product_id'=>$product_id));
		$seo = pe_seo($menutitle='设置销量', '', '', 'admin');
		include(pe_tpl('product_sell.html'));
	break;
	//#####################@ 商品列表 @#####################//
	default :
		$cache_category = cache::get('category');
		$orderby_arr['num|desc'] = '库存量(多到少)';
		$orderby_arr['num|asc'] = '库存量(少到多)';
		$orderby_arr['sellnum|desc'] = '销售量(多到少)';
		$orderby_arr['sellnum|asc'] = '销售量(少到多)';
		$orderby_arr['asknum|desc'] = '咨询数(多到少)';
		$orderby_arr['asknum|asc'] = '咨询数(少到多)';
		$orderby_arr['commentnum|desc'] = '评价数(多到少)';
		$orderby_arr['commentnum|asc'] = '评价数(少到多)';
		$filter_arr = array('istuijian|1'=>'推荐商品', 'wlmoney|0'=>'包邮商品', 'num|0'=>'售空商品');

		$_g_name && $sqlwhere .= " and `product_name` like '%{$_g_name}%'";
		//$_g_state && $sqlwhere .= " and `product_state` = '{$_g_state}'";
		$_g_category_id && $sqlwhere .= is_array($category_cidarr = category_cidarr($_g_category_id)) ? " and `category_id` in('".implode("','", $category_cidarr)."')" : " and `category_id` = '{$_g_category_id}'";
		$_g_brand_id && $sqlwhere .= " and `brand_id` = '{$_g_brand_id}'";
		if ($_g_filter) {
			$filter = explode('|', $_g_filter);
			$sqlwhere .= " and `product_{$filter[0]}` = {$filter[1]}";
		}
		$sqlwhere .= ' order by';
		if ($_g_orderby) {
			$orderby = explode('|', $_g_orderby);
			$sqlwhere .= " `product_{$orderby[0]}` {$orderby[1]},";
		}
		$sqlwhere .= " `product_order` asc, `product_id` desc";
		$info_list = $db->pe_selectall('product', $sqlwhere, '*', array(30, $_g_page));
		$tongji['all'] = $db->pe_num('product');
		$tongji['xiajia'] = $db->pe_num('product', array('product_state'=>2));
		$tongji['quehuo'] = $db->pe_num('product', array('product_num'=>0));
		$tongji['baoyou'] = $db->pe_num('product', array('product_wlmoney'=>0));
		$tongji['tuijian'] = $db->pe_num('product', array('product_istuijian'=>1));

		$seo = pe_seo($menutitle='商品列表', '', '', 'admin');
		include(pe_tpl('product_list.html'));
	break;
}
function ruledata_list($all_list = array(), $zuhe_list = '') {
	global $cache_ruledata;
	$i = 0;
	if (!count($all_list)) return $zuhe_list;
	$info_list = array_shift($all_list);
	if (is_array($zuhe_list)) {	
		foreach ($zuhe_list as $v) {
			foreach ($info_list as $vv) {
				$info['id'] = "{$v['id']},{$vv}";
				$info['name'] = "{$v['name']},{$cache_ruledata[$vv]['ruledata_name']}";				
				$info['name_list'] = explode(',', $info['name']);
				$zuhe_list[$i++] = $info;
			}
		}
	}
	else {
		foreach ($info_list as $v) {
			$info['id'] = $v;
			$info['name'] = $cache_ruledata[$v]['ruledata_name'];				
			$info['name_list'] = explode(',', $info['name']);
			$zuhe_list[$i++] = $info;
		}
	}
	return ruledata_list($all_list, $zuhe_list);
}

function product_callback($product_id) {
	global $db;
	$db->pe_delete('prorule', array('product_id'=>$product_id));
	if (is_array($_POST['prorule_key'])) {
		foreach ($_POST['prorule_key'] as $k=>$v) {
			$sqlset_prorule['product_id'] = $product_id;
			$sqlset_prorule['prorule_key'] = $v;
			$sqlset_prorule['prorule_name'] = $_POST['prorule_name'][$k];
			$sqlset_prorule['product_money'] = $_POST['product_smoney'][$k];
			$sqlset_prorule['product_smoney'] = $_POST['product_smoney'][$k];
			$sqlset_prorule['product_mmoney'] = $_POST['product_mmoney'][$k];
			$sqlset_prorule['product_num'] = $_POST['product_num'][$k];
			$db->pe_insert('prorule', $sqlset_prorule);
			//格式化规格值到对应主规格中
			$ruledata_idarr = explode(',', $_POST['prorule_key'][$k]);
			$ruledata_namearr = explode(',', $_POST['prorule_name'][$k]);
			foreach ($ruledata_idarr as $kk=>$vv) {
				$ruledata_list[$kk][$vv] = array('id'=>$vv, 'name'=>$ruledata_namearr[$kk]);
			}
			//计算商品价格和库存
			if ($_POST['product_smoney'][$k] <= $sqlset_product['product_smoney'] or !isset($sqlset_product['product_smoney'])) {
				$sqlset_product['product_money'] = $_POST['product_smoney'][$k];
				$sqlset_product['product_smoney'] = $_POST['product_smoney'][$k];
				$sqlset_product['product_mmoney'] = $_POST['product_mmoney'][$k];
			}
			$sqlset_product['product_num'] += $_POST['product_num'][$k];
		}
		//组合规格数组
		foreach($_POST['rule_id'] as $k=>$v) {
			$info_list[$k]['id'] = $v;
			$info_list[$k]['name'] = $_POST['rule_name'][$k];
			$info_list[$k]['list'] = $ruledata_list[$k];
		}
		$sqlset_product['product_rule'] = serialize($info_list);
		//$db->pe_update('product', array('product_id'=>$product_id), $sqlset_product);
	}
	else {
		$sqlset_product['product_rule'] = '';
	}
	$product_album = array();
	foreach ($_POST['product_album'] as $v) {
		if (!$v) continue;
		$product_album[] = $v;		
	}
	$sqlset_product['product_logo'] = $product_album[0];
	$sqlset_product['product_album'] = implode(',', $product_album);
	$db->pe_update('product', array('product_id'=>$product_id), $sqlset_product);
}
?>