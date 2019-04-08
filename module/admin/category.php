<?php
switch ($act) {
	//#####################@ 增加分类 @#####################//
	case 'add':
		$menumark = "category_{$_g_type}";

		pe_lead('hook/category.hook.php');
		$category_treelist = category_treelist($_g_type);

		$seo = pe_seo('增加分类', '', '', 'admin');
		$action = "admin.php?mod=category&act=addsql&type={$_g_type}";
		include(pe_tpl('category_add.html'));
	break;
	//#####################@ 增加分类sql @#####################//
	case 'addsql':
		$_p_info['category_type'] = $_g_type;
		if ($db->pe_insert('category', $_p_info)) {
			//更新缓存
			cache::write('category_product', $db->index('category_id')->pe_selectall('category', array('category_type'=>'product', 'order by'=>'category_order asc')));
			cache::write('category_article', $db->index('category_id')->pe_selectall('category', array('category_type'=>'article', 'order by'=>'category_order asc')));
			cache::write('category_productarr', $db->index('category_pid|category_id')->pe_selectall('category', array('category_type'=>'product', 'order by'=>'category_order asc')));
			cache::write('category_articlearr', $db->index('category_pid|category_id')->pe_selectall('category', array('category_type'=>'article', 'order by'=>'category_order asc')));
			pe_success('分类增加成功!', "admin.php?mod=category&act=list&type={$_g_type}");
		}
		else {
			pe_error('分类增加失败!');
		}
	break;
	//#####################@ 修改分类 @#####################//
	case 'edit':
		$info = $db->pe_select('category', array('category_id'=>$_g_id));
		$menumark = "category_{$info['category_type']}";

		pe_lead('hook/category.hook.php');
		$category_treelist = category_treelist($info['category_type']);
		//不允许移动到的分类id数组
		$category = new category();
		$category_noid = $category->getcid_arr($category_treelist, $info['category_id']);
		$category_noid[] = $info['category_id'];

		$seo = pe_seo('修改分类', '', '', 'admin');
		$action = "admin.php?mod=category&act=editsql&id={$_g_id}&type={$info['category_type']}";
		include(pe_tpl('category_add.html'));
	break;
	//#####################@ 修改分类sql @#####################//
	case 'editsql':
		if ($db->pe_update('category', array('category_id'=>$_g_id), $_p_info)) {
			//更新缓存
			cache::write('category_product', $db->index('category_id')->pe_selectall('category', array('category_type'=>'product', 'order by'=>'category_order asc')));
			cache::write('category_article', $db->index('category_id')->pe_selectall('category', array('category_type'=>'article', 'order by'=>'category_order asc')));
			cache::write('category_productarr', $db->index('category_pid|category_id')->pe_selectall('category', array('category_type'=>'product', 'order by'=>'category_order asc')));
			cache::write('category_articlearr', $db->index('category_pid|category_id')->pe_selectall('category', array('category_type'=>'article', 'order by'=>'category_order asc')));
			pe_success('分类修改成功!', "admin.php?mod=category&act=list&type={$_g_type}");
		}
		else {
			pe_error('分类修改失败!');
		}
	break;
	//#####################@ 分类排序sql @#####################//
	case 'ordersql':
		foreach ($_p_category_order as $k=>$v) {
			$result = $db->pe_update('category', array('category_id'=>$k), array('category_order'=>$v));
		}
		if ($result) {
			//更新缓存
			cache::write('category_product', $db->index('category_id')->pe_selectall('category', array('category_type'=>'product', 'order by'=>'category_order asc')));
			cache::write('category_article', $db->index('category_id')->pe_selectall('category', array('category_type'=>'article', 'order by'=>'category_order asc')));
			cache::write('category_productarr', $db->index('category_pid|category_id')->pe_selectall('category', array('category_type'=>'product', 'order by'=>'category_order asc')));
			cache::write('category_articlearr', $db->index('category_pid|category_id')->pe_selectall('category', array('category_type'=>'article', 'order by'=>'category_order asc')));
			pe_success('分类排序成功!');
		}
		else {
			pe_error('分类排序失败!');
		}
	break;
	//#####################@ 评价回复 @#####################//
	case 'delsql':
		if ($db->pe_delete('category', array('category_id'=>is_array($_p_category_id) ? $_p_category_id : $_g_id))) {
			//更新缓存
			cache::write('category_product', $db->index('category_id')->pe_selectall('category', array('category_type'=>'product', 'order by'=>'category_order asc')));
			cache::write('category_article', $db->index('category_id')->pe_selectall('category', array('category_type'=>'article', 'order by'=>'category_order asc')));
			cache::write('category_productarr', $db->index('category_pid|category_id')->pe_selectall('category', array('category_type'=>'product', 'order by'=>'category_order asc')));
			cache::write('category_articlearr', $db->index('category_pid|category_id')->pe_selectall('category', array('category_type'=>'article', 'order by'=>'category_order asc')));
			pe_success('分类删除成功!');
		}
		else {
			pe_error('分类删除失败...');
		}
	break;
	//#####################@ 分类列表 @#####################//
	default :
		$menumark = "category_{$_g_type}";

		pe_lead('hook/category.hook.php');
		$info_list = category_treelist($_g_type);

		$seo = pe_seo(($_g_type == 'article' ? '文章分类' : '商品分类'), '', '', 'admin');
		include(pe_tpl('category_list.html'));
	break;
}
pe_result();
?>