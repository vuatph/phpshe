<?php
$menumark = 'article_list';
switch ($act) {
	//#####################@ 文章增加 @#####################//
	case 'add':
		pe_lead('hook/category.hook.php');
		$category_treelist = category_treelist('article');

		$seo = pe_seo('发布文章', '', '', 'admin');
		$action = 'admin.php?mod=article&act=addsql';
		include(pe_tpl('article_add.html'));
	break;
	//#####################@ 文章增加sql @#####################//
	case 'addsql':
		$_p_info['article_atime'] = $_p_info['article_atime'] ? strtotime($_p_info['article_atime']) : time();		
		if ($db->pe_insert('article', pe_dbhold($_p_info, array('article_text')))) {
			pe_success('文章发布成功!', 'admin.php?mod=article&act=list');
		}
		else {
			pe_error('文章发布失败...');
		}
	break;
	//#####################@ 文章修改 @#####################//
	case 'edit':
		pe_lead('hook/category.hook.php');
		$category_treelist = category_treelist('article');

		$info = $db->pe_select('article', array('article_id'=>$_g_id));

		$seo = pe_seo('修改文章', '', '', 'admin');
		$action = "admin.php?mod=article&act=editsql&id={$_g_id}";
		include(pe_tpl('article_add.html'));
	break;
	//#####################@ 文章修改sql @#####################//
	case 'editsql':
		$_p_info['article_atime'] = $_p_info['article_atime'] ? strtotime($_p_info['article_atime']) : time();
		if ($db->pe_update('article', array('article_id'=>$_g_id), pe_dbhold($_p_info, array('article_text')))) {
			pe_success('文章修改成功!', 'admin.php?mod=article&act=list');
		}
		else {
			pe_error('文章修改失败...');
		}
	break;
	//#####################@ 文章删除sql @#####################//
	case 'delsql':
		if ($db->pe_delete('article', array('article_id'=>is_array($_p_article_id) ? $_p_article_id : $_g_id))) {
			pe_success('文章删除成功!');
		}
		else {
			pe_error('文章删除失败...');
		}
	break;
	//#####################@ 文章列表sql @#####################//
	default :
		$cache_category = cache::get('category_article');

		//文章分类
		include("{$pe['path_root']}hook/category.hook.php");
		$category_treelist = category_treelist('article');

		$_g_keyword && $sqlwhere .= " and `article_name` like '%{$_g_keyword}%'";
		$_g_category_id && $sqlwhere .= " and `category_id` = '{$_g_category_id}'"; 
		$sqlwhere .= " order by `article_id` desc";
		$info_list = $db->pe_selectall('article', $sqlwhere, '*', array(20, $_g_page));

		$seo = pe_seo('文章列表', '', '', 'admin');
		include(pe_tpl('article_list.html'));
	break;
}
pe_result();
?>