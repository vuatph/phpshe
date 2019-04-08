<?php
/**
 * @copyright   2008-2012 简好技术 <http://www.phpshe.com>
 * @creatdate   2012-0501 koyshe <koyshe@gmail.com>
 */
$menumark = 'menu';
pe_lead('hook/cache.hook.php');
switch ($act) {
	//#####################@ 导航增加 @#####################//
	case 'add':
		$menu_id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			if ($_p_info['menu_type'] == 'sys') {
				$menu_name = explode('|', $_p_menu_name);
				$_p_info['menu_name'] = $menu_name[0];
				$_p_info['menu_url'] = $menu_name[1];
			}
			if ($db->pe_insert('menu', pe_dbhold($_p_info))) {
				cache_write('menu');
				pe_success('导航增加成功!', 'admin.php?mod=menu');
			}
			else {
				pe_error('导航增加失败...');
			}
		}
		$menu_sys_arr = menu_sys_arr();
		$seo = pe_seo($menutitle='导航增加', '', '', 'admin');
		include(pe_tpl('menu_add.html'));
	break;
	//#####################@ 导航修改 @#####################//
	case 'edit':
		$menu_id = intval($_g_id);
		if (isset($_p_pesubmit)) {
			if ($_p_info['menu_type'] == 'sys') {
				$menu_name = explode('|', $_p_menu_name);
				$_p_info['menu_name'] = $menu_name[0];
				$_p_info['menu_url'] = $menu_name[1];
			}
			if ($db->pe_update('menu', array('menu_id'=>$menu_id), pe_dbhold($_p_info))) {
				cache_write('menu');
				pe_success('导航修改成功!', 'admin.php?mod=menu');
			}
			else {
				pe_error('导航修改失败...');
			}
		}
		$info = $db->pe_select('menu', array('menu_id'=>$menu_id));
		$menu_sys_arr = menu_sys_arr();
		$seo = pe_seo($menutitle='导航修改', '', '', 'admin');
		include(pe_tpl('menu_add.html'));
	break;
	//#####################@ 导航删除 @#####################//
	case 'del':
		if ($db->pe_delete('menu', array('menu_id'=>$_g_id))) {
			cache_write('menu');
			pe_success('导航删除成功!');
		}
		else {
			pe_error('导航删除失败...');
		}
	break;
	//#####################@ 导航排序 @#####################//
	case 'order':
		foreach ($_p_menu_order as $k=>$v) {
			$result = $db->pe_update('menu', array('menu_id'=>$k), array('menu_order'=>$v));
		}
		if ($result) {
			cache_write('menu');
			pe_success('导航排序成功!');
		}
		else {
			pe_error('导航排序失败...');
		}
	break;
	//#####################@ 导航列表 @#####################//
	default :
		$info_list = $db->pe_selectall('menu', array('order by'=>'`menu_order` asc, `menu_id` asc'));
		$seo = pe_seo($menutitle='导航设置', '', '', 'admin');
		include(pe_tpl('menu_list.html'));
	break;
}
function menu_sys_arr() {
	pe_lead('hook/category.hook.php');
	$arr['category'] = '========@商品分类@========';
	$category_treelist = category_treelist();
	foreach ($category_treelist as $v) {
		$arr[$v['category_showname']] = "{$v['category_name']}|product-list-{$v['category_id']}";
	}
	$arr['class'] = '========@文章分类@========';
	$cache_class = cache::get('class');
	foreach ($cache_class as $v) {
		$arr[$v['class_name']] = "{$v['class_name']}|article-list-{$v['class_id']}";
	}
	$arr['brand'] = '========@品牌列表@========';
	$arr['品牌街'] = "品牌街|brand-list";
	/*$arr['page'] = '========@单页列表@========';
	$page_class = cache::get('page');
	foreach ($page_class as $v) {
		$arr[$v['page_name']] = "{$v['page_name']}|page-{$v['page_id']}";
	}*/
	return $arr;
}
?>