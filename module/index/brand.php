<?php
pe_lead('hook/category.hook.php');
pe_lead('hook/product.hook.php');
switch ($act) {
	//#####################@ 品牌列表 @#####################//
	case 'list':
		$cache_category_brand = cache::get('category_brand');
		$cache_brand = cache::get('brand');
		//当前路径
		$nowpath = category_path($category_id);
		$seo = pe_seo('品牌街');
		include(pe_tpl('brand_list.html'));
	break;
	//#####################@ 品牌详情 @#####################//
	default:
		$brand_id = intval($act);
		$cache_brand = cache::get('brand');
		$info = $cache_brand[$brand_id];
		$sqlwhere .= " and `brand_id` = {$brand_id}";
		$orderby_arr = array('clicknum_desc', 'clicknum_asc', 'sellnum_desc', 'sellnum_asc', 'money_desc', 'money_asc');
		if (in_array($_g_orderby, $orderby_arr)) {
			$orderby = explode('_', $_g_orderby);
			$sqlwhere .= " order by `product_{$orderby[0]}` {$orderby[1]}";
		}
		else {
			$sqlwhere .= " order by `product_id` desc";
		}
		$info_list = $db->pe_selectall('product', $sqlwhere, '*', array(20, $_g_page));


		//热卖排行
		$product_hotlist = product_hotlist();
		//更新点击
		product_num('clicknum', $product_id);
		//当前路径
		$nowpath = category_path($info['category_id'], $info['product_name']);

		$seo = pe_seo($info['brand_name']);
		include(pe_tpl('product_list.html'));
	break;
}
?>