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
			if ($_FILES['product_logo']['size']) {
				pe_lead('include/class/upload.class.php');
				$upload = new upload($_FILES['product_logo']);
				$_p_info['product_logo'] = $upload->filehost;
			}
			$_p_info['product_money'] = $_p_info['product_smoney'];
			$_p_info['product_atime'] = $_p_info['product_atime'] ? strtotime($_p_info['product_atime']) : time();
			$_p_info['rule_id'] = is_array($_p_rule_id) ? implode(',', $_p_rule_id) : '';
			if ($product_id = $db->pe_insert('product', pe_dbhold($_p_info, array('product_text')))) {
				if (is_array($_p_prorule_key)) {
					foreach ($_p_prorule_key as $k=>$v) {
						$sql_prorule['product_id'] = $product_id;
						$sql_prorule['product_money'] = $_p_product_money[$k];
						$sql_prorule['product_mmoney'] = $_p_product_mmoney[$k];
						$sql_prorule['product_num'] = $_p_product_num[$k];
						$sql_prorule['prorule_key'] = $v;
						$db->pe_insert('prorule', $sql_prorule);
						$sql_product['product_num'] += $_p_product_num[$k];
					}
					$db->pe_update('product', array('product_id'=>$product_id), $sql_product);
				}
				cache_write('category');
				pe_success('商品添加成功!', 'admin.php?mod=product&state=1');
			}
			else {
				pe_error('商品添加失败...');
			}
		}
		//商品规格
		$rule_list = $info['rule_id'] ? explode(',', $info['rule_id']) : array();
		$prorule_list = $db->pe_selectall('prorule', array('product_id'=>$product_id, 'order by'=>'prorule_id asc'));
		$seo = pe_seo($menutitle='添加商品', '', '', 'admin');
		include(pe_tpl('product_add.html'));
	break;
	//#####################@ 商品修改 @#####################//
	case 'edit':
		$product_id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			if ($_FILES['product_logo']['size']) {
				pe_lead('include/class/upload.class.php');
				$upload = new upload($_FILES['product_logo']);
				$_p_info['product_logo'] = $upload->filehost;
			}
			$_p_info['product_money'] = $_p_info['product_smoney'];			
			//$_p_info['product_atime'] = $_p_info['product_atime'] ? strtotime($_p_info['product_atime']) : time();
			$_p_info['rule_id'] = is_array($_p_rule_id) ? implode(',', $_p_rule_id) : '';
			if ($db->pe_update('product', array('product_id'=>$product_id), pe_dbhold($_p_info, array('product_text')))) {
				$db->pe_delete('prorule', array('product_id'=>$product_id));
				if (is_array($_p_prorule_key)) {
					foreach ($_p_prorule_key as $k=>$v) {
						$sql_prorule['product_id'] = $product_id;
						$sql_prorule['product_money'] = $_p_product_money[$k];
						$sql_prorule['product_mmoney'] = $_p_product_mmoney[$k];
						$sql_prorule['product_num'] = $_p_product_num[$k];
						$sql_prorule['prorule_key'] = $v;
						$db->pe_insert('prorule', $sql_prorule);
						$sql_product['product_num'] += $_p_product_num[$k];
					}
					$db->pe_update('product', array('product_id'=>$product_id), $sql_product);
				}
				cache_write('category');
				pe_success('商品修改成功!', $_g_fromto);
			}
			else {
				pe_error('商品修改失败!' );
			}
		}
		$info = $db->pe_select('product', array('product_id'=>$product_id));
		//商品规格
		$rule_list = $info['rule_id'] ? explode(',', $info['rule_id']) : array();
		$prorule_list = $db->pe_selectall('prorule', array('product_id'=>$product_id, 'order by'=>'prorule_id asc'));	
		$seo = pe_seo($menutitle='修改商品', '', '', 'admin');
		include(pe_tpl('product_add.html'));
	break;
	//#####################@ 商品删除 @#####################//
	case 'del':
		pe_token_match();
		if ($db->pe_delete('product', array('product_id'=>is_array($_p_product_id) ? $_p_product_id : $_g_id))) {
			//删除商品相关表
			$db->pe_delete('collect', array('product_id'=>is_array($_p_product_id) ? $_p_product_id : $_g_id));	
			$db->pe_delete('comment', array('product_id'=>is_array($_p_product_id) ? $_p_product_id : $_g_id));
			$db->pe_delete('ask', array('product_id'=>is_array($_p_product_id) ? $_p_product_id : $_g_id));
			cache_write('category');
			pe_success('商品删除成功!');
		}
		else {
			pe_error('商品删除失败...');
		}
	break;
	//#####################@ 商品上下架 @#####################//
	case 'state':
		pe_token_match();
		if ($db->pe_update('product', array('product_id'=>is_array($_p_product_id) ? $_p_product_id : $_g_id), array('product_state'=>$_g_state))) {
			pe_success("操作成功!");
		}
		else {
			pe_error("操作失败...");
		}
	break;
	//#####################@ 商品上下架 @#####################//
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
	case 'rule_html':
		if ($act == 'rule_html') {
			$ruledata_id = explode(',', $_g_ruledata_id);
			foreach($cache_rule as $k=>$v) {
				foreach((array)$v['list'] as $kk=>$vv) {
					if (in_array($vv['ruledata_id'], $ruledata_id)) {
						$ruledata_idarr[$k][] = $vv['ruledata_id'];
					}
				}
			}
			$rule_tablelist = rule_table($ruledata_idarr);
$html = '<tr><th class="bgtt" width="50">序号</th>';
foreach ($ruledata_idarr as $k=>$v) {
	$html .= "<th class='bgtt'>{$cache_rule[$k]['rule_name']}<input type='hidden' name='rule_id[]' value='{$k}' /></th>";
}
$html .= <<<html
	<th class="table_td bgtt" width="70">本店价</th>
	<th class="table_td bgtt" width="70">市场价</th>
	<th class="table_td bgtt" width="70">库存</th>
	<th class="table_td bgtt" width="50">操作</th></tr>	
html;
foreach ($rule_tablelist as $k=>$v) {
	$html .= "<tr><td>".($k+1)."</td>";
	foreach (explode(',', $v) as $vv) {
		$html .= "<td>{$cache_ruledata[$vv]['ruledata_name']}</td>";
	}
$html .= <<<html
	<td class="table_td"><input type="text" name="product_money[]" value="" class="inputtext input40" /></td>
	<td class="table_td"><input type="text" name="product_mmoney[]" value="" class="inputtext input40" /></td>
	<td class="table_td"><input type="text" name="product_num[]" value="" class="inputtext input40" /></td>
	<td class="table_td"><input type="hidden" name="prorule_key[]" value="{$v}" /><a href="javascript:;" class="hy_btn rule_del">删除</a></td></tr>		
html;
}
			echo json_encode(array('result'=>$result, 'html'=>$html));
			die();
		}
		$prorule_key = $_g_prorule_key ? array_unique(explode(',', $_g_prorule_key)) : array();
		$seo = pe_seo($menutitle='选择规格', '', '', 'admin');
		include(pe_tpl('product_rule.html'));
	break;
	//#####################@ 快速咨询 @#####################//
	case 'ask':
		pe_lead('hook/product.hook.php');
		$product_id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			pe_token_match();
			$sql_set['product_id'] = $product_id;
			$sql_set['ask_text'] = $_p_ask_text;
			$sql_set['ask_atime']= $_p_ask_atime ? strtotime($_p_ask_atime) : time();
			$sql_set['ask_replytext'] = $_p_ask_replytext;
			$sql_set['user_ip'] = pe_ip();
			$sql_set['user_name'] = $_p_user_name;
			$user = $db->pe_select('user', array('user_name'=>pe_dbhold($sql_set['user_name'])));
			if ($user['user_id']) {
				$sql_set['user_id'] = $user['user_id'];	
			}
			if ($sql_set['ask_replytext']) {
				$sql_set['ask_replytime'] = $sql_set['ask_atime'] + rand(60, 300);
				$sql_set['ask_state'] = 1;			
			}
			if ($db->pe_insert('ask', pe_dbhold($sql_set))) {
				product_num('asknum', $product_id);
				pe_success('咨询添加成功!');
			}
			else {
				pe_error('咨询添加失败...');
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
			$sql_set['product_id'] = $product_id;
			$sql_set['comment_star'] = intval($_p_comment_star);
			$sql_set['comment_text'] = $_p_comment_text;
			$sql_set['comment_atime']= $_p_comment_atime ? strtotime($_p_comment_atime) : time();
			$sql_set['user_ip'] = pe_ip();
			$sql_set['user_name'] = $_p_user_name;
			$user = $db->pe_select('user', array('user_name'=>pe_dbhold($sql_set['user_name'])));
			if ($user['user_id']) {
				$sql_set['user_id'] = $user['user_id'];	
			}
			if ($db->pe_insert('comment', pe_dbhold($sql_set))) {
				product_num('commentnum', $product_id);
				pe_success('评价添加成功!');
			}
			else {
				pe_error('评价添加失败...');
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
		$sqlwhere .= " `product_id` desc";
		$info_list = $db->pe_selectall('product', $sqlwhere, '*', array(15, $_g_page));
		$tongji['all'] = $db->pe_num('product');
		$tongji['xiajia'] = $db->pe_num('product', array('product_state'=>2));
		$tongji['quehuo'] = $db->pe_num('product', array('product_num'=>0));
		$tongji['baoyou'] = $db->pe_num('product', array('product_wlmoney'=>0));
		$tongji['tuijian'] = $db->pe_num('product', array('product_istuijian'=>1));

		$seo = pe_seo($menutitle='商品列表', '', '', 'admin');
		include(pe_tpl('product_list.html'));
	break;
}
function rule_table($arr = array()) {
	if (count($arr) == 1) {
		return $arr[key($arr)];
	}
	else {
		$arr_1 = array_shift($arr);
		$arr_2 = array_shift($arr);
		foreach ($arr_1 as $v) {
			foreach ($arr_2 as $vv) {
				$arr_val[] = "{$v},{$vv}";
			}
		}
		array_unshift($arr, $arr_val);
		return rule_table($arr);
	}
} 
?>