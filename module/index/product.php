<?php
pe_lead('hook/product.hook.php');
switch ($act) {
	//#####################@ 商品收藏 @#####################//
	case 'collectadd':
		$info['product_id'] = intval($_g_id);
		$info['user_id'] = $_s_user_id;
		if ($db->pe_num('collect', pe_dbhold($info))) {
			$show = '您已经收藏过该商品了，请不要重复收藏噢...';
		}
		else {
			$info['collect_atime'] = time();
			if ($db->pe_insert('collect', pe_dbhold($info))) {
				product_num('collectnum', $info['product_id']);
				$show = '商品收藏成功！';
			}
			else {
				$show = '商品收藏失败...';
			}
		}
		echo json_encode(array('show'=>$show));
	break;
	//#####################@ 商品列表 @#####################//
	case 'list':
		pe_lead('hook/category.hook.php');
		$category_id = intval($id);
		$info = $db->pe_select('category', array('category_id'=>$category_id));
		//搜索
		$sqlwhere = " and `product_state` = 1";
		if ($category_id) {
			$sqlwhere .= is_array($category_cidarr = category_cidarr($category_id)) ? " and `category_id` in('".implode("','", $category_cidarr)."')" : " and `category_id` = '{$category_id}'";
		}
		$_g_brand && $sqlwhere .= " and `brand_id` = ".intval($_g_brand);
		$_g_keyword && $sqlwhere .= " and `product_name` like '%".pe_dbhold($_g_keyword)."%'";
		$orderby_arr = array('clicknum_desc', 'clicknum_asc', 'sellnum_desc', 'sellnum_asc', 'money_desc', 'money_asc');
		if (in_array($_g_orderby, $orderby_arr)) {
			$orderby = explode('_', $_g_orderby);
			$sqlwhere .= " order by `product_{$orderby[0]}` {$orderby[1]}";
		}
		else {
			$sqlwhere .= " order by `product_id` desc";
		}
		$info_list = $db->pe_selectall('product', $sqlwhere, '*', array(20, $_g_page));
		$cache_category_brand = cache::get('category_brand');
		
		//热卖排行
		$product_selllist = product_selllist();
		//当前路径
		$nowpath = category_path($category_id);

		$seo = pe_seo($info['category_name']);
		include(pe_tpl('product_list.html'));
	break;
	//#####################@ 商品内容 @#####################//
	default:
		$product_id = intval($act);
		$info = $db->pe_select('product', array('product_id'=>$product_id));
		$comment_ratearr = explode(',', $info['product_commentrate']);
		if ($info['product_commentnum']) {
			$comment_star = $info['product_commentstar']/$info['product_commentnum'];
			$comment_rate = intval($comment_ratearr[0]/$info['product_commentnum']*100);
			$comment_rate1 = intval($comment_ratearr[1]/$info['product_commentnum']*100);
			$comment_rate2 = intval($comment_ratearr[2]/$info['product_commentnum']*100);
		}
		else {
			$comment_star = 5;
			$comment_rate = '100';
			$comment_rate1 = '0';
			$comment_rate2 = '0';
		}		
		$category_id = $info['category_id'];
		//商品规格
		$cache_rule = cache::get('rule');
		$rule_list = $info['rule_id'] ? explode(',', $info['rule_id']) : array();
		$prorule_list = $db->pe_selectall('prorule', array('product_id'=>$product_id));
		$prorule_json = json_encode($prorule_list);
		foreach ($prorule_list as $v) {
			foreach (explode(',', $v['prorule_id']) as $kk=>$vv) {
				if (in_array($vv, (array)$ruledata_list[$kk])) continue;
				$ruledata_list[$kk][] = $vv;
			}
		}

		//热卖排行
		$product_selllist = product_selllist();
		//更新点击
		product_num('clicknum', $product_id);
		//当前路径
		pe_lead('hook/category.hook.php');
		$nowpath = category_path($info['category_id'], $info['product_name']);

		$seo = pe_seo($info['product_name']);
		include(pe_tpl('product_view.html'));
	break;
}
?>