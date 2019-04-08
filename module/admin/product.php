<?php
$menumark = 'product_list';
$tag_list = array('tuijian'=>'推荐', 'cuxiao'=>'促销');
switch ($act) {
	//#####################@ 商品增加 @#####################//
	case 'add':
		//商品分类
		pe_lead('hook/category.hook.php');
		$category_treelist = category_treelist('product');
		//商品标签
		$tag_arr = array();

		$seo = pe_seo('发布商品', '', '', 'admin');
		$action = 'admin.php?mod=product&act=addsql';
		include(pe_tpl('product_add.html'));
	break;
	//#####################@ 商品增加sql @#####################//
	case 'addsql':
		if ($_FILES['product_logo']['size']) {
			pe_lead('include/class/upload.class.php');
			$upload = new upload($_FILES['product_logo']);
			$_p_info['product_logo'] = $upload->fileurl;
		}
		$_p_info['product_atime'] = $_p_info['product_atime'] ? strtotime($_p_info['product_atime']) : time();
		if ($product_id = $db->pe_insert('product', pe_dbhold($_p_info, array('product_text')))) {
			//更新商品标签
			if (is_array($_p_tag_id)) {
				foreach ($_p_tag_id as $v) $db->pe_insert('tag', array('product_id'=>$product_id, 'tag_name'=>$v));
			}
			pe_success('商品发布成功!', 'admin.php?mod=product&act=list');
		}
		else {
			pe_error('商品发布失败!' );
		}
	break;
	//#####################@ 商品修改 @#####################//
	case 'edit':
		//商品分类
		pe_lead('hook/category.hook.php');
		$category_treelist = category_treelist('product');
		//商品标签
		$tag_arr = $db->index('tag_name')->pe_selectall('tag', array('product_id'=>$_g_id));

		$info = $db->pe_select('product', array('product_id'=>$_g_id));

		$seo = pe_seo('修改商品', '', '', 'admin');
		$action = "admin.php?mod=product&act=editsql&id={$_g_id}";
		include(pe_tpl('product_add.html'));
	break;
	//#####################@ 商品修改sql @#####################//
	case 'editsql':
		if ($_FILES['product_logo']['size']) {
			pe_lead('include/class/upload.class.php');
			$upload = new upload($_FILES['product_logo']);
			$_p_info['product_logo'] = $upload->fileurl;
		}
		$_p_info['product_atime'] = $_p_info['product_atime'] ? strtotime($_p_info['product_atime']) : time();
		if ($db->pe_update('product', array('product_id'=>$_g_id), pe_dbhold($_p_info, array('product_text')))) {
			//更新商品标签
			$db->pe_delete('tag', array('product_id'=>$_g_id));
			if (is_array($_p_tag_id)) {
				foreach ($_p_tag_id as $v) $db->pe_insert('tag', array('product_id'=>$_g_id, 'tag_name'=>$v));
			}
			pe_success('商品修改成功!', 'admin.php?mod=product&act=list');
		}
		else {
			pe_error('商品修改失败!' );
		}
	break;
	//#####################@ 商品删除sql @#####################//
	case 'delsql':
		if ($db->pe_delete('product', array('product_id'=>is_array($_p_product_id) ? $_p_product_id : $_g_id))) {
			//删除商品相关表
			$db->pe_delete('comment', array('product_id'=>is_array($_p_product_id) ? $_p_product_id : $_g_id));
			$db->pe_delete('ask', array('product_id'=>is_array($_p_product_id) ? $_p_product_id : $_g_id));
			$db->pe_delete('collect', array('product_id'=>is_array($_p_product_id) ? $_p_product_id : $_g_id));
			$db->pe_delete('tag', array('product_id'=>is_array($_p_product_id) ? $_p_product_id : $_g_id));			
			pe_success('商品删除成功!');
		}
		else {
			pe_error('商品删除失败!' );
		}
	break;
	//#####################@ 商品上下架sql @#####################//
	case 'statesql':
		$state_arr = array(1=>'上架', 2=>'下架');
		foreach ($_p_product_id as $v) {
			$result = $db->pe_update('product', array('product_id'=>$v), array('product_state'=>$_g_state));
		}
		if ($result) {
			pe_success("商品{$state_arr[$_g_state]}成功!");
		}
		else {
			pe_error("商品{$state_arr[$_g_state]}失败...");
		}
	break;
	//#####################@ 商品列表 @#####################//
	default :
		$cache_category = cache::get('category_product');

		//商品分类
		include("{$pe['path_root']}hook/category.hook.php");
		$category_treelist = category_treelist('product');

		$_g_state && $sqlwhere .= " and `product_state` = '{$_g_state}'"; 
		$_g_keyword && $sqlwhere .= " and `product_name` like '%{$_g_keyword}%'";
		$_g_category_id && $sqlwhere .= " and `category_id` = '{$_g_category_id}'"; 
		$sqlwhere .= " order by `product_id` desc";
		$info_list = $db->pe_selectall('product', $sqlwhere, '*', array(20, $_g_page));

		$seo = pe_seo('商品列表', '', '', 'admin');
		include(pe_tpl('product_list.html'));
	break;
}
pe_result();
?>